<?php
require __DIR__ . '/../includes/bootstrap.php';
require_login(STAFF_ROLES);

$today = date('Y-m-d');
$totalStudents = (int) db_value('SELECT COUNT(*) FROM student');
$presentToday = (int) db_value('SELECT COUNT(*) FROM attendance WHERE attendance_date = ? AND is_present = 1', [$today]);
$markedToday = (int) db_value('SELECT COUNT(*) FROM attendance WHERE attendance_date = ?', [$today]);
$monthRate = db_value(
    'SELECT ROUND(AVG(is_present) * 100) FROM attendance WHERE attendance_date BETWEEN ? AND ?',
    [date('Y-m-01'), $today]
);

$cards = [
    ['label' => 'Total Teachers', 'value' => (int) db_value('SELECT COUNT(*) FROM teacher'), 'icon' => 'fa-chalkboard-teacher', 'color' => 'dark'],
    ['label' => 'Total Students', 'value' => $totalStudents, 'icon' => 'fa-user-graduate', 'color' => 'success'],
    ['label' => 'Present Today', 'value' => "$presentToday / $totalStudents", 'icon' => 'fa-clipboard-check', 'color' => 'info'],
    ['label' => 'Attendance This Month', 'value' => $monthRate === null ? '—' : "$monthRate%", 'icon' => 'fa-percent', 'color' => 'warning'],
    ['label' => 'Total Feedback', 'value' => (int) db_value('SELECT COUNT(*) FROM feedback'), 'icon' => 'fa-comments', 'color' => 'primary'],
];

$title = 'Dashboard';
require __DIR__ . '/include/header.php';
?>

<div class="row">
    <?php foreach ($cards as $card): ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-<?= e($card['color']) ?> shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-<?= e($card['color']) ?> text-uppercase mb-1"><?= e($card['label']) ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= e($card['value']) ?></div>
                        </div>
                        <div class="col-auto"><i class="fas <?= e($card['icon']) ?> fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="card shadow mb-4">
    <div class="card-body d-flex flex-wrap align-items-center justify-content-between">
        <div class="mb-2">
            <?php if ($totalStudents > 0 && $markedToday < $totalStudents): ?>
                <strong><?= $totalStudents - $markedToday ?></strong> student(s) still need attendance for today.
            <?php elseif ($totalStudents > 0): ?>
                Today's attendance is complete.
            <?php else: ?>
                No students yet. Add some to start taking attendance.
            <?php endif; ?>
        </div>
        <div class="mb-2">
            <a href="attendance.php" class="btn btn-primary"><i class="fas fa-clipboard-check"></i> Take Attendance</a>
            <a href="attendance_export.php?month=<?= date('Y-m') ?>" class="btn btn-outline-secondary">
                <i class="fas fa-file-csv"></i> This Month's Report
            </a>
        </div>
    </div>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
