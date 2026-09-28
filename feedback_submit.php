<?php
/**
 * Handles the public "Let's Get In Touch" form on the landing page.
 */
require __DIR__ . '/includes/bootstrap.php';
require_valid_post(url('index.php#contact'));

$input = [
    'name' => trim((string) ($_POST['name'] ?? '')),
    'email' => trim((string) ($_POST['email'] ?? '')),
    'phone' => trim((string) ($_POST['phone'] ?? '')),
    'message' => trim((string) ($_POST['message'] ?? '')),
];

$errors = [];
if ($input['name'] === '' || strlen($input['name']) > 100) {
    $errors[] = 'Enter your name (up to 100 characters).';
}
if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL) || strlen($input['email']) > 100) {
    $errors[] = 'Enter a valid email address.';
}
if (!preg_match('/^[0-9+()\-\s]{7,20}$/', $input['phone'])) {
    $errors[] = 'Enter a valid phone number.';
}
if ($input['message'] === '' || strlen($input['message']) > 2000) {
    $errors[] = 'Enter a message (up to 2000 characters).';
}

if ($errors) {
    flash('danger', implode(' ', $errors));
    remember_input($input);
    redirect(url('index.php#contact'));
}

db_execute(
    'INSERT INTO feedback (name, email, phone, message) VALUES (?, ?, ?, ?)',
    [$input['name'], $input['email'], $input['phone'], $input['message']]
);

flash('success', 'Thank you! Your feedback has been sent.');
redirect(url('index.php#contact'));
