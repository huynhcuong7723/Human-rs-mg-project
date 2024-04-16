<?php
    
session_start();

include('config.php');
if(isset($_SESSION['username']) && ($_SESSION['level']=='admin'))
{
    if(isset($_GET['id'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = validate($_GET['id']);

    $sql = "SELECT * FROM account WHERE ID=$id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }else {
        header("Location: account_manage.php");
    }

    }else if(isset($_POST['update'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $ID = validate($_POST['ID']);
    $first_name = validate($_POST['first_name']);
    $last_name = validate($_POST['last_name']);
    $username = validate($_POST['username']);
    $address = validate($_POST['address']);
    $position = validate($_POST['position']);
    $get_department = validate($_POST['get_department']);
    $id = validate($_POST['id']);

    $sqlID = "SELECT ID FROM account WHERE ID = '$ID' ";
    $query_result_for_ID =  mysqli_query($conn, $sqlID);    
    $total_ID = mysqli_num_rows($query_result_for_ID);

    $sqlUsername = "SELECT username FROM account WHERE username = '$username' ";
    $query_result_for_username =  mysqli_query($conn,$sqlUsername);
    $total_username = mysqli_num_rows($query_result_for_username);

    if (empty($ID)) {
        header("Location: update_account.php?id=$id&error=ID Account is required");
    }else if (is_numeric($ID)==false) {
        header("Location: update_account.php?id=$id&error=ID must be a number");
    }else if (empty($first_name)) {
        header("Location: update_account.php?id=$id&error=First name is required");
    }else if (empty($last_name)) {
        header("Location: update_account.php?id=$id&error=Last name is required");
    }else if (empty($username)) {
        header("Location: update_account.php?id=$id&error=Username is required");
    }else if (empty($address)) {
        header("Location: update_account.php?id=$id&error=Address is required");
    }else if (empty($position)) {
        header("Location: update_account.php?id=$id&error=Position is required");
    }else if ($total_ID != 0 && $total_username != 0) {
        header("Location: account_manage.php?error=Username and ID both are already taken");
      }else if ($total_ID != 0) {
        header("Location: account_manage.php?error=ID Already Taken");
      }else if ($total_username != 0) {
        header("Location: account_manage.php?error=Username Already Taken");
    }else {
        $sql5 = "UPDATE account 
        SET ID='$ID', first_name='$first_name',last_name='$last_name',username='$username' ,address='$address',position='$position',department_belong='$get_department'
        WHERE ID=$id ";
        $result5 = mysqli_query($conn, $sql5);
        
        if ($result5) {
            header("Location: account_manage.php?success=successfully updated");
        }else {
            header("Location: update_account.php?id=$id&error=unknown error occurred&$user_data");
        }
    }
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Company Management</title>
    <link rel="icon" href="logo/web_logo.png" type="image/png"/>
    <link href="test.css" rel="stylesheet">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        * {
          font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #222122
        }

        .profile-button {
            background: #222122;
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #272725
        }

        .profile-button:focus {
            background: #272725;
            box-shadow: none
        }

        .profile-button:active {
            background: #272725;
            box-shadow: none
        }

        .back:hover {
            color: #272725;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #222122;
            color: #fff;
            cursor: pointer;
            border: solid 1px #222122
        }
    </style>
    </head>
    <body>
    <section>
    <div id="mySidenav" class="sidenav" >
        <div style=" margin-left: auto;margin-right: auto;text-align: center;margin-bottom: 10px;padding-bottom: 60px;">
          <?php 
            
            $username1 = $_SESSION['username'];
            $sql1="SELECT * from account where username='$username1'";
            $result1=$conn->query($sql1);
            $row1=$result1->fetch_assoc();
                        
            
            $sql2 = "SELECT * FROM account WHERE username='$username1'";
            $res = mysqli_query($conn,  $sql2);
            if (mysqli_num_rows($res) > 0) {
              while ($images = mysqli_fetch_assoc($res)) {  ?>
            
            <img src="image/user/<?=$images['avatar']?>" alt="Admin" class="rounded-circle" style="width: 80px; margin: 0 auto 5px auto;" >          
              
          <?php } }?>
          <h3 style="font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif; color: white ;font-size: 20px; margin-bottom: 0; font-weight:bold; margin-top: 30px;"><?=$row1['first_name'] ?> <?=$row1['last_name'] ?></h3>
          <span style="font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif;  color: white; font-size: 14px;color: #cfcfcf; "><?=$row1['position'] ?></span>
          <span style="font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif;  color: white; font-size: 10px;color: #cfcfcf; font-weight:bold ; color:#ADFF2F;">ONLINE</span>

        </div>
        <a href="index.php"><i class="bi bi-house-fill"></i>  Home</a>

        <a href="profile_user.php" ><i class="bi bi-person-circle"></i>  Profile </a>

        <a href="account_manage.php" ><i class="bi bi-credit-card-2-front-fill"></i>  Account </a>

        <a href="department_manage.php" ><i class="bi bi-bar-chart-line-fill"></i> Department </a>

        <a href="leave_admin.php"><i class="bi bi-send-fill"></i>  Leave</a>

        <a href="logout.php" style="bottom:0;"><i class="bi bi-box-arrow-right"></i>  Logout</a>
    </div>

    <div id="main">

    <span style="font-size:30px;cursor:pointer" onclick="togNav()">&#9776; </span>

    <div class="container2" style="background: white;">
    <!---------------------------Table BOX ------------------------------------------------------->


    </div>
    <div class="container rounded-pill bg-white  mt-5 mb-5 col-md-6 col-md-offset-3" style="	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="row">
            <div class="col-md-5 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" src="image/user/<?=$row['avatar']?>" width="90"><span style="font-weight:bold; font-size: 20px;"><?=$row['first_name'] ?> <?=$row['last_name'] ?></span><span class="text-black-50"><?=$row['username'] ?></span><span><?=$row['address'] ?></span></div>
            </div>
            <div class="col-sm-7 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="text-right" style="font-weight:bold;">UPDATE USER ACCOUNT</h3>
                    </div>

                    <form action="update_account.php" method="post">

                        <!-- ALERT -->
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger w-50 p-3" role="alert">
                                <?php echo $_GET['error']; ?>
                                </div>
                        <?php } ?>
                        <!-- ALERT -->
                        
                        <div class="row mt-2">
                            <div class="form-group col-md-4">
                                <label for="ID" style="font-weight: bold">ID Account</label>
                                <input type="ID" 
                                    class="form-control" 
                                    id="ID" 
                                    name="ID" 
                                    value="<?=$row['ID'] ?>" >
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group col-md-4">
                                <label for="username" style="font-weight: bold">Username</label>
                                <input type="username" 
                                    class="form-control" 
                                    id="username" 
                                    name="username" 
                                    value="<?=$row['username'] ?>" >
                            </div>
                        </div>
                        
                        <div class="row mt-2">
                            <div class="form-group col-md-4">
                                <label for="first_name" style="font-weight: bold">First Name</label>
                                <input type="first_name" 
                                    class="form-control" 
                                    id="first_name" 
                                    name="first_name" 
                                    value="<?=$row['first_name'] ?>" >
                            </div>                            
                            
                            <div class="form-group col-md-4">
                                <label for="last_name" style="font-weight: bold">Last Name</label>
                                <input type="last_name" 
                                    class="form-control" 
                                    id="last_name" 
                                    name="last_name" 
                                    value="<?=$row['last_name'] ?>" >
                            </div>
                        </div>
                        
                        <div class="row mt-2">
                            <div class="form-group col-md-8">
                                <label for="address" style="font-weight: bold">Address</label>
                                <input type="address" 
                                        class="form-control" 
                                        id="address" 
                                        name="address" 
                                        value="<?=$row['address'] ?>"
                                        placeholder="Enter Address">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="form-group col-md-8">
                                <label for="position" style="font-weight: bold">Position</label>
                                <input type="position" 
                                        class="form-control" 
                                        id="position" 
                                        name="position" 
                                        value="<?=$row['position'] ?>"
                                        placeholder="Enter position">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group col-md-8">
                                <label class="control-label col-sm-5" style="font-weight: bold">Department</label>
                                <div class="col-sm-7">
                                    <?php 
                                    $sql3 = "SELECT ID_department, department_name FROM department ";
                                    $result4 = mysqli_query($conn, $sql3);
                                    if (mysqli_num_rows($result4)) {
                                    ?>
                                    <select class="form-control" name="get_department" id="get_department" value="<?=$row['department_belong'] ?>" required>
                                    <option value="" >Select Department...</option>
                                    <?php 
                                        $i = 0;
                                        while($rows = mysqli_fetch_assoc($result4)){
                                        $i++;
                                    ?>
                                    <option value="<?php echo $rows['ID_department']; ?>"><?php echo $rows['department_name']; ?></option>
                                    <?php } ?>
                                    </select>
                                    <?php } ?>

                            </div>
                        </div>


                        <div class="mt-5 text-right">
                            <input type="text" 
                                    name="id"
                                    value="<?=$row['ID']?>" hidden>

                            <button type="submit" class="btn btn-success rounded-pill" name="update">Update</button>
                            <a href="account_manage.php" class="btn btn-secondary rounded-pill">Back</a>

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 fade"></div>
        </div>
    </div>

    </div>
    </section>
<?php
}else{
    header("Location: login.php");
}
?>
<script>

//toggle button
function togNav() {
    var el = document.getElementById("mySidenav");
    var es = document.getElementById("main");
    if(el.style.width == "250px"){
        el.style.width = "0px";
        es.style.marginLeft = "0px";
        document.body.style.backgroundColor = "white";
    } else {
        el.style.width = "250px";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        es.style.marginLeft = "250px";
    }
}
</script>
</body>
</html> 
