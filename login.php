<?php
require __DIR__ . '/includes/bootstrap.php';

if ($user = current_user()) {
    redirect(url(home_for_role($user['role'])));
}

$old = take_old_input();
$selectedRole = $old['login_type'] ?? 'admin';
$roles = ['admin' => 'Admin', 'teacher' => 'Teacher', 'student' => 'Student'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | Attendance System</title>
    <link rel="icon" type="image/x-icon" href="library/assets/favicon.ico">
    <link rel="stylesheet" href="admin/assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="library/login/css/style.css">
</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <?php foreach (take_flashes() as $flash): ?>
                    <div class="alert alert-<?= e($flash['type']) ?> alert-dismissible fade show" role="alert">
                        <?= e($flash['message']) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <?php endforeach; ?>

                <div class="wrap">
                    <div class="img" style="background-image: url(library/login/images/login.png);"></div>
                    <div class="login-wrap p-4 p-md-5">
                        <h3 class="mb-4">Login</h3>
                        <form action="login_submit.php" class="signin-form" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group mt-3">
                                <input type="email" id="email" name="email" class="form-control" required autocomplete="username"
                                       value="<?= e($old['email'] ?? '') ?>">
                                <label class="form-control-placeholder" for="email">Email</label>
                            </div>
                            <div class="form-group">
                                <input type="password" id="password-field" name="password" class="form-control" required autocomplete="current-password">
                                <label class="form-control-placeholder" for="password-field">Password</label>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" title="Show password"></span>
                            </div>
                            <div class="form-group mt-3">
                                <select id="login_type" name="login_type" class="form-control" required aria-label="Login as">
                                    <?php foreach ($roles as $value => $label): ?>
                                        <option value="<?= e($value) ?>"<?= $value === $selectedRole ? ' selected' : '' ?>><?= e($label) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
                            </div>
                            <p class="text-center mb-0"><a class="text-dark" href="index.php">&larr; Back to home</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="library/login/js/jquery.min.js"></script>
<script src="library/login/js/popper.js"></script>
<script src="library/login/js/bootstrap.min.js"></script>
<script src="library/login/js/main.js"></script>
</body>
</html>
