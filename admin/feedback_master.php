<?php 
		include "include/db.php";
		error_reporting(E_ALL ^ E_WARNING);
		
			
				echo $name = $_POST['name'];
				echo $email = $_POST['email'];
				echo $number = $_POST['number'];
				echo $msg = $_POST['msg'];			
			
				$query = "INSERT INTO `feedback` (`name`, `email`, `phone`, `message`) VALUES ( '".$name."', '".$email."', '".$number."', '".$msg."')";
				
				$res = mysqli_query($con,$query);
				
				if($res){
					session_start();
					$_SESSION['feedback'] = true;
					header("location: ../index.php#contact");
				}
				
				
?>	