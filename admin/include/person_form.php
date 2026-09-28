<?php
/**
 * Add/edit form shared by students and teachers.
 *
 * Expects: $record (array|null - null when adding), $formAction, $cancelUrl.
 */
defined('APP_ROOT') || exit;

$isEdit = $record !== null;
$values = take_old_input() + ($record ?? []);
?>
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="post" action="<?= e($formAction) ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?= (int) $record['id'] ?>">
            <?php endif; ?>

            <div class="form-row">
                <div class="form-group col-lg-4">
                    <label for="first_name">First name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" maxlength="50" required
                           value="<?= e($values['first_name'] ?? '') ?>">
                </div>
                <div class="form-group col-lg-4">
                    <label for="last_name">Last name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" maxlength="50" required
                           value="<?= e($values['last_name'] ?? '') ?>">
                </div>
                <div class="form-group col-lg-4">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" maxlength="100" required
                           value="<?= e($values['email'] ?? '') ?>">
                </div>
                <div class="form-group col-lg-4">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" minlength="6"
                           autocomplete="new-password" <?= $isEdit ? '' : 'required' ?>>
                    <small class="form-text text-muted">
                        <?= $isEdit ? 'Leave blank to keep the current password.' : 'At least 6 characters.' ?>
                    </small>
                </div>
                <div class="form-group col-lg-4">
                    <label for="image">Photo</label>
                    <input type="file" id="image" name="image" class="form-control-file" accept="image/jpeg,image/png,image/webp">
                    <small class="form-text text-muted">Optional. JPG, PNG or WEBP, up to 2 MB.</small>
                </div>
                <?php if ($isEdit): ?>
                    <div class="form-group col-lg-4">
                        <img src="<?= e(image_url($record['image'])) ?>" alt="Current photo" class="img-thumbnail form-photo">
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> <?= $isEdit ? 'Save changes' : 'Add' ?></button>
            <a href="<?= e($cancelUrl) ?>" class="btn btn-link">Cancel</a>
        </form>
    </div>
</div>
