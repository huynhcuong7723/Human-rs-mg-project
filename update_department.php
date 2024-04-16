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
    
      $sql = "SELECT * FROM department
            WHERE ID_department=$id";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
      }else {
        header("Location: department_manage.php");
      }

  } else if(isset($_POST['update'])){
      
      function validate($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
    }
      
      $ID_department = validate($_POST['ID_department']);
      $department_name = validate($_POST['department_name']);
      $description_department = validate($_POST['description_department']);
      $room_number = validate($_POST['room_number']);	
      $id = validate($_POST['id']);

      if (empty($ID_department)) {
      header("Location: update_department.php?id=$id&error=ID Department is required");
      }else if (is_numeric($ID_department)==false) {
        header("Location: update_department.php?id=$id&error=ID Department must be a number");    
      }else if (empty($department_name)) {
      header("Location: update_department.php?id=$id&error=Department Name is required");
      }else if (empty($description_department)) {
      header("Location: update_department.php?id=$id&error=Description is required");
      }else if (empty($room_number)) {
      header("Location: update_department.php?id=$id&error=Number of room is required");
      }else {
          $sql = "UPDATE department
                  SET ID_department='$ID_department', department_name='$department_name', description_department='$description_department', room_number='$room_number'
                  WHERE ID_department=$id ";
          $result = mysqli_query($conn, $sql);
          if ($result) {
              header("Location: department_manage.php?success=successfully updated");
          }else {
          header("Location: index.php?id=$id&error=unknown error occurred&$user_data");
          }
      }
    
  }
  else {
    header("Location: department_manage.php");
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

      <div class="container rounded-pill bg-white  mt-5 mb-5 col-md-6 col-md-offset-3" style="	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="row">
            <div class="col-md-5 border-right">
            </div>
            <div class="col-sm-7 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="text-right" style="font-weight:bold;">UPDATE DEPARTMENT</h3>
                    </div>

                    <form action="update_department.php" method="post">

                        <!-- ALERT -->
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger w-50 p-3" role="alert">
                                <?php echo $_GET['error']; ?>
                                </div>
                        <?php } ?>
                        <!-- ALERT -->
                        
                        <div class="row mt-2">
                            <div class="form-group col-md-4">
                                <label for="ID_department" style="font-weight: bold">ID Department</label>
                                <input type="ID_department" 
                                    class="form-control" 
                                    id="ID_department" 
                                    name="ID_department" 
                                    value="<?=$row['ID_department'] ?>" >
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group col-md-4">
                                <label for="department_name" style="font-weight: bold">Name</label>
                                <input type="department_name" 
                                    class="form-control" 
                                    id="department_name" 
                                    name="department_name" 
                                    value="<?=$row['department_name'] ?>" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="room_number" style="font-weight: bold">Room Number</label>
                                <input type="room_number" 
                                    class="form-control" 
                                    id="room_number" 
                                    name="room_number" 
                                    value="<?=$row['room_number'] ?>" >
                            </div>
                        </div>
                        
                        <div class="row mt-2">
                            <div class="form-group col-md-8">
                                <label for="description_department" style="font-weight: bold">Description</label>
                                <input type="description_department" 
                                    class="form-control" 
                                    id="description_department" 
                                    name="description_department" 
                                    value="<?=$row['description_department'] ?>" >
                            </div>                            
                            
                        </div>
                        
                        <div class="mt-5 text-right">
                            <input type="text" 
                                    name="id"
                                    value="<?=$row['ID_department']?>" hidden>

                            <button type="submit" class="btn btn-success rounded-pill" name="update">Update</button>
                            <a href="department_manage.php" class="btn btn-secondary rounded-pill">Back</a>

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
