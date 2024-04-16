<?php
session_start();
include('config.php');

if(isset($_SESSION['username']) && ($_SESSION['level']=='head'))
{
  $username = $_SESSION['username'];
  $sql="SELECT * from account where username='$username'";
  $result=$conn->query($sql);
  $row=$result->fetch_assoc();
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
        p{
          margin: 15px auto 5px auto;"
        }
        .container2 {
          width: auto;
          height: auto;
          display: flex;
          justify-content: center;
          align-items: center;
        }
        </style>
    </head>
  <body>
  <section>

  <!---------------------------SIDE NAV------------------------------------------------------->
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
        
        
        <a href="head_index.php" ><i class="bi bi-person-circle"></i>  Profile</a>

        <a href="department_head.php"><i class="bi bi-bar-chart-line-fill"></i>  Department</a>

        <a href="task_info.php"><i class="bi bi-calendar-check-fill"></i>  Task</a>

        <a href="leave_head.php"><i class="bi bi-send-fill"></i>  Leave</a>

        <a href="logout.php" style="bottom:0;"><i class="bi bi-box-arrow-right"></i>  Logout</a>
    </div>
    <!---------------------------SIDE NAV------------------------------------------------------->


  <div id="main">

      <span style="font-size:30px;cursor:pointer" onclick="togNav()">&#9776; </span>


      <!---------------------------Table ------------------------------------------------------->
      <div class="container2">
      <div class="main-body"style="width:1000px">
      <div class="row gutters-sm">
        <div class="col-md-4 mb-3" >
          <div class="card" style="border-radius: 40px;">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
              <?php 
                $sql = "SELECT * FROM account WHERE username='$username'";
                $res = mysqli_query($conn,  $sql);

                if (mysqli_num_rows($res) > 0) {
                  while ($images = mysqli_fetch_assoc($res)) {  ?>
                <img src="image/user/<?=$images['avatar']?>" alt="Admin" class="rounded-circle" width="150">
              <?php } }?>

                <div class="mt-3" >
                  <h4 style="font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif; font-weight: bold"><?=$row['first_name'] ?> <?=$row['last_name'] ?></h4>
                  <p  class="mb-1 text-secondary" style="border:0;text-align: center;font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif;"><?=$row['position'] ?></p>
                  <p class="text-muted font-size-sm"><?=$row['address'] ?></p>
                  <button class="button62" onclick="location.href='picture_post.php'" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border: 0;border-radius: 12px;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif;font-size: 16px;font-weight: 500;line-height: 2.5;outline: transparent;padding: 0 1rem;text-align: center;text-decoration: none;transition: box-shadow .2s ease-in-out;user-select: none;-webkit-user-select: none;touch-action: manipulation;white-space: nowrap;"
                  role="button">Change Avatar</button> 
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="card mb-3" style="border-radius: 20px;">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0" style=" font-weight:bold;">ID Staff</h6>
                </div>
                <h6 class="col-sm-9 text-secondary" style="border:0; font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif;"><?=$row['ID'] ?></h6>
                
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0" style=" font-weight:bold;">Fisrt Name</h6>
                </div>
                <h6 class="col-sm-9 text-secondary" style="border:0; font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif;"><?=$row['first_name'] ?></h6>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0" style=" font-weight:bold;">Last Name</h6>
                </div>
                <h6 class="col-sm-9 text-secondary" style="border:0; font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif;"><?=$row['last_name'] ?></h6>

              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0" style=" font-weight:bold;">Username</h6>
                </div>
                <h6 class="col-sm-9 text-secondary" style="border:0; font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif;"><?=$row['username'] ?></h6>

              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0" style=" font-weight:bold;">Position</h6>
                </div>
                <h6 class="col-sm-9 text-secondary" style="border:0; font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif;"><?=$row['position'] ?></h6>

              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0" style=" font-size:15px; font-weight:bold;">Department</h6>
                </div>
                <h6 class="col-sm-9 text-secondary" style="border:0; font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif;"><?=$row['department_belong'] ?></h6>

              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                <h6 class="mb-0" style=" font-size:15px; font-weight:bold;">Level</h6>
                </div>
                <h6 class="col-sm-9 text-secondary" style="border:0; font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif;">Head Department</h6>

                
              </div>
              <hr>
              <button type="button"  data-bs-toggle="modal" style="background: linear-gradient(to bottom right, #EF4765, #FF9A5A);border: 0;border-radius: 12px;color: #FFFFFF;cursor: pointer;display: inline-block;font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif;font-size: 16px;font-weight: 500;line-height: 2.5;outline: transparent;padding: 0 1rem;text-align: center;text-decoration: none;transition: box-shadow .2s ease-in-out;user-select: none;-webkit-user-select: none;touch-action: manipulation;white-space: nowrap;"data-bs-target="#exampleModal">Change password</button>

              
              
            </div>
          </div>
      <!---------------------------END Table ------------------------------------------------------->
        </div>
      </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-weight:bold;">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post">

        <div class="form-group">
          <label for="old_pass" style="font-weight: bold">Old Password</label>
          <input type="old_pass" 
                class="form-control" 
                id="old_pass" 
                name="old_pass" 
                value="<?php if(isset($_GET['old_pass']))
                                echo($_GET['old_pass']); ?>" 
                >
        </div>
        <div class="form-group">
          <label for="new_pass" style="font-weight: bold">New Password</label>
          <input type="new_pass" 
                class="form-control" 
                id="new_pass" 
                name="new_pass" 
                value="<?php if(isset($_GET['new_pass']))
                                echo($_GET['new_pass']); ?>" 
                >
        </div>
        <div class="form-group">
          <label for="re_pass" style="font-weight: bold">Re-enter Password</label>
          <input type="re_pass" 
                class="form-control" 
                id="re_pass" 
                name="re_pass" 
                value="<?php if(isset($_GET['re_pass']))
                                echo($_GET['re_pass']); ?>" 
                >
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submit"class="btn btn-primary  rounded-pill">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
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

function triggerClick(e) {
    document.querySelector('#profileImage').click();
  }
  function displayImage(e) {
    if (e.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e){
        document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
      }
      reader.readAsDataURL(e.files[0]);
    }
  }
</script>
<style>
button:not([disabled]):focus {
  box-shadow: 0 0 .25rem rgba(0, 0, 0, 0.5), -.125rem -.125rem 1rem rgba(239, 71, 101, 0.5), .125rem .125rem 1rem rgba(255, 154, 90, 0.5);
}
button:not([disabled]):hover {
  box-shadow: 0 0 .25rem rgba(0, 0, 0, 0.5), -.125rem -.125rem 1rem rgba(239, 71, 101, 0.5), .125rem .125rem 1rem rgba(255, 154, 90, 0.5);
}
</style>
</body>
</html> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
