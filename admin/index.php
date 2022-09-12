  <?php  
	include "include/header.php";
	//session_start();
if($_SESSION['is_login'] != true){
    header("location: ../login.php");	
}
if($_SESSION['login_type'] == 'student'){
    header("location: student_index.php");
}
   ?>

<?php 
	$sql1 = "SELECT Count(*) as total_teacher FROM teacher";
	$res1=mysqli_query($con,$sql1);
	$row1=mysqli_fetch_array($res1);
	
	$sql2 = "SELECT Count(*) as total_student FROM student";
	$res2=mysqli_query($con,$sql2);
	$row2=mysqli_fetch_array($res2);
	
	$sql3 = "SELECT Count(*) as total_feedback FROM feedback";
	$res3=mysqli_query($con,$sql3);
	$row3=mysqli_fetch_array($res3);
	
?>

                <div class="container-fluid">

       
                    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
					
					
					<div class="row">
						<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Total Teacher</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
											<?php echo $row1["total_teacher"]; ?>
											</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

						<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Student</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
											 <?php echo $row2["total_student"]; ?>	 
											</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
							<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Feedback</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
											 <?php echo $row3["total_feedback"]; ?>	 
											</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
                        </div>


                </div>
				
  <?php  include "include/footer.php"; ?>				