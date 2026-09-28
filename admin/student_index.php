<?php
require __DIR__ . '/../includes/bootstrap.php';
require_login(['student']);

$student = db_one('SELECT id, first_name, last_name, email, image FROM student WHERE id = ?', [current_user()['id']]);
if ($student === null) {
    // The account was deleted while the student was logged in.
    logout_user();
    session_start();
    flash('danger', 'Your account no longer exists.');
    redirect(url('login.php'));
}

$canEdit = false;
$title = 'My Attendance';
require __DIR__ . '/include/header.php';
require __DIR__ . '/include/student_attendance.php';
require __DIR__ . '/include/footer.php';
