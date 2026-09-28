<?php
require __DIR__ . '/../includes/bootstrap.php';
require __DIR__ . '/../includes/people.php';
require_login(['admin']);
require_valid_post('teacher.php');

save_person('teacher', 'Teacher', 'teacher.php', 'teacher_form.php');
