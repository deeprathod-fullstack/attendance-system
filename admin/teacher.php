<?php
require __DIR__ . '/../includes/bootstrap.php';
require_login(['admin']);

$teachers = db_all('SELECT id, first_name, last_name, email, image FROM teacher ORDER BY id');

$title = 'Teachers';
require __DIR__ . '/include/header.php';
?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Teacher list</h6>
        <a href="teacher_form.php" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add Teacher</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered js-datatable" width="100%">
                <thead>
                <tr>
                    <th data-orderable="false">Photo</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th data-orderable="false">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($teachers as $teacher): ?>
                    <?php $name = $teacher['first_name'] . ' ' . $teacher['last_name']; ?>
                    <tr>
                        <td><img src="<?= e(image_url($teacher['image'])) ?>" alt="" class="rounded table-photo"></td>
                        <td><?= (int) $teacher['id'] ?></td>
                        <td><?= e($name) ?></td>
                        <td><?= e($teacher['email']) ?></td>
                        <td class="text-nowrap">
                            <a class="btn btn-sm btn-primary" href="teacher_form.php?id=<?= (int) $teacher['id'] ?>" title="Edit"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-sm btn-danger js-delete" title="Delete"
                                    data-url="teacher_delete.php" data-id="<?= (int) $teacher['id'] ?>" data-name="<?= e($name) ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
