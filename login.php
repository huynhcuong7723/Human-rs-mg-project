
<?php 

session_start();
								
include('config.php');

if(isset($_SESSION['username']) && isset($_SESSION['level']))
{
	if($_SESSION['level']=='admin'){
		header("Location: index.php");
	}else if ($_SESSION['level']=='head'){
		header("Location: head_index.php");
	}else if ($_SESSION['level']=='user'){
		header("Location: user_index.php");
	}
}
else
{
	if(isset($_POST['login']))
	{
		$error = array();
		$showMess = false;
		$row= array();

		if(empty($_POST['username']))
		{
			$error['username'] = 'Please enter your username !';
		}

		if(empty($_POST['password']))
		{
			$error['password'] = 'Please enter your password !';
		}

		if(!$error) {

			function validate($data){
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			$username = validate($_POST['username']);
			$password = validate($_POST['password']);
			
			// check user
			$check = "SELECT * FROM account WHERE username = '$username'";
			$result = mysqli_query($conn, $check);
			$row = mysqli_fetch_array($result);


			if(mysqli_num_rows($result)==1)
			{
				$level = $row['level_log'];
				$id = $row['ID'];
				$default_pass = $row['default_pass'];
				$hashed_pass = $row['acc_password'];
				$department_belong =$row['department_belong'];
				if(password_verify($password,$hashed_pass))
				{
					$showMess = true;
					$_SESSION['username'] = $username;
					$_SESSION['level'] = $level;
					$_SESSION['default_pass'] = $default_pass;
					$_SESSION['id'] = $id;
					$_SESSION['department_belong'] = $department_belong;

					
					if($default_pass==null) {
						if($_SESSION['level']=='admin'){
							header("Location: index.php");
						}else if ($_SESSION['level']=='head'){
							header("Location: head_index.php");
						}else if ($_SESSION['level']=='user'){
							header("Location: user_index.php");
						}					
					}else{
						header('Location: changepass.php');
					}
				}
				else 
				{
					$error['check']='Wrong password ! Try again...';
				}
			}
			else
			{
				$error['check']='Wrong username ! Try again...';
			}
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Development Company</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="logo/web_logo.png" type="image/png"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	<link rel="stylesheet" href="build/login/css/style.css">

	</head>
	<body class="img js-fullheight" style="background-image: url(image/login_background/login_pic.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-9 col-lg-4">
					<div class="login-wrap p-0">
						<h3 class="mb-4 text-center">Have an account?</h3>
					
						<form method="POST" class="signin-form">
							
							<div class="form-group">
								<input type="username" name="username" class="form-control" placeholder="Username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
							</div>

							<div class="form-group">
							<input id="password-field" type="password" name="password" class="form-control" placeholder="Password" required>
							<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
							</div>

							<?php
								// show error
								if(isset($error))
								{
									if($showMess == false)
									{
										echo "<div class='alert alert-danger alert-dismissible'>";
										foreach ($error as $err)
										{
											echo $err . "<br/>";
										}
										echo "</div>";
									}
								}
							?>
						
							<div class="form-group">
								<button type="submit" name="login" class="form-control btn btn-primary submit px-3">Sign In</button>
							</div>

							<div class="form-group d-md-flex">
								<div class="w-50">
									<label class="checkbox-wrap checkbox-primary">Remember Me
										<input type="checkbox" checked>
										<span class="checkmark"></span>
									</label>
								</div>
								
								<div class="w-50 text-md-right">
									<a href="#" style="color: #fff">Forgot Password</a>
								</div>
							</div>

							<div class="form-group d-md-flex" style="text-align: center;">
								<div class="text-md-right">
									<a href="#" style="color: #fff">Account Test:</a>
								</div>
								</div>
								
							<div class="form-group d-md-flex">
								<div class="text-md-right">
									<a href="#" style="color: #fff">- Username: admin</a>
								</div>
								</div>
								
							<div class="form-group d-md-flex">
								<div class="text-md-right">
									<a href="#" style="color: #fff">- Password: admin123</a>
								</div>
								</div>
								
							<div class="form-group d-md-flex">
								<div class="text-md-right">
									<a href="#" style="color: #fff">*Read file README for more information</a>
								</div>
							</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="build/login/js/jquery.min.js"></script>
	<script src="build/login/js/popper.js"></script>
	<script src="build/login/js/bootstrap.min.js"></script>
	<script src="build/login/js/main.js"></script>

</body>
</html>

