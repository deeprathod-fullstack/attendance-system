<?php  
	include "include/header.php";
      //session_start();
      if($_SESSION['is_login'] != true || $_SESSION['login_type'] != 'admin'){
        header("location: index.php");
      }
      
          $title = "Teacher";
?>

    <div class="container-fluid">
      <h1 class="h3 mb-4 text-gray-800">
        <?php echo $title; ?>
      </h1>
	  
	    <?php 
		if(isset($_SESSION["Delete"])){ ?>
			
				<div class="alert alert-info" alert-dismissible fade show" role="alert">
				<?php	echo $_SESSION["Delete"]; ?> 
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
			<?php
			unset($_SESSION["Delete"]);
		}
		
		?>
		
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?> list</h6>
			<a href="teacher_form.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
		    </div>
			
        <!-- Card Body -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
			  <tbody>
			  <?php
                                                                      
             $query1 = "SELECT * FROM `teacher`";
			  $resul1t1=mysqli_query($con,$query1);
	  
	  
			  while($row1=mysqli_fetch_array($resul1t1)){  
			  $t_id =  $row1['t_id'];
              ?>
       
                <tr>
                  <td>
                    <?php echo $t_id; ?>
                  </td>
                  <td>
                    <?php echo $row1["first_name"]; ?>
                  </td>
                  <td>
                    <?php echo $row1["last_name"]; ?>
                  </td>
                  <td>
                    <?php echo $row1["email"]; ?>
                  </td>
				  
				    <td>
					<img src="upload/<?php echo $row1["image"]; ?>" height="70"/>
            
                  </td>
				  
                  <td>
                  <a class="btn btn-sm btn-primary" href="teacher_form.php?teacher_id=<?php echo $t_id; ?>"><i class="fas fa-edit"></i> </a> 
				  
				  
				   <button type="button" class="btn btn-sm btn-danger delete-btn" data-id='<?php echo $t_id; ?>'><span class='fa fa-trash'></span></button>
				  
               
				  </td>
                </tr>
				<?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
	

	
	    <script src="assets/custom/js/teacher.js"></script>
  <?php  include "include/footer.php"; ?>