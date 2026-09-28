<?php
/**
 * General helpers: output escaping, redirects, flash messages, CSRF, uploads and validation.
 */

/** Escapes a value for safe output in HTML. */
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/**
 * Builds a URL relative to the application root, so it works whether the app lives at
 * http://localhost/ or http://localhost/attendance-system/.
 */
function url(string $path = ''): string
{
    static $base = null;

    if ($base === null) {
        $script = str_replace('\\', '/', (string) realpath($_SERVER['SCRIPT_FILENAME']));
        $root = str_replace('\\', '/', APP_ROOT);
        $relative = substr($script, strlen($root));
        $base = rtrim(substr($_SERVER['SCRIPT_NAME'], 0, -strlen($relative) ?: null), '/');
    }

    return $base . '/' . ltrim($path, '/');
}

function redirect(string $location): void
{
    header('Location: ' . $location);
    exit;
}

function is_ajax(): bool
{
    return ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest';
}

function json_response(array $data, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
    exit;
}

/* ---------------------------------------------------------------------------
 * Flash messages and old form input (survive exactly one redirect)
 * ------------------------------------------------------------------------- */

/** @param string $type Bootstrap contextual class: success, danger, warning or info. */
function flash(string $type, string $message): void
{
    $_SESSION['flash'][] = ['type' => $type, 'message' => $message];
}

function take_flashes(): array
{
    $messages = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);

    return $messages;
}

/** Prints pending flash messages as Bootstrap 4 alerts. */
function render_flashes(): void
{
    foreach (take_flashes() as $flash) {
        echo '<div class="alert alert-' . e($flash['type']) . ' alert-dismissible fade show" role="alert">'
            . e($flash['message'])
            . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
            . '</div>';
    }
}

function remember_input(array $input): void
{
    $_SESSION['old_input'] = $input;
}

/** Returns input remembered from the previous (failed) submission and forgets it. */
function take_old_input(): array
{
    $input = $_SESSION['old_input'] ?? [];
    unset($_SESSION['old_input']);

    return $input;
}

/* ---------------------------------------------------------------------------
 * CSRF protection
 * ------------------------------------------------------------------------- */

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

/** Checks the token sent in a form field or in the X-CSRF-Token header (AJAX). */
function verify_csrf(): bool
{
    $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';

    return is_string($token) && hash_equals(csrf_token(), $token);
}

/** Stops the request unless it is a POST with a valid CSRF token. */
function require_valid_post(string $redirectTo): void
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf()) {
        return;
    }

    if (is_ajax()) {
        json_response(['ok' => false, 'message' => 'Your session has expired. Please reload the page.'], 419);
    }

    flash('danger', 'Your session has expired. Please try again.');
    redirect($redirectTo);
}

/* ---------------------------------------------------------------------------
 * Validation and formatting
 * ------------------------------------------------------------------------- */

function is_valid_date($value): bool
{
    if (!is_string($value)) {
        return false;
    }
    $date = DateTime::createFromFormat('!Y-m-d', $value);

    return $date !== false && $date->format('Y-m-d') === $value;
}

/** Turns a Y-m-d database date into d-m-Y for display. */
function format_date(string $date): string
{
    return date('d-m-Y', strtotime($date));
}

/** Validates the fields shared by the student and teacher forms. */
function validate_person(array $input, string $password, bool $isNew): array
{
    $errors = [];

    foreach (['first_name' => 'First name', 'last_name' => 'Last name'] as $field => $label) {
        if ($input[$field] === '') {
            $errors[] = "$label is required.";
        } elseif (preg_match_all('/./us', $input[$field]) > 50) {
            $errors[] = "$label must be 50 characters or fewer.";
        }
    }

    if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL) || strlen($input['email']) > 100) {
        $errors[] = 'Enter a valid email address.';
    }

    if ($isNew && $password === '') {
        $errors[] = 'Password is required.';
    } elseif ($password !== '' && strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    }

    return $errors;
}

/* ---------------------------------------------------------------------------
 * Photo uploads
 * ------------------------------------------------------------------------- */

/**
 * Validates and stores an uploaded photo.
 *
 * @return string|null The stored file name, or null when no file was sent.
 * @throws RuntimeException With a user-facing message when the upload is invalid.
 */
function upload_image(?array $file): ?string
{
    if ($file === null || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if (in_array($file['error'], [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE], true) || $file['size'] > MAX_UPLOAD_BYTES) {
        throw new RuntimeException('The photo must be 2 MB or smaller.');
    }
    if ($file['error'] !== UPLOAD_ERR_OK || !is_uploaded_file($file['tmp_name'])) {
        throw new RuntimeException('The photo could not be uploaded. Please try again.');
    }

    $extensions = [IMAGETYPE_JPEG => 'jpg', IMAGETYPE_PNG => 'png', IMAGETYPE_WEBP => 'webp'];
    $info = @getimagesize($file['tmp_name']);
    $extension = $info ? ($extensions[$info[2]] ?? null) : null;
    if ($extension === null) {
        throw new RuntimeException('The photo must be a JPG, PNG or WEBP image.');
    }

    $name = date('YmdHis') . '-' . bin2hex(random_bytes(6)) . '.' . $extension;
    if (!move_uploaded_file($file['tmp_name'], UPLOAD_DIR . '/' . $name)) {
        throw new RuntimeException('The photo could not be saved on the server.');
    }

    return $name;
}

function delete_upload(?string $name): void
{
    if ($name && basename($name) === $name && is_file(UPLOAD_DIR . '/' . $name)) {
        unlink(UPLOAD_DIR . '/' . $name);
    }
}

/** URL of a stored photo (relative to /admin), or a placeholder when there is none. */
function image_url(?string $name): string
{
    if ($name && basename($name) === $name && is_file(UPLOAD_DIR . '/' . $name)) {
        return 'upload/' . rawurlencode($name);
    }

    return 'assets/img/undraw_profile.svg';
}
