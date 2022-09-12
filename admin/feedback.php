<?php  
	include "include/header.php";
    //session_start();
		if($_SESSION['is_login'] != true || $_SESSION['login_type'] == 'student'){
			header("location: index.php");	
		}
    
          $title = "Feedback";
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
		
		    </div>
			
        <!-- Card Body -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Message</th>
                </tr>
              </thead>
			  <tbody>
			  <?php
                                                                      
				$query1 = "SELECT * FROM `feedback`";
				$resul1t1=mysqli_query($con,$query1);
			   while($row1=mysqli_fetch_array($resul1t1)){  
			
              ?>
       
                <tr>
                  <td>
                    <?php echo $row1['id']; ?>
                  </td>
                  <td>
                    <?php echo $row1["name"]; ?> 
                  </td>				

                  <td>
                    <?php echo $row1["email"]; ?>
                  </td>
                  <td>
                    <?php echo $row1["phone"]; ?>
                  </td>
				  <td>
                    <?php echo $row1["message"]; ?>
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