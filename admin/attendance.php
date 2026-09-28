<?php
require __DIR__ . '/../includes/bootstrap.php';
require_login(STAFF_ROLES);

$today = date('Y-m-d');
$date = $_GET['date'] ?? $today;
if (!is_valid_date($date) || $date > $today) {
    flash('warning', 'Attendance can only be taken for today or a past date.');
    $date = $today;
}

$title = 'Attendance';
$pageScripts = ['assets/custom/js/attendance.js'];
require __DIR__ . '/include/header.php';
?>

<form method="get" class="form-inline mb-4">
    <label for="date" class="mr-2">Date</label>
    <input type="date" id="date" name="date" class="form-control mr-2" value="<?= e($date) ?>" max="<?= e($today) ?>" required>
    <button type="submit" class="btn btn-outline-primary">Change date</button>
</form>

<div class="card shadow mb-4" id="attendance-panel" data-date="<?= e($date) ?>">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Attendance for <?= e(format_date($date)) ?></h6>
    </div>
    <div class="card-body">
        <p id="attendance-loading" class="text-muted mb-0">Loading…</p>

        <div id="attendance-student" class="row align-items-center d-none">
            <div class="col-md-4 col-lg-3 text-center mb-3 mb-md-0">
                <img id="student-photo" class="img-thumbnail attendance-photo" src="" alt="">
            </div>
            <div class="col-md-8 col-lg-9">
                <h4 id="student-name" class="text-gray-900 mb-1"></h4>
                <p class="mb-3">Roll No: <strong id="student-roll"></strong></p>
                <button type="button" class="btn btn-danger btn-lg mr-2 js-mark" data-present="0">
                    <i class="fas fa-times"></i> Absent
                </button>
                <button type="button" class="btn btn-success btn-lg js-mark" data-present="1">
                    <i class="fas fa-check"></i> Present
                </button>
                <p class="small text-muted mt-3 mb-0">
                    <span id="remaining-count"></span> student(s) remaining ·
                    Shortcuts: <kbd>P</kbd> present, <kbd>A</kbd> absent
                </p>
            </div>
        </div>

        <div id="attendance-done" class="text-center py-4 d-none">
            <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
            <h5 class="text-gray-800">Attendance for this date is complete.</h5>
            <a href="student.php" class="btn btn-outline-primary mt-2">View students</a>
        </div>
    </div>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
