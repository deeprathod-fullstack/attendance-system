<?php
require __DIR__ . '/../includes/bootstrap.php';
require __DIR__ . '/../includes/people.php';
require_login(STAFF_ROLES);
require_valid_post('student.php');

save_person('student', 'Student', 'student.php', 'student_form.php');
