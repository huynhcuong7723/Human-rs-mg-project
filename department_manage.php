<?php

session_start();

include('config.php');

if(isset($_SESSION['username']) && ($_SESSION['level']=='admin'))
{
  //Doc du lieu cho table
  $sql11 = "SELECT * FROM department";
  $result11 = mysqli_query($conn, $sql11);




  //Delete
  if(isset($_GET['id'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
  }
  $id = validate($_GET['id']);

  $sql = "DELETE FROM department
          WHERE ID_department=$id";
  $result = mysqli_query($conn, $sql);
  if ($result) {
      header("Location: department_manage.php?success=Successfully deleted");
  }else {
      header("Location: department_manage.php?error=Unknown error occurred&$user_data");
  }
  }

  //ADD
  if (isset($_POST['create'])) {
    function validate($data){
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
    }

    $ID_department = validate($_POST['ID_department']);
    $department_name = validate($_POST['department_name']);
    $description_department = validate($_POST['description_department']);
    $room_number = validate($_POST['room_number']);

    $user_data = 'ID_department='.$ID_department. '&department_name='.$department_name.'&description_department='.$description_department.'&room_number='.$room_number;

    if (empty($ID_department)) {
      header("Location:department_manage.php?error=ID Department is required&$user_data");
    }else if (is_numeric($ID_department)==false) {
      header("Location:department_manage.php?error=ID Department must be a number&$user_data"); 
    }else if (empty($department_name)) {
      header("Location:department_manage.php?error=Department Name is required&$user_data");
    }else if (empty($description_department)) {
      header("Location: department_manage.php?error=Description is required&$user_data");
    }else if (empty($room_number)) {
      header("Location: department_manage.php?error=Room number is required&$user_data");
    }else {
      $sql = "INSERT INTO department(ID_department, department_name,description_department,room_number) 
      VALUES('$ID_department', '$department_name','$description_department','$room_number')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        header("Location: department_manage.php?success=successfully created");
      }else {
      header("Location: department_manage.php?error=unknown error occurred&$user_data");
      } 
    }
  }
  //SET HEAD
  if (isset($_POST['set_head'])) {
    function validate($data){
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
    }
    $id_depart = array();
    $id_depart = validate($_POST['id_depart']);
    $get_user_id = validate($_POST['get_user_id']);


      $sql9="UPDATE account 
      SET level_log='user' WHERE department_belong=$id_depart";
      $result9 = mysqli_query($conn, $sql9);

      $sql8="UPDATE account 
      SET level_log='head' WHERE ID=$get_user_id";
      $result8 = mysqli_query($conn, $sql8);

      $sql10="UPDATE department 
      SET head_department=$get_user_id  WHERE ID_department=$id_depart";
      $result10 = mysqli_query($conn, $sql10);
  
      header("location:department_manage.php");

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
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
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
          min-width: 1000px;
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

      <div class="container2">
      <!---------------------------Table BOX ------------------------------------------------------->
        <div class="table-responsive table-dark" style="border-radius:20px;">
        <div class="table-wrapper ">
            <div class="table-title">
              <div class="row">
                <div class="col-sm-9">
                  <h2><b>Department Management</b></h2>
                  <span style="  color: white; font-size: 14px;color: #cfcfcf; "><?=$row1['position'] ?></span>
                  <span style="  color: white; font-size: 10px;color: #cfcfcf; font-weight:bold ; color:#ADFF2F;">ONLINE</span>
                  <br></br>
                </div>
 

                <div class="col-sm-3">
                <button type="button" data-dismiss="modal" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add New Department</button>
                </div>
              </div>
            </div>
          <?php if (mysqli_num_rows($result11)) { ?>
              <table id="example" class="table table-light table-striped table-hover table-borderless table-dark " style='height: 200px;'>
                <thead class="table-dark">                
                  <tr>
                    <th scope="col"><p>ID</p></th>
                    <th scope="col"><p>Name</p></th>
                    <th scope="col"><p>Description</p></th>
                    <th scope="col"><p>Room Number</p></th>
                    <th scope="col"><p>Head Department</p></th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                    <th scope="col"><td></td></th>

                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $i = 0;
                    while($rows11 = mysqli_fetch_assoc($result11)){
                    $i++;
                  ?>
                  <tr>
                    <td><p><?php echo $rows11['ID_department']; ?></p></td>
                    <td><p><?php echo $rows11['department_name']; ?></p></td>
                    <td><p><?php echo $rows11['description_department']; ?></p></td>
                    <td><p><?php echo $rows11['room_number']; ?></p></td>
                    <td><p><?php 
                    $asdasd=$rows11['head_department'];
                    $sql_check="SELECT * FROM account WHERE ID='$asdasd'";
                    $result_check = mysqli_query($conn, $sql_check);
                    $rowscheck = mysqli_fetch_assoc($result_check);
                    if (mysqli_num_rows($result_check)){
                          echo $rowscheck['first_name']; ?> <?php echo $rowscheck['last_name']; 
                    }else {
                      echo null;
                    }
                    ?> </p></td>
                    <td>
                      <img src="image/user/<?php 
                      if (mysqli_num_rows($result_check)){
                        echo $rowscheck['avatar']; 
                      }else{
                        echo 'IMG-61d57370521345.86752399.jpg';
                      }
                      ?>"class="rounded-circle" style="width: 40px; margin: 5px auto 5px auto;" >
                    </td>
                    <td><button data-id='<?php echo $rows11['ID_department']; ?>' class="userinfo btn btn-info rounded-pill " data-dismiss="modal">Set Head</button></td>
                    <td><a href="update_department.php?id=<?=$rows11['ID_department']?> " class="btn btn-success rounded-pill">Update</a></td>
                    <td><a href="department_manage.php?id=<?=$rows11['ID_department']?>" class="btn btn-danger rounded-pill" onclick="return confirm('Are you sure you want to Delete this department?')">Delete</a></td>
                         
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            <?php }?>
        </div> 
        </div> 


        <!--------------------------------SCRIPT ----------------------------->
        <script type='text/javascript'>
            $(document).ready(function(){
                $('.userinfo').click(function(){
                    var userid = $(this).data('id');
                    $.ajax({
                        url: 'set_head.php',
                        type: 'post',
                        data: {userid: userid},
                        success: function(response){ 
                            $('.modal-body1').html(response); 
                            $('#empModal').modal('show'); 
                        }
                    });
                });
            });
          </script>
        <!--------------------------------END SCRIPT ----------------------------->
        <!--------------------------------MODAL ADD ----------------------------->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xs">
            <div class="modal-content">
              <div class="modal-header bg-dark text-white">
                <h4 class="modal-title" id="staticBackdropLabel" style="font-weight:bold;">New Department</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body ">
                <form method="post">                    
                    <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                      <?php echo $_GET['error']; ?>
                      </div>
                    <?php } ?>
                    
                    <div class="form-group">
                      <label for="ID_department" style="font-weight: bold">ID Department</label>
                      <input type="ID_department" 
                            class="form-control" 
                            id="ID_department" 
                            name="ID_department" 
                            value="<?php if(isset($_GET['ID_department']))
                                            echo($_GET['ID_department']); ?>" 
                            placeholder="Enter ID">
                    </div>

                    <div class="form-group">
                      <label for="department_name"style="font-weight: bold" >Name</label>
                      <input type="department_name" 
                            class="form-control" 
                            id="department_name" 
                            name="department_name" 
                            value="<?php if(isset($_GET['department_name']))
                                            echo($_GET['department_name']); ?>"
                            placeholder="Enter department name">
                    </div>

                    <div class="form-group">
                      <label for="description_department" style="font-weight: bold">Description</label>
                      <input type="description_department" 
                            class="form-control" 
                            id="description_department" 
                            name="description_department" 
                            value="<?php if(isset($_GET['description_department']))
                                            echo($_GET['description_department']); ?>"
                            placeholder="Enter Description">
                    </div>

                    <div class="form-group">
                      <label for="room_number" style="font-weight: bold">Number of room</label>
                      <input type="room_number" 
                            class="form-control" 
                            id="room_number" 
                            name="room_number" 
                            value="<?php if(isset($_GET['room_number']))
                                            echo($_GET['room_number']); ?>"
                            placeholder="Enter room">
                    </div>

         
              </div>
              <div class="modal-footer bg-dark">
                <button type="submit" class="btn btn-primary rounded-pill " name="create">Create</button>
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>                        
        <!--------------------------------END MODAL ADD ------------------------->

        <!--------------------------------SET HEAD ----------------------------->
        <div class="modal fade" id="empModal" role="dialog" >
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark text-white" >
                        <div class="modal-header " style="border:0;">
                            <h4 style="font-weight:bold;" >Choose head department</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post">
                        <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                          <?php echo $_GET['error']; ?>
                          </div>
                        <?php } ?>
                        <div class="modal-body1 modal-body" >
                        </div>
                        <div class="modal-footer "style="border:0;">
                        <button type="submit" class="btn btn-primary rounded-pill" name="set_head">SET HEAD</button>
                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
        </div>
        <!--------------------------------END SET HEAD ------------------------->
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</body>
</html> 
