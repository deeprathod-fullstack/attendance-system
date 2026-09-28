<?php
require __DIR__ . '/../includes/bootstrap.php';
require_login(['admin']);
require_valid_post('feedback.php');

$stmt = db_execute('DELETE FROM feedback WHERE id = ?', [(int) ($_POST['id'] ?? 0)]);
if ($stmt->affected_rows === 0) {
    json_response(['ok' => false, 'message' => 'Message not found.'], 404);
}

flash('success', 'Message deleted successfully.');
json_response(['ok' => true]);
