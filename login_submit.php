<?php
require __DIR__ . '/includes/bootstrap.php';
require_valid_post(url('login.php'));

$role = (string) ($_POST['login_type'] ?? '');
$email = strtolower(trim((string) ($_POST['email'] ?? '')));
$password = (string) ($_POST['password'] ?? '');

$account = null;
if (isset(ROLE_TABLES[$role]) && $email !== '' && $password !== '') {
    $table = ROLE_TABLES[$role];
    $account = db_one("SELECT id, first_name, last_name, password FROM `$table` WHERE email = ?", [$email]);
}

// Verify against a dummy hash for unknown emails so response time does not reveal which accounts exist.
$hash = $account['password'] ?? '$2y$10$Td/7vDzho7nAP4Y5qxTpu.8/AA8vOCzVzNvWO7e9uKPnR0OaTRNAW';
if (!password_verify($password, $hash) || $account === null) {
    flash('danger', 'Invalid email, password or role.');
    remember_input(['email' => $email, 'login_type' => $role]);
    redirect(url('login.php'));
}

// Keep hashes up to date if PHP's default algorithm or cost changes.
if (password_needs_rehash($account['password'], PASSWORD_DEFAULT)) {
    db_execute("UPDATE `$table` SET password = ? WHERE id = ?", [password_hash($password, PASSWORD_DEFAULT), $account['id']]);
}

login_user($role, $account);
redirect(url(home_for_role($role)));
