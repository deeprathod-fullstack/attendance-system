<?php 
		include "include/db.php";
		
		$t_id =  $_POST['id'];
		$sql = "delete from teacher where t_id ='$t_id'";
		mysqli_query($con, $sql);
		$_SESSION["Delete"] = "Record Delete Successfully";
		echo 1;
?>	