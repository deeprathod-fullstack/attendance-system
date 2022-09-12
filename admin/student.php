  <?php  
		include "include/header.php";
		//session_start();
		if($_SESSION['is_login'] != true || $_SESSION['login_type'] == 'student'){
			header("location: index.php");
		}
 	 
	  $title = "Student";
	  
	  ?>
		<div class="container-fluid">
			<h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
		
		
						<div class="card shadow mb-4">
									<div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?> list</h6>
                                   <a href="student_form.php" class="btn btn-primary">
										 <i class="fas fa-plus"></i> Add
									</a>
                                </div>
                                <!-- Card Body -->
                                		  
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Roll No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
											<th>Total Present Days</th>	
											<th>Total Absent Days</th>	
											<th>Action</th>	
                               
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
						<tr>
						
						
						<?php
							
						
						$absent_days = 0;
						$present_days = 0;
						
						$query1 = "SELECT * FROM `student`";
						$resul1t1=mysqli_query($con,$query1);
					
					
						while($row1=mysqli_fetch_array($resul1t1)){ 
						 $student_id =  $row1['s_id'];
						 ?>
						 	<td><?php echo $row1["s_id"]; ?></td>
							<td><?php echo $row1["first_name"]; ?></td>
							<td><?php echo $row1["last_name"]; ?></td>
						 
						 <?php
						 $qry2 = "SELECT is_present, roll_no , SUM(is_present) as present_days FROM `attendence` WHERE is_present = 1 AND roll_no = $student_id  GROUP BY `roll_no`";
						 $result2 = mysqli_query($con, $qry2);
						 while ($row2 = mysqli_fetch_array($result2)) {
						 $present_days	= $row2["present_days"];
						
						}
						?>
						
						<?php
						 $qry3 = "SELECT is_present, roll_no , SUM(is_present) as absent_days FROM `attendence` WHERE is_present = -1 AND roll_no = $student_id  GROUP BY `roll_no`";
						 $result3 = mysqli_query($con, $qry3);
						 while ($row3 = mysqli_fetch_array($result3)) {
						 $absent_days	= $row3["absent_days"];
						
						}
						?>
							
							 <td><?php echo $present_days; ?></td>
							 <td><?php echo abs($absent_days); ?></td>
							 <td>
							 
								 <a class="btn btn-sm btn-primary" href="student_form.php?student_id=<?php echo $student_id; ?>"><i class="fas fa-edit"></i> </a>
								 
								 <a class="btn btn-sm btn-dark" href="student_detail.php?student_id=<?php echo $student_id; ?>"> <i class="fas fa-eye"></i></a>
								 
								</td>
						</tr>
						
						<?php
						$absent_days = 0;
						$present_days = 0;
						}
						?>
                                      
                                    
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            </div>
		 
				
  <?php  include "include/footer.php"; ?>	
