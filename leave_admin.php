<?php
session_start();
include('config.php');
if(isset($_SESSION['username']) && ($_SESSION['level']=='admin'))
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
            <div class="container2" >
                <div class="table-responsive table-dark" style="border-radius:20px;">
                        <?php 
                            $sql5 = "SELECT *
                                        FROM leave_info 
                                        INNER JOIN account ON(account.username = leave_info.username_id)
                                        INNER JOIN department ON(department.ID_department = account.department_belong)
                                        WHERE account.level_log='head'
                                        ORDER BY leave_info.leave_date DESC ";
                            $result5 = mysqli_query($conn, $sql5);

                        ?>
                                  <div class="table-wrapper ">
                                    <div class="table-title">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <h2><b>Leaves Management</b></h2>
                                        <span style="  color: white; font-size: 14px;color: #cfcfcf; "><?=$row1['position'] ?></span>
                                        <span style="  color: white; font-size: 10px;color: #cfcfcf; font-weight:bold ; color:#ADFF2F;">ONLINE</span>
                                        <br></br>
                                        </div>
                        

                                        <div class="col-sm-2">
                                        <a class="btn btn-warning  " data-toggle="modal" data-target="#change_status"><i class="fa fa-plus"></i>Waiting Leaves</a>
                                        </div>
                                        <div class="col-sm-2">
                                        <a class="btn btn-danger "  data-toggle="modal" data-target="#see_canceled"><i class="fa fa-spinner"></i> Rejected Leaves</a>  
                                        </div>
                                        <div class="col-sm-2">
                                        <a  class="btn btn-success "  data-toggle="modal" data-target="#see_approved"><i class="fa fa-check"></i> Approved Leaves</a> 
                                        </div>
                                    </div>
                                    </div>
                        
                            <table id="example" class="table table-light table-striped table-hover table-borderless table-dark " style='height: 200px;'>
                            <thead class="table-dark">

                                <tr>
                                    <th scope="col"><p>#</p></th>
                                    <th></th>
                                    <th scope="col"><p>Name</p></th>
                                    <th scope="col"><p>Username</p></th>
                                    <th scope="col"><p>Department</p></th>
                                    <th scope="col"><p>Leave Date</p></th>
                                    <th scope="col"><p>Reason</p></th>
                                    <th scope="col"><p>Status</p></th>                                    
                                </tr>
                            </thead>
                            <tbody >

                                <?php 
                                if (mysqli_num_rows($result5)) {
                                    $i = 0;
                                    while($rows5 = mysqli_fetch_assoc($result5)){
                                    $i++;
                                ?>
                                <tr>                                    
                                    <td><p><?php echo $i; ?></td>
                                    <td><img src="image/user/<?php echo $rows5['avatar']; ?>"class="rounded-circle" style="width: 40px; margin: 5px auto 5px auto;" ></td>
                                    <td><p><?php echo $rows5['first_name']; ?> <?php echo $rows5['last_name']; ?></p></td>
							 		<td><p><?php echo $rows5['username_id']; ?></p></td>
							 		<td><p><?php echo $rows5['department_name']; ?></p></td>
							 		<td><p><?php echo $rows5['leave_date']; ?></p></td>
                                    <td><p><?php echo $rows5['reason']; ?></p></td>
                                    <td>
                                    <?php 
                                        if ($rows5['status'] == 0) {
                                            echo "<span class=' btn-warning btn-sm'>Waiting</span>";
                                        }
                                       
                                        else if ($rows5['status'] == 1){
                                            echo "<span class=' btn-success btn-sm '>Approved</span>";
                                        }
                                        else {
                                            echo "<span class=' btn-danger btn-sm '>Rejected</span>";
                                        }
                                    } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div> 
     
            <!-----------------------------MODAL---------------------------------->
            <div class="modal fade in" id="change_status" tabindex="-1" >
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white ">
                            <h4 style="font-weight:bold;" >Waiting Approve</h4>
                        </div>
                        <div class="modal-body">
                            <div>
                                <table class="table table-light table-striped table-hover table-borderless">
                                <?php 
                                    $sql00 = "SELECT *
                                                FROM leave_info 
                                                INNER JOIN account ON(account.username = leave_info.username_id)
                                                INNER JOIN department ON(department.ID_department = account.department_belong)
                                                WHERE account.level_log='head'
                                                ORDER BY leave_info.leave_date DESC   ";
                                    $result00 = mysqli_query($conn, $sql00);
                                        
                                    ?>
                                    <?php if (mysqli_num_rows($result00)) { ?>
                                    <thead class="table-dark">
                                    <tr>
                                        <th scope="col"><p>#</p></th>
                                        <th scope="col"><p>Name</p></th>
                                        <th scope="col"><p>Username</p></th>
                                        <th scope="col"><p>Department</p></th>
                                        <th scope="col"><p>Leave Date</p></th>
                                        <th scope="col"><p>Reason</p></th>
                                        <th scope="col"><p>Status</p></th>
                                        <th scope="col"></th> 
                                        <th scope="col"></th>                                    
                                   
                                    
                                    </tr>
                                    </thead>
                                    <tbody >
                                        <?php 
                                            $i = 0;
                                            while($rows00 = mysqli_fetch_assoc($result00)){
                                            $i++;
                                            if ($rows00['status'] == 0) {

                                        ?>
                                        <tr>                                    
                                            <td><p><?php echo $i; ?></td>
                                            <td><p><?php echo $rows00['first_name']; ?> <?php echo $rows00['last_name']; ?></p></td>
                                            <td><p><?php echo $rows00['username_id']; ?></p></td>
                                            <td><p><?php echo $rows00['department_name']; ?></p></td>
                                            <td><p><?php echo $rows00['leave_date']; ?></p></td>
                                            <td><p><?php echo $rows00['reason']; ?></p></td>
                                            <td>
                                            <?php 
                                                if ($rows00['status'] == 0) {
                                                    echo "<span class=' btn-warning btn-sm rounded-pill'>Waiting</span>";
                                                }
                                                else if ($rows00['status'] == 1){
                                                    echo "<span class=' btn-success btn-sm rounded-pill'>Approved</span>";
                                                }
                                                else {
                                                    echo "<span class=' btn-danger btn-sm rounded-pill'>Rejected</span>";
                                                }
                                            ?>
                                            </td>
                                            <td>
                                            <form action="edit_status_leave.php?id=<?php echo $rows00['id_leave']; ?>" method="POST">
                                                <input type="hidden" name="appid" value="<?php echo $rows00['id_leave']; ?>">
                                                <input type="submit" class="btn  btn-success" name="approve" value="Approve">
                                            </form>
                                            </td>
                                            <td>
                                            <form action="edit_status_leave.php?id=<?php echo $rows00['id_leave']; ?>" method="POST">
                                                <input type="hidden" name="appid" value="<?php echo $rows00['id_leave']; ?>">
                                                <input type="submit" class="btn  btn-danger" name="cancel" value="Cancel">
                                            </form>
                                            </td>
                                            <?php }} ?>
                                        </tr>
                                    </tbody>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>
            <!-----------------------------END MODAL---------------------------------->
            
            <!-----------------------------MODAL---------------------------------->            
            <div class="modal fade in" id="see_approved" tabindex="-1" >
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white ">
                            <h4 style="font-weight:bold;" >Approved Leaves</h4>
                        </div>
                        <div class="modal-body">
                            <div>
                                <?php 
                                    $sql100 = "SELECT *
                                                FROM leave_info 
                                                INNER JOIN account ON(account.username = leave_info.username_id)
                                                INNER JOIN department ON(department.ID_department = account.department_belong)
                                                WHERE account.level_log='head'
                                                ORDER BY leave_info.leave_date DESC  ";
                                    $result100 = mysqli_query($conn, $sql100);
                                        
                                ?>
                                <table class="table table-light table-striped table-hover table-borderless">
                                    <?php if (mysqli_num_rows($result100)) { ?>
                                    <thead class="table-dark">
                                    <tr>
                                        <th scope="col"><p>#</p></th>
                                        <th scope="col"><p>Name</p></th>
                                        <th scope="col"><p>Username</p></th>
                                        <th scope="col"><p>Department</p></th>
                                        <th scope="col"><p>Leave Date</p></th>
                                        <th scope="col"><p>Reason</p></th>
                                        <th scope="col"><p>Status</p></th>                                    
                                    </tr>
                                    </thead>
                                    <tbody >
                                        <?php 
                                            $i = 0;
                                            while($rows100 = mysqli_fetch_assoc($result100)){
                                            $i++;
                                            if ($rows100['status'] == 1) {

                                        ?>
                                        <tr>                                    
                                            <td><p><?php echo $i; ?></td>
                                            <td><p><?php echo $rows100['first_name']; ?> <?php echo $rows100['last_name']; ?></p></td>
                                            <td><p><?php echo $rows100['username_id']; ?></p></td>
                                            <td><p><?php echo $rows100['department_name']; ?></p></td>
                                            <td><p><?php echo $rows100['leave_date']; ?></p></td>
                                            <td><p><?php echo $rows100['reason']; ?></p></td>
                                            <td>
                                            <?php 
                                                if ($rows100['status'] == 0) {
                                                    echo "<span class=' btn-warning btn-sm'>Waiting</span>";
                                                }
                                                else if ($rows100['status'] == 1){
                                                    echo "<span class=' btn-success btn-sm '>Approved</span>";
                                                }
                                                else if($rows100['status'] == 3){
                                                    echo "<span class=' btn-danger btn-sm '>Rejected</span>";
                                                }
                                            }
                                            }   ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                
                    </div>
                </div>
            </div> 
            <!-----------------------------END MODAL---------------------------------->

            <!-----------------------------MODAL---------------------------------->
            <div class="modal fade in" id="see_canceled" tabindex="-1" >
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white ">
                            <h4 style="font-weight:bold;" >Rejected Leaves</h4>
                        </div>
                        <div class="modal-body">
                            <div>
                                <?php 
                                    $sql1000 = "SELECT *
                                                FROM leave_info 
                                                INNER JOIN account ON(account.username = leave_info.username_id)
                                                INNER JOIN department ON(department.ID_department = account.department_belong)
                                                WHERE account.level_log='head'
                                                ORDER BY leave_info.leave_date DESC  ";
                                    $result1000 = mysqli_query($conn, $sql100);
                                        
                                ?>
                                <table class="table table-light table-striped table-hover table-borderless">
                                    <?php if (mysqli_num_rows($result1000)) { ?>
                                    <thead class="table-dark">
                                    <tr>
                                        <th scope="col"><p>#</p></th>
                                        <th scope="col"><p>Name</p></th>
                                        <th scope="col"><p>Username</p></th>
                                        <th scope="col"><p>Department</p></th>
                                        <th scope="col"><p>Leave Date</p></th>
                                        <th scope="col"><p>Reason</p></th>
                                        <th scope="col"><p>Status</p></th>                                    
                                    </tr>
                                    </thead>
                                    <tbody >
                                        <?php 
                                            $i = 0;
                                            while($rows1000 = mysqli_fetch_assoc($result1000)){
                                            $i++;
                                            if ($rows1000['status'] == 3) {

                                        ?>
                                        <tr>                                    
                                            <td><p><?php echo $i; ?></td>
                                            <td ><p><?php echo $rows1000['first_name']; ?> <?php echo $rows1000['last_name']; ?></p></td>
                                            <td><p><?php echo $rows1000['username_id']; ?></p></td>
                                            <td><p><?php echo $rows1000['department_name']; ?></p></td>
                                            <td><p><?php echo $rows1000['leave_date']; ?></p></td>
                                            <td><p><?php echo $rows1000['reason']; ?></p></td>
                                            <td>
                                            <?php 
                                                if ($rows1000['status'] == 0) {
                                                    echo "<span class=' btn-warning btn-sm'>Waiting</span>";
                                                }
                                                else if ($rows1000['status'] == 1){
                                                    echo "<span class=' btn-success btn-sm '>Approved</span>";
                                                }
                                                else{
                                                    echo "<span class=' btn-danger btn-sm '>Rejected</span>";
                                                }
                                            }
                                            }   ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                
                    </div>
                </div>
            </div> 
            <!-----------------------------END MODAL---------------------------------->
        </div>
        </section>
        </div>
</body>
</html>
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
<script src="build/leave/js/jquery.min.js"></script>
<script src="build/leave/js/tether.min.js"></script>
<script src="build/leave/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
<script>
	CKEDITOR.replace('editor1');
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