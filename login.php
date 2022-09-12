<?php
		error_reporting(E_ALL ^ E_WARNING);
	    session_start();
		if($_SESSION['is_login'] == true){
			header("location:admin/index.php");	
		}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="library/login/css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
			
			</div>
		<?php
			if($_SESSION['msg']){ 

			echo '<div class="alert alert-info" alert-dismissible fade show" role="alert">
			'.$_SESSION['msg'].'
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>';
		
		}

	?>
	


			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img" style="background-image: url(library/login/images/login.png);"></div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Login</h3>
			      		</div>
								
			      	</div>
						<form action="login_master.php" class="signin-form" method="POST">
			      		<div class="form-group mt-3">
			      			<input type="text" class="form-control" name="email" required>
			      			<label class="form-control-placeholder" for="email">Email</label>
			      		</div>
		            <div class="form-group">
		              <input id="password-field" type="password" name="password" class="form-control" required>
		              <label class="form-control-placeholder" for="password">Password</label>
		              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            </div>
					
					<div class="form-group mt-3">
			      			<select name="login_type" class="form-control" required>
							<option value="admin"> Admin </option>
							<option value="teacher"> Teacher </option>
							<option value="student"> Student </option>
							</select>
			      		</div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
		            </div>
					<div class="form-group">
		            	<h6 style="text-align: center"><a style="color: black;" href="index.php"><<- Go Back</a></h6>
		            </div>
		            
		          </form>
		         
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="library/login/js/jquery.min.js"></script>
  <script src="library/login/js/popper.js"></script>
  <script src="library/login/js/bootstrap.min.js"></script>
  <script src="library/login/js/main.js"></script>
<?php  include "./admin/include/footer.php"; ?>
	</body>
	
</html>

