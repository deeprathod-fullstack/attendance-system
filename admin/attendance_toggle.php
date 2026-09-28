<?php
/**
 * Switches one attendance record between present and absent (JSON, used by student_detail.js).
 */
require __DIR__ . '/../includes/bootstrap.php';
require_login(STAFF_ROLES);
require_valid_post('student.php');

$stmt = db_execute('UPDATE attendance SET is_present = 1 - is_present WHERE id = ?', [(int) ($_POST['id'] ?? 0)]);
if ($stmt->affected_rows === 0) {
    json_response(['ok' => false, 'message' => 'Attendance record not found.'], 404);
}

flash('success', 'Attendance updated successfully.');
json_response(['ok' => true]);
