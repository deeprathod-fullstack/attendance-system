<?php
require __DIR__ . '/../includes/bootstrap.php';
require_login(['admin']);

$record = null;
if (isset($_GET['id'])) {
    $record = db_one('SELECT id, first_name, last_name, email, image FROM teacher WHERE id = ?', [(int) $_GET['id']]);
    if ($record === null) {
        flash('danger', 'Teacher not found.');
        redirect('teacher.php');
    }
}

$formAction = 'teacher_save.php';
$cancelUrl = 'teacher.php';
$title = $record ? 'Edit Teacher' : 'Add Teacher';
require __DIR__ . '/include/header.php';
require __DIR__ . '/include/person_form.php';
require __DIR__ . '/include/footer.php';
