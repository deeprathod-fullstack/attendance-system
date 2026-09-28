<?php
/**
 * Downloads attendance as a CSV file (opens in Excel).
 *   ?month=YYYY-MM  -> only that month
 *   (no month)      -> everything
 */
require __DIR__ . '/../includes/bootstrap.php';
require_login(STAFF_ROLES);

$month = $_GET['month'] ?? '';
$where = '';
$params = [];

if ($month !== '') {
    if (!is_string($month) || !is_valid_date($month . '-01')) {
        flash('danger', 'Choose a valid month to export.');
        redirect('student.php');
    }
    $where = 'WHERE a.attendance_date BETWEEN ? AND ?';
    $params = [$month . '-01', date('Y-m-t', strtotime($month . '-01'))];
}

$rows = db_all(
    "SELECT a.attendance_date, s.id, s.first_name, s.last_name, a.is_present
     FROM attendance a
     JOIN student s ON s.id = a.student_id
     $where
     ORDER BY a.attendance_date, s.id",
    $params
);

/** Stops spreadsheet apps from treating a cell as a formula. */
function csv_cell(string $value): string
{
    return preg_match('/^[=+\-@\t\r]/', $value) ? "'" . $value : $value;
}

$filename = 'attendance-' . ($month !== '' ? $month : 'all') . '.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$out = fopen('php://output', 'w');
fwrite($out, "\xEF\xBB\xBF"); // UTF-8 BOM so Excel detects the encoding
fputcsv($out, ['Date', 'Roll No', 'First Name', 'Last Name', 'Status'], ',', '"', '');
foreach ($rows as $row) {
    fputcsv($out, [
        format_date($row['attendance_date']),
        $row['id'],
        csv_cell($row['first_name']),
        csv_cell($row['last_name']),
        (int) $row['is_present'] === 1 ? 'Present' : 'Absent',
    ], ',', '"', '');
}
fclose($out);
