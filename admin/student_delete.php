<?php
require __DIR__ . '/../includes/bootstrap.php';
require __DIR__ . '/../includes/people.php';
require_login(['admin']);
require_valid_post('student.php');

// Attendance rows are removed automatically (ON DELETE CASCADE).
delete_person('student', 'Student');
