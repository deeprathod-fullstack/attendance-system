<?php
require __DIR__ . '/../includes/bootstrap.php';
require_login(STAFF_ROLES);

$record = null;
if (isset($_GET['id'])) {
    $record = db_one('SELECT id, first_name, last_name, email, image FROM student WHERE id = ?', [(int) $_GET['id']]);
    if ($record === null) {
        flash('danger', 'Student not found.');
        redirect('student.php');
    }
}

$formAction = 'student_save.php';
$cancelUrl = 'student.php';
$title = $record ? 'Edit Student' : 'Add Student';
require __DIR__ . '/include/header.php';
require __DIR__ . '/include/person_form.php';
require __DIR__ . '/include/footer.php';
