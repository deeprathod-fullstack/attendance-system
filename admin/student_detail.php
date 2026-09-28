<?php
require __DIR__ . '/../includes/bootstrap.php';
require_login(STAFF_ROLES);

$student = db_one('SELECT id, first_name, last_name, email, image FROM student WHERE id = ?', [(int) ($_GET['id'] ?? 0)]);
if ($student === null) {
    flash('danger', 'Student not found.');
    redirect('student.php');
}

$canEdit = true;
$title = 'Student Attendance';
$pageScripts = ['assets/custom/js/student_detail.js'];
require __DIR__ . '/include/header.php';
?>

<p><a href="student.php"><i class="fas fa-arrow-left"></i> Back to students</a></p>

<?php
require __DIR__ . '/include/student_attendance.php';
require __DIR__ . '/include/footer.php';
