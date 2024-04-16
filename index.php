<?php

session_start();
                               
include('config.php');
    
if(isset($_SESSION['username']) && ($_SESSION['level']=='admin'))
{
    //doc du lieu user
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
          <link href="table.css" rel="stylesheet">
          <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
          <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

          <style> @import url('https://fonts.googleapis.com/css2?family=Mukta:wght@800&family=Poppins:wght@300&display=swap');</style>
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
        .table-wrapper {
          background: #212529;
          padding: 20px 25px;
          border-radius: 3px;
          box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }
        .pagination {
            float: right;
            margin: 0 0 5px;
        }
        .pagination li a {
            background: #343E43;
            border: none;
            font-size: 95%;
            width: 50px;
            height: 30px;
            color: #999;
            margin: 0 3px;
            line-height: 30px;
            text-align: center;
            padding: 0;
        }
        .pagination li a:hover {
            color: #666;
            background: #1B1C1C;

        }	
        .pagination li.active a {
            background: #1B1C1C;
        }
        .pagination li.active a:hover {        
            background: #1B1C1C;
        }
        .pagination li.disabled i {
            color: #1B1C1C;
            background: #1B1C1C;

        }
        .pagination li i {
            font-size: 16px;
            padding-top: 6px;
        }
        </style>
      </head>
    <body>
    <section>
      <div id="mySidenav" class="sidenav" >
          <div style=" margin-left: auto;margin-right: auto;text-align: center;margin-bottom: 10px;padding-bottom: 60px;">
            <?php 
              $sql = "SELECT * FROM account WHERE username='$username'";
              $res = mysqli_query($conn,  $sql);

              if (mysqli_num_rows($res) > 0) {
                while ($images = mysqli_fetch_assoc($res)) {  ?>

                <img src="image/user/<?=$images['avatar']?>" alt="Admin" class="rounded-circle" style="width: 80px; margin: 0 auto 5px auto;" >          
                <?php } }?>
                <h3 style="color: white ;font-size: 20px; margin-bottom: 0; font-weight:bold; margin-top: 30px;"><?=$row['first_name'] ?> <?=$row['last_name'] ?></h3>

            <span style="color: white; font-size: 14px;color: #cfcfcf; "><?=$row['position'] ?></span>
            <span style="color: white; font-size: 10px;color: #cfcfcf; font-weight:bold ; color:#ADFF2F;">ONLINE</span>

          </div>
        <a href="index.php"><i class="bi bi-house-fill"></i>  Home</a>

        <a href="profile_user.php" ><i class="bi bi-person-circle"></i>  Profile </a>

        <a href="account_manage.php" ><i class="bi bi-credit-card-2-front-fill"></i>  Account </a>

        <a href="department_manage.php" ><i class="bi bi-bar-chart-line-fill"></i> Department </a>

        <a href="leave_admin.php"><i class="bi bi-send-fill"></i>  Leave</a>

        <a href="logout.php" style="bottom:0;"><i class="bi bi-box-arrow-right"></i>  Logout</a>
      </div>
    <div id="main">   
      <!-- Toggle Button -->
      <span style="font-size:30px;cursor:pointer" onclick="togNav();">&#9776; </span>
    
      <div class="col-xl-10 " style="margin:auto;">
      <!-- Display card -->

      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card text-white " style="font-weight:bold; border:0;border-radius:30px; background-image: linear-gradient(to left bottom, #aea2a2, #7f7777, #544e4f, #2b292a, #000000);" >
              <div class="card-header p-3 pt-2"style="border-radius:30px;">
                <div class=" position-absolute">
                  <h1><i class="bi bi-person-lines-fill"></i></h1>
                </div>
                <div class="text-end pt-1">
                  <?php
                    $nv = "SELECT count(ID) as id_count FROM account";
                    $resultNV = mysqli_query($conn, $nv);
                    $rowNV = mysqli_fetch_array($resultNV);
                    $tongNV = $rowNV['id_count'];
                  ?>
                  <p class="text-sm mb-0 text-capitalize" style="font-size:20px;">Employee</p>
                  <h4 class="mb-0"style="font-weight:bold;"><?php echo $tongNV; ?></h4>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card text-white " style="font-weight:bold; border:0;border-radius:30px; background-image: linear-gradient(to left bottom, #aea2a2, #7f7777, #544e4f, #2b292a, #000000);" >
              <div class="card-header p-3 pt-2" style="border-radius:30px;">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                  <h1><i class="bi bi-people-fill"></i></h1>
                </div>
                <div class="text-end pt-1">
                  <?php
                    $dp = "SELECT count(ID_department) as id_department_count FROM department";
                    $resultDP = mysqli_query($conn, $dp);
                    $rowDP = mysqli_fetch_array($resultDP);
                    $tongDP = $rowDP['id_department_count'];
                  ?>
                  <p class="text-sm mb-0 text-capitalize" style="font-size:20px;">Department</p>
                  <h4 class="mb-0"style="font-weight:bold;"><?php echo $tongDP; ?></h4>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card text-white " style="font-weight:bold; border:0;border-radius:30px; background-image: linear-gradient(to left bottom, #aea2a2, #7f7777, #544e4f, #2b292a, #000000);" >
              <div class="card-header p-3 pt-2" style="border-radius:30px;">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <h1><i class="bi bi-card-checklist"></i></h1>
                </div>
                <div class="text-end pt-1">
                <?php
                    $li = "SELECT count(id_leave) as id_count_count FROM leave_info  INNER JOIN account ON(account.username = leave_info.username_id)WHERE account.level_log='head' and status='0'";
                    $resultli = mysqli_query($conn, $li);
                    $rowli = mysqli_fetch_array($resultli);
                    $tongli = $rowli['id_count_count'];
                  ?>
                  <p class="text-sm mb-0 text-capitalize" style="font-size:20px;">Waiting Leave</p>
                  <h4 class="mb-0"style="font-weight:bold;"><?php echo $tongli; ?></h4>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6">
          <div class="card text-white " style="font-weight:bold; border:0;border-radius:30px; background-image: linear-gradient(to left bottom, #aea2a2, #7f7777, #544e4f, #2b292a, #000000);" >
              <div class="card-header p-3 pt-2" style="border-radius:30px;">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <h1><i class="bi bi-calendar-check-fill"></i></h1>

                </div>
                <div class="text-end pt-1">
                <?php
                    $snv = "SELECT count(ID) as id_count FROM account Where level_log='head' or level_log='admin'";
                    $resultsNV = mysqli_query($conn, $snv);
                    $rowsNV = mysqli_fetch_array($resultsNV);
                    $tongsNV = $rowsNV['id_count'];
                  ?>
                  <p class="text-sm mb-0 text-capitalize" style="font-size:20px;">Head Department</p>
                  <h4 class="mb-0" style="font-weight:bold;"><?php echo $tongsNV; ?></h4>
                </div>
              </div>
            </div>
          </div>
          
          
          <div class="col-xl-6 mt-5">
          <div class="table-responsive table-dark" style="border-radius:30px; ">
          <?php 
          $sql5 = "SELECT *
                      FROM account 
                      INNER JOIN department ON(account.department_belong = department.ID_department)
                      ORDER BY account.ID DESC ";
          $result5 = mysqli_query($conn, $sql5);
              
          ?>
          
          <?php if (mysqli_num_rows($result5)) { ?>
            <div class="table-wrapper " >
            <div class="table-title">
              <div class="row">
                <div class="col-sm-9">
                  <h2><b>Employee</b></h2>
                  <br></br>
                </div>
              </div>
            </div>
              <table id="example" class="table table-dark table-light table-striped table-hover table-borderless " >
                <thead class="table-dark">
                 


                  <tr>
                    <th scope="col"><p>#</p></th>
                    <th scope="col"></th>
                    <th scope="col"><p>Name</p></th>
                    <th scope="col"><p>Account</p></th>
                    <th scope="col"><p>Position</p></th>
                  </tr>
                </thead>
                <tbody >
                  <?php 
                    $i = 0;
                    while($rows5 = mysqli_fetch_assoc($result5)){
                    $i++;
                  ?>
                  <tr >
                    <td><p><?php echo $i; ?></p></td>
                    <td><img src="image/user/<?php echo $rows5['avatar']; ?>"class="rounded-circle" style="width: 40px; margin: 5px auto 5px auto;" ></td>
                    <td><p><?php echo $rows5['first_name']; ?> <?php echo $rows5['last_name']; ?></p></td>
                    <td><p><?php echo $rows5['username']; ?></p></td>
                    <td><p><?php echo $rows5['position']; ?></p></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            <?php } ?>
          </div>
          </div>
          </div>

          <div class="col-xl-6 mt-5">
          <div class="table-responsive table-dark " style="border-radius:30px;">
          
          <?php 
          $sql6 = "SELECT * From department";
          $result6 = mysqli_query($conn, $sql6);
              
          ?>
          
          <?php if (mysqli_num_rows($result6)) { ?>
                <div class="table-wrapper " >
                <div class="table-title">
                  <div class="row">
                    <div class="col-sm-9">
                      <h2><b>Department</b></h2>
                      <br></br>
                    </div>
                  </div>
                </div>
                  <table id="example1" class="table table-dark table-light table-striped table-hover table-borderless " >
                    <thead class="table-dark"> 
                
                
                  <tr>
                    <th scope="col"><p>#</p></th>
                    <th scope="col"><p>Department Name</p></th>
                    <th scope="col"><p>Description</p></th>
                    <th scope="col"><p>Number of rum</p></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $i = 0;
                    while($rows6 = mysqli_fetch_assoc($result6)){
                    $i++;
                  ?>
                  <tr>
                    <td><p><?php echo $i; ?></p></td>
                    <td><p><?php echo $rows6['department_name']; ?></p></td>
                    <td><p><?php echo $rows6['description_department']; ?></p></td>
                    <td><p><?php echo $rows6['room_number']; ?></p></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            <?php }?>
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
    if(el.style.width == "0px"){
        el.style.width = "250px";
        es.style.marginLeft = "250px";
        document.body.style.backgroundColor = "white";
    } else {
        el.style.width = "0px";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        es.style.marginLeft = "0px";
    }
}
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script>
    $(document).ready(function() {
    $('#example1').DataTable();
} );
</script>
</body>
</html> 
