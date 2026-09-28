<?php
/**
 * Admin layout - top half. Expects $title to be set and require_login() to have run.
 * Staff (admin/teacher) get the sidebar; students get a simple top bar.
 */
defined('APP_ROOT') || exit;

$user = current_user();
$isStaff = in_array($user['role'], STAFF_ROLES, true);
$currentPage = basename($_SERVER['SCRIPT_NAME']);

$navItems = [
    ['label' => 'Dashboard', 'icon' => 'fa-tachometer-alt', 'href' => 'index.php', 'pages' => ['index.php'], 'roles' => STAFF_ROLES],
    ['label' => 'Attendance', 'icon' => 'fa-clipboard-check', 'href' => 'attendance.php', 'pages' => ['attendance.php'], 'roles' => STAFF_ROLES],
    ['label' => 'Teachers', 'icon' => 'fa-chalkboard-teacher', 'href' => 'teacher.php', 'pages' => ['teacher.php', 'teacher_form.php'], 'roles' => ['admin']],
    ['label' => 'Students', 'icon' => 'fa-user-graduate', 'href' => 'student.php', 'pages' => ['student.php', 'student_form.php', 'student_detail.php'], 'roles' => STAFF_ROLES],
    ['label' => 'Feedback', 'icon' => 'fa-comments', 'href' => 'feedback.php', 'pages' => ['feedback.php'], 'roles' => STAFF_ROLES],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?= e(csrf_token()) ?>">
    <title><?= e($title) ?> | Attendance System</title>

    <link rel="icon" type="image/x-icon" href="../library/assets/favicon.ico">
    <link rel="stylesheet" href="assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="assets/vendor/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/vendor/toastr/toastr.min.css">
    <link rel="stylesheet" href="assets/vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="assets/custom/css/style.css">
    <script src="assets/vendor/jquery/jquery.min.js"></script>
</head>
<body id="page-top">
<div id="wrapper">

    <?php if ($isStaff): ?>
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-user-edit"></i></div>
                <div class="sidebar-brand-text mx-3">Attendance</div>
            </a>
            <hr class="sidebar-divider my-0">

            <?php foreach ($navItems as $item): ?>
                <?php if (in_array($user['role'], $item['roles'], true)): ?>
                    <li class="nav-item<?= in_array($currentPage, $item['pages'], true) ? ' active' : '' ?>">
                        <a class="nav-link" href="<?= e($item['href']) ?>">
                            <i class="fas fa-fw <?= e($item['icon']) ?>"></i>
                            <span><?= e($item['label']) ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>

            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle" aria-label="Toggle sidebar"></button>
            </div>
        </ul>
    <?php endif; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <?php if ($isStaff): ?>
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" aria-label="Toggle sidebar">
                        <i class="fa fa-bars"></i>
                    </button>
                <?php else: ?>
                    <span class="navbar-brand text-gray-800 font-weight-bold">
                        <i class="fas fa-user-edit text-primary mr-1"></i> Attendance System
                    </span>
                <?php endif; ?>

                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <?= e($user['name']) ?>
                                <span class="badge badge-secondary text-uppercase ml-1"><?= e($user['role']) ?></span>
                            </span>
                            <img class="img-profile rounded-circle" src="assets/img/undraw_profile.svg" alt="">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="logout.php">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800"><?= e($title) ?></h1>
                <?php render_flashes(); ?>
