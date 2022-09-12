<?php
	 include "include/db.php";
	 error_reporting(E_ALL ^ E_WARNING);
     //session_start(); 
	 if($_SESSION['is_login'] != true){
        header("location: ../index.php");
      }
	 


?>	
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Attendance System</title>
	
	<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="assets/custom/css/style.css" rel="stylesheet">
	 <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	
	 <link rel="stylesheet" href="assets/vendor/toastr/toastr.min.css">
	 <link rel="stylesheet" href="assets/vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	 <script src="assets/vendor/jquery/jquery.min.js"></script>
</head>

<body id="page-top">

    <?php
	
        if($_SESSION['login_type'] != 'student'){
            
    ?>
        <!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa fa-user-edit"></i>
        </div>  
        
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="attendance.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Attendance</span></a>
    </li>

    <?php
        if($_SESSION['login_type'] == 'admin'){
            
    ?>
    <li class="nav-item">
        <a class="nav-link" href="teacher.php">
        <i class="fas fa-fw fa-users"></i>
        <span> Teacher</span></a>
    </li>
    <?php
        }
    ?>


    <li class="nav-item">
        <a class="nav-link" href="student.php">
        <i class="fas fa-fw fa-users"></i>
        <span>Student</span></a>
    </li>
    
    <li class="nav-item">
            <a class="nav-link" href="feedback.php">
            <i class="fas fa-fw fa-comments"></i>
            <span>Feedback</span></a>
    </li>
    
    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

           

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

             <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><h5 style="margin: auto;"><?php echo $_SESSION['name']; ?></h5></span>
                        <img class="img-profile rounded-circle"
                            src="assets/img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        
                        <a class="dropdown-item" href="logout.php">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                      
                      
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->
    <?php } 
        else{
            
    ?>     
            <!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <h2 style=" text-align:center;">Student Dashboard</h2>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

         <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-800 small"><h5 style="margin: auto;"><?php echo $_SESSION['name']; ?></h5></span>
                    <img class="img-profile rounded-circle"
                        src="assets/img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    
                    <a class="dropdown-item" href="logout.php">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                  
                  
                </div>
            </li>

        </ul>

    </nav>            
    <?php
        }
    ?>