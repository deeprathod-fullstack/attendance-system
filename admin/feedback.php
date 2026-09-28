<?php
require __DIR__ . '/../includes/bootstrap.php';
require_login(STAFF_ROLES);

$feedback = db_all('SELECT id, name, email, phone, message, created_at FROM feedback ORDER BY created_at DESC, id DESC');
$canDelete = has_role('admin');

$title = 'Feedback';
require __DIR__ . '/include/header.php';
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Messages from the contact form</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered js-datatable" width="100%" data-order='[[0, "desc"]]'>
                <thead>
                <tr>
                    <th>Received</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <?php if ($canDelete): ?><th data-orderable="false">Action</th><?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($feedback as $item): ?>
                    <tr>
                        <td class="text-nowrap" data-order="<?= e($item['created_at']) ?>"><?= e(date('d-m-Y H:i', strtotime($item['created_at']))) ?></td>
                        <td><?= e($item['name']) ?></td>
                        <td><a href="mailto:<?= e($item['email']) ?>"><?= e($item['email']) ?></a></td>
                        <td class="text-nowrap"><?= e($item['phone']) ?></td>
                        <td><?= nl2br(e($item['message'])) ?></td>
                        <?php if ($canDelete): ?>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger js-delete" title="Delete"
                                        data-url="feedback_delete.php" data-id="<?= (int) $item['id'] ?>" data-name="this message">
                                    <i class="fas fa-trash"></i>
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

<?php require __DIR__ . '/include/footer.php'; ?>
