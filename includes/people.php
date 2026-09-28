<?php
/**
 * Create, update and delete logic shared by students and teachers
 * (both tables have the same columns: id, first_name, last_name, email, password, image).
 */

const PEOPLE_TABLES = ['student', 'teacher'];

/**
 * Handles a submitted student/teacher form and redirects.
 *
 * @param string $table    "student" or "teacher"
 * @param string $label    Human name used in messages, e.g. "Student"
 * @param string $listPage Page to return to after saving
 * @param string $formPage Page with the form, used when validation fails
 */
function save_person(string $table, string $label, string $listPage, string $formPage): void
{
    if (!in_array($table, PEOPLE_TABLES, true)) {
        throw new InvalidArgumentException("Unknown table: $table");
    }

    $id = (int) ($_POST['id'] ?? 0);
    $input = [
        'first_name' => trim((string) ($_POST['first_name'] ?? '')),
        'last_name' => trim((string) ($_POST['last_name'] ?? '')),
        'email' => strtolower(trim((string) ($_POST['email'] ?? ''))),
    ];
    $password = (string) ($_POST['password'] ?? '');
    $formUrl = $id ? "$formPage?id=$id" : $formPage;

    $existing = null;
    if ($id) {
        $existing = db_one("SELECT id, image FROM `$table` WHERE id = ?", [$id]);
        if ($existing === null) {
            flash('danger', "$label not found.");
            redirect($listPage);
        }
    }

    $errors = validate_person($input, $password, $existing === null);
    $image = null;
    if (!$errors) {
        try {
            $image = upload_image($_FILES['image'] ?? null);
        } catch (RuntimeException $e) {
            $errors[] = $e->getMessage();
        }
    }

    if ($errors) {
        flash('danger', implode(' ', $errors));
        remember_input($input);
        redirect($formUrl);
    }

    try {
        if ($existing) {
            $fields = $input;
            if ($password !== '') {
                $fields['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            if ($image !== null) {
                $fields['image'] = $image;
            }
            $assignments = implode(', ', array_map(fn ($column) => "`$column` = ?", array_keys($fields)));
            db_execute("UPDATE `$table` SET $assignments WHERE id = ?", [...array_values($fields), $id]);

            if ($image !== null) {
                delete_upload($existing['image']);
            }
            flash('success', "$label updated successfully.");
        } else {
            db_execute(
                "INSERT INTO `$table` (first_name, last_name, email, password, image) VALUES (?, ?, ?, ?, ?)",
                [$input['first_name'], $input['last_name'], $input['email'], password_hash($password, PASSWORD_DEFAULT), $image]
            );
            flash('success', "$label added successfully.");
        }
    } catch (mysqli_sql_exception $e) {
        delete_upload($image);
        if ($e->getCode() !== DB_DUPLICATE_KEY) {
            throw $e;
        }
        flash('danger', 'That email address is already used by another ' . strtolower($label) . '.');
        remember_input($input);
        redirect($formUrl);
    }

    redirect($listPage);
}

/** Deletes a student/teacher (and their photo) from an AJAX request and responds with JSON. */
function delete_person(string $table, string $label): void
{
    if (!in_array($table, PEOPLE_TABLES, true)) {
        throw new InvalidArgumentException("Unknown table: $table");
    }

    $id = (int) ($_POST['id'] ?? 0);
    $row = db_one("SELECT image FROM `$table` WHERE id = ?", [$id]);
    if ($row === null) {
        json_response(['ok' => false, 'message' => "$label not found."], 404);
    }

    db_execute("DELETE FROM `$table` WHERE id = ?", [$id]);
    delete_upload($row['image']);

    flash('success', "$label deleted successfully.");
    json_response(['ok' => true]);
}
