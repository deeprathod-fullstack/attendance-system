<?php
	
	include "include/header.php";
	$title = "Student Dashboard";
   // session_start();
    if($_SESSION['is_login'] != true || $_SESSION['login_type'] != 'student'){
        header("location:../login.php");	
    }

	


     if(isset($_SESSION['name'])){
    $student_id = $_SESSION['id'];
?>

    <div class="container-fluid">

	  
	  <?php 
		$query2 = "SELECT * FROM `student` WHERE s_id=".$student_id;
		$resul1t2=mysqli_query($con,$query2);
		$row2 = mysqli_fetch_array($resul1t2);
		
	  ?>
	  
	      
		<div class="row" style="margin-left: auto;
                                width: 60%;
                                ">
		<div class="col-lg-4">
		<div class="card card-body border-primary shadow mb-3">
		<img  class="img-responsive marginAuto mb-2" src="upload/<?php echo $row2["image"]; ?>" height="200" width="200" />
			
		
		<h5 style="color:black"> Roll no : <?php echo $row2["s_id"]; ?></h5>
		<h5 style="color:black">Name : <?php echo $row2["first_name"]." ".$row2["last_name"]; ?>
		<h5 style="color:black"> Email : <?php echo $row2["email"]; ?></h5>
		
		</div>
		</div>
		</div>
	
			 
      <div class="card shadow mb-4" style="margin: 30px;">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Attendence Details</h6>
        </div>
		
		

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Attendance</th>
                </tr>
              </thead>
              <tbody>
                <?php
				$query1 = "SELECT * FROM `attendence`  WHERE roll_no=".$student_id;
				$resul1t1=mysqli_query($con,$query1);
                  while($row1=mysqli_fetch_array($resul1t1)){ 
					$dt = explode("-", $row1["today_date"]);
					
			
				?>
                <tr>
                  <td><?php echo $dt[2]."-".$dt[1]."-".$dt[0];  ?> </td>
				  <?php  if($row1["is_present"] == 1 ){ 
					 $isPrsent = 1;
					 ?>
						<td>
							<span class="badge badge-success">Present</span>
					  </td>
				  <?php  } 
				  if($row1["is_present"] == -1 ){
					$isPrsent = -1;
					?>
						<td>
						<span class="badge badge-danger">Absent</span>
						</td>
					<?php  } ?>
					
                </tr>
				<?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
	    <script src="assets/custom/js/student_detail.js"></script> 
<?php } ?>
<?php  include "include/footer.php"; ?>
  