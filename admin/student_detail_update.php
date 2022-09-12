<?php 
		include "include/db.php";
		
			
				$IsPresent = $_POST['is_present'];
			
				
				if($IsPresent == 1){
					$Present = -1;
				}
				
				if($IsPresent == -1){
					$Present = 1;
				}
			
	
				 $query="UPDATE `attendence` SET is_present='".$Present."' WHERE id='".$_POST['id']."' ";
				 $res = mysqli_query($con,$query);
				 $_SESSION["Update"] = "Record Update Successfully";
				 echo 1;
	?>	