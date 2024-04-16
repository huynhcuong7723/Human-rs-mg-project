<?php

session_start();

include('config.php');

if(isset($_SESSION['username']) && ($_SESSION['level']=='admin'))
{


  //ADD
  if (isset($_POST['create'])) {
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
    $default_pass = rand(000001,100000);
    $acc_password = validate(password_hash($default_pass,PASSWORD_BCRYPT));
    $address = validate($_POST['address']);
    $position = validate($_POST['position']);
    $get_department = validate($_POST['get_department']);
    $level_log='user';
    $image_user_temp='IMG-61d57370521345.86752399.jpg';


    $user_data = 'ID='.$ID. '&first_name='.$first_name.'&last_name='.$last_name.'&username='.$username.'&acc_password='.$acc_password.'&address='.$address.'&position='.$position;

    $sqlID = "SELECT ID FROM account WHERE ID = '$ID' ";
    $query_result_for_ID =  mysqli_query($conn, $sqlID);    
    $total_ID = mysqli_num_rows($query_result_for_ID);

    $sqlUsername = "SELECT username FROM account WHERE username = '$username' ";
    $query_result_for_username =  mysqli_query($conn,$sqlUsername);
    $total_username = mysqli_num_rows($query_result_for_username);

    if (empty($ID)) {
      header("Location:account_manage.php?error=ID is required&$user_data");
    }else if (empty($first_name)) {
      header("Location:account_manage.php?error=First Name is required&$user_data");
    }else if (empty($last_name)) {
      header("Location: account_manage.php?error=Last Name is required&$user_data");
    }else if (empty($username)) {
      header("Location: account_manage.php?error=username is required&$user_data");
    }else if (empty($address)) {
      header("Location: account_manage.php?error=Address is required&$user_data");
    }else if (empty($position)) {
      header("Location: account_manage.php?error=Position is required&$user_data");
    }else if ($total_ID != 0 && $total_username != 0) {
      header("Location: account_manage.php?error=Username and ID both are already taken");
    }else if ($total_ID != 0) {
      header("Location: account_manage.php?error=ID Already Taken");
    }else if ($total_username != 0) {
      header("Location: account_manage.php?error=Username Already Taken");
    }else {
      $sql = "INSERT INTO account(ID, first_name,last_name,username,acc_password,address,position,department_belong,default_pass,level_log,avatar) 
      VALUES('$ID', '$first_name','$last_name','$username','$acc_password','$address','$position','$get_department','$default_pass','$level_log','$image_user_temp')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        header("Location: account_manage.php?success=successfully created");
      }else {
      header("Location: account_manage.php?error=unknown error occurred&$user_data");
      } 
    }
  }
  function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
  //Delete
  if(isset($_GET['id'])){

  $id = validate($_GET['id']);

  
  $sql = "DELETE FROM account
          WHERE ID=$id";
  $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: account_manage.php?success=Successfully deleted");
    }else {
        header("Location: account_manage.php?error=Unknown error occurred&$user_data");
    }
  }

  //RESET PASSWORD
  if(isset($_GET['pass_reset'])){

    $id_pass = validate($_GET['pass_reset']);
    $ran_pass = rand(000001,100000);
    $reset_password = validate(password_hash($ran_pass,PASSWORD_BCRYPT));
  
    $sql8 = "UPDATE account 
    SET acc_password='$reset_password',default_pass='$ran_pass' 
    WHERE ID=$id_pass ";
    $result8 = mysqli_query($conn, $sql8);
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
      <!-- SIDE BAR --><link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

        <!-- CSS style -->

      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
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
          <h3 style=" color: white ;font-size: 20px; margin-bottom: 0; font-weight:bold; margin-top: 30px;"><?=$row1['first_name'] ?> <?=$row1['last_name'] ?></h3>
          <span style="  color: white; font-size: 14px;color: #cfcfcf; "><?=$row1['position'] ?></span>
          <span style="  color: white; font-size: 10px;color: #cfcfcf; font-weight:bold ; color:#ADFF2F;">ONLINE</span>

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
        <div class=" table-responsive table-dark" style="border-radius:20px;">
        <?php 
          $sql5 = "SELECT *FROM account ORDER BY ID DESC";
          $result5 = mysqli_query($conn, $sql5);
              
          ?>
            <div class="table-wrapper ">
            <div class="table-title">
              <div class="row">
                <div class="col-sm-9">
                  <h2><b>Account Management</b></h2>
                  <span style="  color: white; font-size: 14px;color: #cfcfcf; "><?=$row1['position'] ?></span>
                  <span style="  color: white; font-size: 10px;color: #cfcfcf; font-weight:bold ; color:#ADFF2F;">ONLINE</span>
                  <br></br>
                </div>
 

                <div class="col-sm-3">
                <button type="button" data-dismiss="modal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >Add New Account</button>
                </div>
              </div>
            </div>
            <table id="example" class="table table-light table-striped table-hover table-borderless table-dark" style='height: 200px;'>
                <thead class="table-dark">
                
                  <tr>
                    <th scope="col"><p>ID</p></th>
                    <th scope="col"></th>
                    <th scope="col"><p>Username</p></th>
                    <th scope="col"><p>Default Password</p></th>
                    <th scope="col"><p>Position</p></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                    
                  </tr>
                </thead>
                <tbody >
                  <?php if (mysqli_num_rows($result5)) {
                    $i = 0;
                    while($rows5 = mysqli_fetch_assoc($result5)){
                    $i++;
                  ?>
                  <tr >
                    <td><p><?php echo $rows5['ID']; ?></p></td>
                    <td><img src="image/user/<?php echo $rows5['avatar']; ?>"class="rounded-circle" style="width: 40px; margin: 5px auto 5px auto;" ></td>

                    <td><p><?php echo $rows5['username']; ?></p></td>
                    <td><p><?php 
                    if ($rows5['default_pass']=='') {
                      echo 'Changed';
                    }else {
                      echo $rows5['default_pass']; 
                    }
                    ?></p></td>
                    <td><p><?php echo $rows5['position']; ?></p></td>
                    <td><button data-id='<?php echo $rows5['ID']; ?>' class="userinfo btn btn-warning rounded-pill " data-dismiss="modal">Detail</button></td>
                    <td><a href="update_account.php?id=<?=$rows5['ID']?>" class="btn btn-success rounded-pill" onclick="return confirm('Are you sure you want to Update information this account?')" >Update</a></td>
                    <td><a href="account_manage.php?pass_reset=<?=$rows5['ID']?>" class="btn btn-info rounded-pill" onclick="return confirm('Are you sure you want to Reset password for this account?')">Reset Password</a></td>
                    <td><a href="account_manage.php?id=<?=$rows5['ID']?>" class="btn btn-danger rounded-pill" onclick="return confirm('Are you sure you want to Delete this account?')">Delete</a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            <?php } ?>
          </div>  
          </div>  


          <!---------------------------------- MODAL Detail -------------------------------->
          <script type='text/javascript'>
            $(document).ready(function(){
                $('.userinfo').click(function(){
                    var userid = $(this).data('id');
                    $.ajax({
                        url: 'info-modal.php',
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
          
          
          <div class="modal fade" id="empModal" role="dialog" >
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-pill" >
                        <div class="modal-header" style="border:0;">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body1">
                        </div>
                        <div class="modal-footer"style="border:0;">
                        </div>
                    </div>
                </div>
        </div>
          <!---------------------------------- END MODAL Detail -------------------------------->


          <!---------------------------------- MODAL ADD -------------------------------->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xs">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="staticBackdropLabel"  style="font-weight:bold;">New Employee</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              <div class="modal-body">
                <form method="post">
                        
                        <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                          <?php echo $_GET['error']; ?>
                          </div>
                        <?php } ?>
                        
                        <div class="form-group">
                          <label for="ID" style="font-weight: bold">ID account</label>
                          <input type="ID" 
                                class="form-control" 
                                id="ID" 
                                name="ID" 
                                value="<?php if(isset($_GET['ID']))
                                                echo($_GET['ID']); ?>" 
                                placeholder="Enter ID">
                        </div>

                        <div class="form-group">
                          <label for="first_name"style="font-weight: bold" >First Name</label>
                          <input type="first_name" 
                                class="form-control" 
                                id="first_name" 
                                name="first_name" 
                                value="<?php if(isset($_GET['first_name']))
                                                echo($_GET['first_name']); ?>"
                                placeholder="Enter First name">
                        </div>

                        <div class="form-group">
                          <label for="last_name" style="font-weight: bold">Last Name</label>
                          <input type="last_name" 
                                class="form-control" 
                                id="last_name" 
                                name="last_name" 
                                value="<?php if(isset($_GET['last_name']))
                                                echo($_GET['last_name']); ?>"
                                placeholder="Enter Last Name">
                        </div>

                        <div class="form-group">
                          <label for="username" style="font-weight: bold">Username</label>
                          <input type="username" 
                                class="form-control" 
                                id="username" 
                                name="username" 
                                value="<?php if(isset($_GET['username']))
                                                echo($_GET['username']); ?>"
                                placeholder="Enter username">
                        </div>



                        <div class="form-group">
                          <label for="address" style="font-weight: bold">Address</label>
                          <input type="address" 
                                class="form-control" 
                                id="address" 
                                name="address" 
                                value="<?php if(isset($_GET['address']))
                                                echo($_GET['address']); ?>"
                                placeholder="Enter Address">
                        </div>
                        
                        <div class="form-group">
                          <label for="position" style="font-weight: bold">Position</label>
                          <input type="position" 
                                class="form-control" 
                                id="position" 
                                name="position" 
                                value="<?php if(isset($_GET['position']))
                                                echo($_GET['position']); ?>"
                                placeholder="Enter position">
                        </div>

                        <div class="form-group">
                              <label class="control-label col-sm-5" style="font-weight: bold">Department</label>
                              <div class="col-sm-7">
                                <?php 
                                  $sql3 = "SELECT ID_department, department_name FROM department ";
                                  $result4 = mysqli_query($conn, $sql3);
                                  if (mysqli_num_rows($result4)) {
                                ?>
                                <select class="form-control" name="get_department" id="get_department" required>
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
                        <br>
                </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary rounded-pill" name="create">Create</button>
                  <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                </div>
                </form> 
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
