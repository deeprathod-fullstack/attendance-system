<?php 
		include "include/db.php";
		
			
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$email = $_POST['email'];
				$password = $_POST['password'];

				$password_hash = password_hash($password, PASSWORD_DEFAULT);
				
			
			if($_POST['s_id']){
			
				if($_FILES["image"]["name"] != "")
				{
				    $vcnt=time()."-".rand(100000,600000);
					$img_nm = $_FILES["image"]["name"];
					$tmp_img = $_FILES["image"]["tmp_name"];
					$ii= $vcnt.".jpg";                           
					move_uploaded_file($tmp_img,"upload/".$ii."");
				}
				else
				{
					$ii=$_POST['image1'];	 															
				}
			
			
				$query="UPDATE `student` SET first_name='".$first_name."' , last_name='".$last_name."'  , email='".$email."' , email='".$email."' , password='".$password_hash."' , image='".$ii."'  WHERE s_id='".$_POST['s_id']."' ";
				 $res = mysqli_query($con,$query);
				 
				 $_SESSION["Update"] = "Record Update Successfully";
				 
					header("location:student_form.php?student_id=".$_POST['s_id']);
			}
			else{
			
			    $uploads_dir = 'upload';
				$_FILES["image"]["name"]; 
				$tmp_name = $_FILES["image"]["tmp_name"];
				$vcnt=time()."-".rand(100000,600000);
				$name = basename($_FILES["image"]["name"]);
				$ii= $vcnt.".jpg"; 
				move_uploaded_file($tmp_name, "$uploads_dir/$ii" );
			
			
				
				$qry ="INSERT INTO `student` (`first_name` , `last_name` , `email` , `password`, `image`  ) VALUES ('".$first_name."' , '".$last_name."' , '".$email."' , '".$password_hash."' ,'".$ii."' )  ";
				$res = mysqli_query($con,$qry);
				
				 $_SESSION["Insert"] = "Record Insert Successfully";
				
				header("location:student_form.php");
				
		
			}


				
				
?>	