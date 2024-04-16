<?php

session_start();

include('config.php');

if(isset($_SESSION['username']) && ($_SESSION['level']=='head'))
{
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
        <a href="head_index.php" ><i class="bi bi-person-circle"></i>  Profile</a>

        <a href="department_head.php"><i class="bi bi-bar-chart-line-fill"></i>  Department</a>

        <a href="task_info.php"><i class="bi bi-calendar-check-fill"></i>  Task</a>

        <a href="leave_head.php"><i class="bi bi-send-fill"></i>  Leave</a>

        <a href="logout.php" style="bottom:0;"><i class="bi bi-box-arrow-right"></i>  Logout</a>
    </div>

<div id="main">

<span style="font-size:30px;cursor:pointer" onclick="togNav()">&#9776; </span>

<div class="container2">

<!---------------------------Table BOX ------------------------------------------------------->
  <div class="table-responsive table-dark" style="border-radius:20px;">
  <?php 
    $id_de_head=$_SESSION['department_belong'];
    $sql5 = "SELECT *FROM account WHERE department_belong=$id_de_head ORDER BY ID DESC";
    $result5 = mysqli_query($conn, $sql5);
        
    ?>
          <div class="table-wrapper ">
            <div class="table-title">
              <div class="row">
                <div class="col-sm-9">
                  <h2><b>Department Staff</b></h2>
                  <span style="  color: white; font-size: 14px;color: #cfcfcf; "><?=$row1['position'] ?></span>
                  <span style="  color: white; font-size: 10px;color: #cfcfcf; font-weight:bold ; color:#ADFF2F;">ONLINE</span>
                  <br></br>
                </div>
              </div>
            </div>
          

    <?php if (mysqli_num_rows($result5)) { ?>
        <table id="example" class="table table-light table-striped table-hover table-borderless table-dark" style='height: 200px;'>
          <thead class="table-dark">
              
            <tr>
              <th scope="col"><p>ID</p></th>
              <th scope="col"></th>
              <th scope="col"><p>Username</p></th>
              <th scope="col"><p>Full Name</p></th>
              <th scope="col"><p>Position</p></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody >
            <?php 
              $i = 0;
              while($rows5 = mysqli_fetch_assoc($result5)){
              $i++;
            ?>
            <tr >
              <td><p><?php echo $rows5['ID']; ?></p></td>
              <td><img src="image/user/<?php echo $rows5['avatar']; ?>"class="rounded-circle" style="width: 40px; margin: 5px auto 5px auto;" ></td>
              <td><p><?php echo $rows5['username']; ?></p></td>
              <td><p><?php echo $rows5['first_name']; ?> <?php echo $rows5['last_name']; ?></p></td>
              <td><p><?php echo $rows5['position']; ?></p></td>
              <td><button data-id='<?php echo $rows5['ID']; ?>' class="userinfo btn btn-warning rounded-pill " data-dismiss="modal">Detail</button></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } ?>
    </div>  
    </div>

    <!------------------------------MODAL -------------------------------->
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
                <!------------------------------MODAL -------------------------------->

</section>
<?php 
}else{
  header("Location: login.php");
}
?>
</body>
</html>
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