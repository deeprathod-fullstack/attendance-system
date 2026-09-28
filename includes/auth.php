<?php
/**
 * Authentication and role-based access control.
 *
 * Roles:
 *   admin   - everything, including managing teachers
 *   teacher - dashboard, attendance, students and feedback
 *   student - only their own attendance dashboard
 */

/** Login role => database table that stores its accounts. */
const ROLE_TABLES = [
    'admin' => 'admin',
    'teacher' => 'teacher',
    'student' => 'student',
];

const STAFF_ROLES = ['admin', 'teacher'];

function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function current_role(): ?string
{
    return $_SESSION['user']['role'] ?? null;
}

function has_role(string ...$roles): bool
{
    return in_array(current_role(), $roles, true);
}

/** Landing page after login, relative to the application root. */
function home_for_role(string $role): string
{
    return $role === 'student' ? 'admin/student_index.php' : 'admin/index.php';
}

function login_user(string $role, array $account): void
{
    session_regenerate_id(true);
    $_SESSION['user'] = [
        'id' => (int) $account['id'],
        'role' => $role,
        'name' => trim($account['first_name'] . ' ' . $account['last_name']),
    ];
}

function logout_user(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    session_destroy();
}

/**
 * Stops the request unless someone is logged in with one of the given roles.
 * Pages are redirected; AJAX requests receive a JSON error instead.
 */
function require_login(array $roles): void
{
    $user = current_user();

    if ($user === null) {
        if (is_ajax()) {
            json_response(['ok' => false, 'message' => 'Please log in again.'], 401);
        }
        flash('warning', 'Please log in to continue.');
        redirect(url('login.php'));
    }

    if (!in_array($user['role'], $roles, true)) {
        if (is_ajax()) {
            json_response(['ok' => false, 'message' => 'You do not have permission to do that.'], 403);
        }
        flash('danger', 'You do not have permission to open that page.');
        redirect(url(home_for_role($user['role'])));
    }
}
