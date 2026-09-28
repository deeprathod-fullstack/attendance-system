<?php
/**
 * Student profile card, attendance summary and history table.
 *
 * Expects: $student (row from the student table), $canEdit (bool - show the change buttons).
 */
defined('APP_ROOT') || exit;

$records = db_all(
    'SELECT id, attendance_date, is_present FROM attendance WHERE student_id = ? ORDER BY attendance_date DESC',
    [$student['id']]
);
$presentDays = count(array_filter($records, fn ($row) => (int) $row['is_present'] === 1));
$absentDays = count($records) - $presentDays;
$rate = $records ? round($presentDays / count($records) * 100) : null;

$summary = [
    ['label' => 'Present days', 'value' => $presentDays, 'color' => 'success'],
    ['label' => 'Absent days', 'value' => $absentDays, 'color' => 'danger'],
    ['label' => 'Attendance', 'value' => $rate === null ? '—' : "$rate%", 'color' => 'primary'],
];
?>
<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card shadow h-100">
            <div class="card-body text-center">
                <img src="<?= e(image_url($student['image'])) ?>" alt="" class="img-thumbnail profile-photo mb-3">
                <h5 class="text-gray-900 mb-1"><?= e($student['first_name'] . ' ' . $student['last_name']) ?></h5>
                <p class="mb-1">Roll No: <strong><?= (int) $student['id'] ?></strong></p>
                <p class="text-muted mb-0"><?= e($student['email']) ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-8 mb-4">
        <div class="row">
            <?php foreach ($summary as $item): ?>
                <div class="col-md-4 mb-3">
                    <div class="card border-left-<?= e($item['color']) ?> shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-<?= e($item['color']) ?> text-uppercase mb-1"><?= e($item['label']) ?></div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= e($item['value']) ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Attendance history</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered js-datatable" width="100%" data-order='[[0, "desc"]]'>
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Status</th>
                    <?php if ($canEdit): ?><th data-orderable="false">Action</th><?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($records as $row): ?>
                    <?php $present = (int) $row['is_present'] === 1; ?>
                    <tr>
                        <td data-order="<?= e($row['attendance_date']) ?>"><?= e(format_date($row['attendance_date'])) ?></td>
                        <td>
                            <span class="badge badge-<?= $present ? 'success' : 'danger' ?>"><?= $present ? 'Present' : 'Absent' ?></span>
                        </td>
                        <?php if ($canEdit): ?>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-primary js-toggle-attendance"
                                        data-id="<?= (int) $row['id'] ?>" data-present="<?= $present ? 1 : 0 ?>"
                                        data-date="<?= e(format_date($row['attendance_date'])) ?>">
                                    Mark <?= $present ? 'absent' : 'present' ?>
                                </button>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
