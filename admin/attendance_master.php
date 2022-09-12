<?php
	include "include/db.php";
	 $date1 = date('d-m-Y');
	 //$today_date = "2022-08-25";

	 
	if($_POST['action'] == "INSERT")
	{	
		 $roll_no = $_POST['roll_no'];
		 $is_present = $_POST['is_present'];
		  $today_date = date('Y-m-d');
		//$today_date = "2022-08-25";
		
		 $qry = "INSERT INTO `attendence` (`roll_no` , `is_present` , `today_date`) VALUES ('$roll_no','$is_present','$today_date')";
		 $res = mysqli_query($con,$qry);
		 
		 echo $res;
		
	} 
		if($_POST['action'] == "SELECT_STUDENT_LIMIT_1"){
		
		if($_POST['roll_no']){
				$roll_no = $_POST['roll_no'];
		}
		else{
			$roll_no = 1;
		}
					$checkdate = date('Y-m-d');

					
					$query="SELECT * from student WHERE s_id = $roll_no";
					$result=mysqli_query($con,$query);
					$rowcount1=mysqli_num_rows($result);
					if($rowcount1 == 0){
						echo "Attendance already taken";
					}
					else{
					while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){ 
							// change start deep
							$roll = $row['s_id'];
							$querycheck = 'SELECT * from attendence WHERE  roll_no = '.$roll.' AND today_date = "'.$checkdate.'"';
							//echo $querycheck;
							$resultcheck = mysqli_query($con,$querycheck);
							
							$rowcount=mysqli_num_rows($resultcheck);
							
							if($rowcount == 1){
								echo "Attendance already taken" ;
						
							}
							else{
								
						
					?>
				
					<div class="row">
					
						<div class="col-md-4">
						<div class="card border-primary shadow mb-1 h-100 py-2">
						<div class="card-body">
							<h5 style="color:black">Date : <?php echo $date1; ?></h4> 
							<h5 style="color:black">Name : <?php echo $row["first_name"]." ".$row["last_name"] ?></h4> 
							<h5 style="color:black">Roll No : <?php echo $row["s_id"]; ?></h4>   
							<input type="hidden" id="roll_no" value="<?php echo $row["s_id"] ?>"/>
						</div>
						</div>
						</div>
						
						
						<div class="col-md-3">
						<img style="border: 2px solid #4e73df" class="img-responsive" src="upload/<?php echo $row["image"]; ?>" height="200" width="200" />
						</div>
						
					</div>
					
				<?php } 
					}
					}
		
		}	
?>