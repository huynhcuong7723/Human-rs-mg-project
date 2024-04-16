
<?php 
    
    session_start();
                                   
    include('config.php');
    
    if(isset($_SESSION['username']))
    {        
        $user_id=$_SESSION['id'];
        if (isset($_POST['change'])){

            function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
         
            $default_pass = validate($_POST['default_pass']);
            $password = validate($_POST['password']);
            $re_password = validate($_POST['re_password']);
            $user_id=validate($_POST['user_id']);
            $final_password = password_hash($password,PASSWORD_BCRYPT);
            $temp_pass ='';

            if($password == $re_password){
                $sql = "UPDATE account 
                SET default_pass='$temp_pass',acc_password='$final_password' 
                WHERE ID=$user_id ";  
                $result = mysqli_query($conn, $sql);                  
                if($_SESSION['level']=='admin'){
                    header("Location: index.php");
                }else if ($_SESSION['level']=='head'){
                    header("Location: head_index.php");
                }else if ($_SESSION['level']=='user'){
                    header("Location: user_index.php");
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
                        <h2 class="heading-section">Change password</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-4">
                        <div class="login-wrap p-0">
                            <h3 class="mb-4 text-center">----------------</h3>
                        
                            <form method="POST" class="signin-form">
                            
                            <div class="form-group">
                                <input id="password-field1" type="password" class="form-control" placeholder="Enter default password" name="default_pass" required/>
                                <span toggle="#password-field1" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            
                            <div class="form-group">
                  
                                <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" required/>
                                <input  id="password-field2" type="password" class="form-control" placeholder="Password" name="password" required/>
                                <span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                            </div>

                            <div class="form-group">
                                <input  id="password-field3" type="password" class="form-control" placeholder="Retype Password" name="re_password" required/>
                                <span toggle="#password-field3" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                            </div>

                            
                                <div class="form-group">
                                    <button type="submit" name="change" class="form-control btn btn-primary submit px-3">Change password</button>
                                </div>

                                <div class="w-50 text-md-right">
									<a href="logout.php" style="color: #fff">Logout ?</a>
								</div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
}else{
  header("Location: login.php");
}
?>
        <script src="build/login/js/jquery.min.js"></script>
      <script src="build/login/js/popper.js"></script>
      <script src="build/login/js/bootstrap.min.js"></script>
      <script src="build/login/js/main.js"></script>
</body>
</html>
    
    