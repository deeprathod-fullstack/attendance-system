<?php
/**
 * JSON endpoint used by attendance.js.
 *   GET  ?action=next&date=Y-m-d                        -> next unmarked student for that date
 *   POST action=mark, date, student_id, is_present (0/1) -> record attendance
 */
require __DIR__ . '/../includes/bootstrap.php';
require_login(STAFF_ROLES);

$action = $_REQUEST['action'] ?? '';
$date = $_REQUEST['date'] ?? '';

if (!is_valid_date($date) || $date > date('Y-m-d')) {
    json_response(['ok' => false, 'message' => 'Invalid date.'], 422);
}

const UNMARKED_STUDENTS = 'FROM student s
    WHERE NOT EXISTS (SELECT 1 FROM attendance a WHERE a.student_id = s.id AND a.attendance_date = ?)';

if ($action === 'next') {
    $student = db_one('SELECT s.id, s.first_name, s.last_name, s.image ' . UNMARKED_STUDENTS . ' ORDER BY s.id LIMIT 1', [$date]);

    if ($student === null) {
        json_response(['ok' => true, 'done' => true]);
    }

    json_response([
        'ok' => true,
        'done' => false,
        'remaining' => (int) db_value('SELECT COUNT(*) ' . UNMARKED_STUDENTS, [$date]),
        'student' => [
            'id' => (int) $student['id'],
            'name' => trim($student['first_name'] . ' ' . $student['last_name']),
            'photo' => image_url($student['image']),
        ],
    ]);
}

if ($action === 'mark') {
    require_valid_post('attendance.php');

    $studentId = (int) ($_POST['student_id'] ?? 0);
    $isPresent = $_POST['is_present'] ?? '';
    if (!in_array($isPresent, ['0', '1'], true)) {
        json_response(['ok' => false, 'message' => 'Invalid attendance status.'], 422);
    }
    if (db_value('SELECT id FROM student WHERE id = ?', [$studentId]) === null) {
        json_response(['ok' => false, 'message' => 'Student not found.'], 404);
    }

    try {
        db_execute(
            'INSERT INTO attendance (student_id, attendance_date, is_present) VALUES (?, ?, ?)',
            [$studentId, $date, $isPresent]
        );
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() !== DB_DUPLICATE_KEY) {
            throw $e;
        }
        json_response(['ok' => false, 'message' => 'Attendance for this student was already recorded.'], 409);
    }

    json_response(['ok' => true]);
}

json_response(['ok' => false, 'message' => 'Unknown action.'], 400);
