<?php 
 include "db.php";
 

 
			echo	"</br>".$email = $_POST['email'];
			echo	"</br>".$password = $_POST['password'];
			echo	"</br>".$login_type = $_POST['login_type'];
				
				
				if($login_type == "admin"){
					$sql = "SELECT * FROM `admin` WHERE  email = '$email'"; //AND password = '$password'";
					$id = 'id';
				}
				
				if($login_type == "teacher"){
					$sql = "SELECT * FROM `teacher` WHERE  email = '$email'";// AND password = '$password'";
					$id = 't_id';
				}
				
				if($login_type == "student"){
					$sql = "SELECT * FROM `student` WHERE  email = '$email'";// AND password = '$password'";
					$id = 's_id';
				}
				
				$res = mysqli_query($con,$sql);
				print_r($res);
				$num = mysqli_num_rows($res);

				if($num === 1){
					
				while($row=mysqli_fetch_array($res)){
					if(password_verify($password, $row['password'])){
	
							$_SESSION['is_login'] = true; 
							$_SESSION['login_type'] = $login_type;  
							$_SESSION['id'] = $row[$id];
							$_SESSION['name'] = $name = $row['first_name']." ".$row['last_name'];

							if($login_type == 'student'){
								$_SESSION['id'] = $row[$id];
								header("location:admin/student_index.php");	
							}else{
								header("location:admin/index.php");

							}
					}
					else{
						$_SESSION['msg']="Invalid Password !";
						header("location:login.php");

						// $error = "Invalid Username Or Password !";
						// header("location:login.php?login=fail&&error=$error");
					}
				  }
				}
				else{
					$_SESSION['msg']="Invalid Username !";
						header("location:login.php");
					// $error = "Invalid Username Or Password !";
					// 	header("location:login.php?login=fail&&error=$error");
				}
		
				
	?>