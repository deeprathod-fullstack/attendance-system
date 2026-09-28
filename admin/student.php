<?php
require __DIR__ . '/../includes/bootstrap.php';
require_login(STAFF_ROLES);

$students = db_all(
    'SELECT s.id, s.first_name, s.last_name, s.email,
            COALESCE(SUM(a.is_present = 1), 0) AS present_days,
            COALESCE(SUM(a.is_present = 0), 0) AS absent_days
     FROM student s
     LEFT JOIN attendance a ON a.student_id = s.id
     GROUP BY s.id, s.first_name, s.last_name, s.email
     ORDER BY s.id'
);
$canDelete = has_role('admin');

$title = 'Students';
require __DIR__ . '/include/header.php';
?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-wrap align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Student list</h6>
        <div class="d-flex flex-wrap">
            <form action="attendance_export.php" method="get" class="form-inline mr-2 my-1">
                <label for="month" class="sr-only">Month</label>
                <input type="month" id="month" name="month" class="form-control form-control-sm mr-1" value="<?= date('Y-m') ?>">
                <button type="submit" class="btn btn-sm btn-outline-secondary" title="Leave the month empty to export everything">
                    <i class="fas fa-file-csv"></i> Export CSV
                </button>
            </form>
            <a href="student_form.php" class="btn btn-sm btn-primary my-1"><i class="fas fa-plus"></i> Add Student</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered js-datatable" width="100%">
                <thead>
                <tr>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>Attendance</th>
                    <th data-orderable="false">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($students as $student): ?>
                    <?php
                    $name = $student['first_name'] . ' ' . $student['last_name'];
                    $total = $student['present_days'] + $student['absent_days'];
                    $rate = $total ? round($student['present_days'] / $total * 100) : null;
                    ?>
                    <tr>
                        <td><?= (int) $student['id'] ?></td>
                        <td><?= e($name) ?></td>
                        <td><?= e($student['email']) ?></td>
                        <td><?= (int) $student['present_days'] ?></td>
                        <td><?= (int) $student['absent_days'] ?></td>
                        <td data-order="<?= $rate ?? -1 ?>"><?= $rate === null ? '—' : $rate . '%' ?></td>
                        <td class="text-nowrap">
                            <a class="btn btn-sm btn-dark" href="student_detail.php?id=<?= (int) $student['id'] ?>" title="View attendance"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-sm btn-primary" href="student_form.php?id=<?= (int) $student['id'] ?>" title="Edit"><i class="fas fa-edit"></i></a>
                            <?php if ($canDelete): ?>
                                <button type="button" class="btn btn-sm btn-danger js-delete" title="Delete"
                                        data-url="student_delete.php" data-id="<?= (int) $student['id'] ?>" data-name="<?= e($name) ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
