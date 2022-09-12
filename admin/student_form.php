<?php 
	include "include/header.php";
	//session_start();
	if($_SESSION['is_login'] != true || $_SESSION['login_type'] == 'student'){
		header("location: index.php");
	}
	
   $title = "Student";
   $date1 = date('Y-m-d');
   
		if(isset($_GET["student_id"])) {
			$query1 = "SELECT * FROM `student` WHERE s_id=".$_GET['student_id'];
			$resul1t1=mysqli_query($con,$query1);
			$row1 = mysqli_fetch_array($resul1t1);
			

		}
 ?>

    <div class="container-fluid">
      <h1 class="h3 mb-4 text-gray-800">
        <?php echo $title; ?>
      </h1>
	  
	  
	  <?php 
		if(isset($_SESSION["Update"])){ ?>
			
				<div class="alert alert-info" alert-dismissible fade show" role="alert">
				<?php	echo $_SESSION["Update"]; ?> 
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
			<?php
			unset($_SESSION["Update"]);
			
			
			
		}
		
		if(isset($_SESSION["Insert"])){ ?>
			
				<div class="alert alert-info" alert-dismissible fade show" role="alert">
				<?php	echo $_SESSION["Insert"]; ?> 
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<?php
			unset($_SESSION["Insert"]);
		}
	  ?>
	  
	  
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?>  
			  
			  <?php if(isset($_GET["student_id"])) {
						echo "Update";
					}
					else{
						echo "Add";
					}
				?>
			  </h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <form class="user" method="POST" enctype="multipart/form-data" action="student_master.php">
		  
		  <?php if(isset($_GET["student_id"])) { ?>
		   <input type="hidden" name="s_id" value="<?php echo $row1["s_id"]; ?>" />
		  <?php } ?>
		  
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                <label>First name</label> 
                 
				 
				   <?php if(isset($_GET["student_id"])) { ?>
					<input type="text"  name="first_name" class="form-control" id="first_name" placeholder="Enter First name" required value="<?php echo $row1["first_name"]; ?>" />
					<?php 
					} else{
					?>
					<input type="text"  name="first_name" class="form-control" id="first_name" placeholder="Enter First name" required />
					<?php
					} ?>
				 
				 
				 </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                <label>Last name</label> 
				
					<?php if(isset($_GET["student_id"])) { ?>
					<input type="text"  name="last_name" class="form-control" id="last_name" placeholder="Enter Last name" required value="<?php echo $row1["last_name"]; ?>" />
					<?php 
					} else{
					?>
						<input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter Last name" required />
					<?php
					} ?>
			
				</div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                <label>Email</label> 
				
				<?php if(isset($_GET["student_id"])) { ?>
					<input type="email" name="email"  class="form-control" id="email" placeholder="Enter email" required value="<?php echo $row1["email"]; ?>" />
					<?php 
					} else{
					?>
						  <input type="email" name="email"  class="form-control" id="email" placeholder="Enter email" required />
					<?php
					} ?>
					
				</div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                <label>Password</label> 
              
				
				<?php if(isset($_GET["student_id"])) { ?>
					<input type="text" name="password"  class="form-control" id="password" placeholder="Password" required value="<?php echo "";/*$row1["password"];*/ ?>" />
					<?php 
					} else{
					?>
						    <input type="text" name="password"  class="form-control" id="password" placeholder="Password" required />
					<?php
					} ?>
				
				
				
				</div>
              </div>
              
              <div class="col-lg-4">
                <div class="form-group">
                <label>Photo Upload</label> 
				
				
               
					<?php if(isset($_GET["student_id"])) { ?>
				
				<input type="file" name="image" id="image"  size="30" value = "<?php echo $row1['image']; ?>" />
				
				<input type="hidden" name="image1"  id="image1"  value="<?php echo $row1['image'];?>"> 
				<br/>
				 <?php 
				 if($row1['image'])
				 {	
				 ?>
				
					<br/> 
					<img src="<?php echo "upload/".$row1['image'];?>" width="150px" class="imgclass" />
				 <?php
				 }
				 else
				 {
					echo "<strong>No image was uploded for this record!</strong>";
				 }
				 ?>
				
				<?php 
					} else{
					?>
				
				 <input type="file" class="form-control-file" id="image" name="image" required />
				
				<?php
					} ?>
				
				
				</div>
              </div>
		
              <div class="col-lg-4">
			  <br/>
                <button type="submit" class="btn btn-primary">
				
				 <?php if(isset($_GET["student_id"])) {
						echo "Update";
					}
					else{
						echo "Add";
					}
				?>
				
				</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div><?php  include "include/footer.php"; ?>  	
				