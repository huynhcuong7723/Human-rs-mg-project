<?php

session_start();

include('config.php');

if(isset($_SESSION['username']) && ($_SESSION['level']=='head'))
{
  //Doc du lieu cho table
  $sql = "SELECT * FROM task_info ORDER BY task_id DESC";
  $result = mysqli_query($conn, $sql);

  //ADD
  if (isset($_POST['create'])) {
    function validate($data){
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
    }

    $task_tittle = validate($_POST['task_tittle']);
    $task_description = validate($_POST['task_description']);
    $start_time = validate($_POST['start_time']);
    $end_time = validate($_POST['end_time']);
    $assign_to = validate($_POST['assign_to']);



    $sql = "INSERT INTO task_info(task_tittle,task_description,start_time,end_time,task_user_id) 
    VALUES('$task_tittle','$task_description','$start_time','$end_time','$assign_to')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      header("Location: task_info.php?success=successfully created");
    }else {
    header("Location: task_info.php?error=unknown error occurred&");
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
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

      <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <!-- SIDE BAR -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        <!-- CSS style -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
      <style>
        * {
          font-family: 'Mukta', sans-serif; font-family: 'Poppins', sans-serif;
        }
        p{
          margin: 15px auto 5px auto;
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
      <div class="table-responsive table-dark" style="border-radius:20px;">
      <div class="table-wrapper ">
            <div class="table-title">
              <div class="row">
                <div class="col-sm-6">
                  <h2><b>Task Management</b></h2>
                  <span style="  color: white; font-size: 14px;color: #cfcfcf; "><?=$row1['position'] ?></span>
                  <span style="  color: white; font-size: 10px;color: #cfcfcf; font-weight:bold ; color:#ADFF2F;">ONLINE</span>
                  <br></br>
                </div>
 

              <div class="col-sm-2">
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#sumited_task">Submited Task</button>
              </div>
              <div class="col-sm-2">
              <button type="button" data-dismiss="modal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add New Task</button>
              </div>
              <div class="col-sm-2">
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejected_task">Rejected Task</button>
              </div>

              </div>
            </div>
      <!---------------------------Table BOX ------------------------------------------------------->
        <?php 
        $de_id=$_SESSION['department_belong'];
        $sql5 = "SELECT *
                    FROM task_info 
                    INNER JOIN account ON(task_info.task_user_id = account.ID)
                    where account.department_belong='$de_id'
                    ORDER BY task_info.task_id ";
        $result5 = mysqli_query($conn, $sql5);    
        ?> 
              <table id="example" class="table table-dark table-light table-striped table-hover table-borderless " style='height: 200px;'>
                <thead class="table-dark"> 
                  <tr>
                      <th scope="col"><p>Task ID</p></th>
                      <th scope="col"><p>Title</p></th>
                      <th scope="col"><p>Status</p></th>
                      <th scope="col"><p>Start time</p></th>
                      <th scope="col"><p>End time</p></th>
                      <th scope="col"></th>
                      <th scope="col"><p>Assign To</p></th>
                      <th scope="col"></th>
                      <th scope="col"></th>
                  </tr>
                </thead>

                <tbody>
                  
                  <?php 
                  if (mysqli_num_rows($result5)) {
                      $i = 0;
                      while($rows = mysqli_fetch_assoc($result5)){
                      $i++;
                  ?>
                
                  <tr>
                      <td><p><?php echo $rows['task_id']; ?></p></td>
                      <td><p><?php echo $rows['task_tittle']; ?></p></td>
                      <td><?php 
                                                if ($rows['task_status'] == 0) {
                                                    echo "<p><span class=' btn-primary btn-sm rounded-pill'>New</span></p>";
                                                }
                                                else if ($rows['task_status'] == 1){
                                                    echo "<p><span class=' btn-info btn-sm rounded-pill'>In progress</span></p>";
                                                }
                                                else if ($rows['task_status'] == 2){
                                                    echo "<p><span class=' btn-secondary btn-sm rounded-pill'>Cancel</span></p>";
                                                }
                                                else if ($rows['task_status'] == 3){
                                                    echo "<p><span class=' btn-warning btn-sm rounded-pill'>Waiting</span></p>";
                                                }
                                                else if ($rows['task_status'] == 4){
                                                    echo "<p><span class=' btn-danger btn-sm rounded-pill'>Rejected</span></p>";
                                                }
                                                else if ($rows['task_status'] == 5){
                                                    echo "<p><span class=' btn-success btn-sm rounded-pill'>Completed</span></p>";
                                                }
                                         
                                            ?></td>
                      <td><p><?php echo $rows['start_time']; ?></p></td>
                      <td><p><?php echo $rows['end_time']; ?></p></td>
                      <td><img src="image/user/<?php echo $rows['avatar']; ?>"class="rounded-circle" style="width: 40px; margin: 5px auto 5px auto;" ></td>
                      <td><p><?php echo $rows['first_name']; ?> <?php echo $rows['last_name']; ?></p></td>
                      <td><button data-id='<?php echo $rows['task_id']; ?>' class="userinfo btn btn-warning  " data-dismiss="modal">Detail</button></td>
                      <?php if ($rows['task_status'] == 0) { ?>
                          <td>                                            
                            <form action="action_task.php?id=<?php echo $rows['task_id']; ?>" method="POST">
                                <input type="hidden" name="cancel_id" value="<?php echo $rows['task_id']; ?>">
                                <input type="submit" class="btn  btn-danger" name="cancel_task" onclick="return confirm('Are you sure you want to Cancel this task?')" value="Cancel">
                            </form>
                          </td>

                      <?php } else {?>
                          <td></td>
                      <?php } ?>


                  </tr>
                  <?php } ?>

                </tbody>
              </table>
        <?php } ?>
      </div>
      </div>

      <!---------------------------END Table BOX ------------------------------------------------------->
      <script type='text/javascript'>
            $(document).ready(function(){
                $('.userinfo').click(function(){
                    var userid = $(this).data('id');
                    $.ajax({
                        url: 'des_task.php',
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
                    <div class="modal-content " >
                        <div class="modal-body1" Style="margin:30px">
                        </div>
                        <div class="modal-footer"style="border:0;">
                        </div>
                    </div>
                </div>
        </div>
      <!---------------------------MODAL ADD ------------------------------------------------------->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog text-dark">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel"></h5>
              <h2 style="font-weight: bold">Create Task</h2>
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
                    <label for="task_tittle" style="font-weight: bold">Tittle of task </label>
                    <input type="task_tittle" 
                          class="form-control" 
                          id="task_tittle" 
                          name="task_tittle" 
                          value="<?php if(isset($_GET['task_tittle']))
                                          echo($_GET['task_tittle']); ?>" 
                          placeholder="Enter tittle">
                  </div>

                  <div class="form-group">
                    <label for="task_description" style="font-weight: bold">Description of task </label>
                    <input type="task_description" 
                          class="form-control" 
                          id="task_description" 
                          name="task_description" 
                          value="<?php if(isset($_GET['task_description']))
                                          echo($_GET['task_description']); ?>" 
                          placeholder="Enter description">
                  </div>

                  <div class="form-group">
                        <label class="control-label col-sm-5" style="font-weight: bold" >Start Time</label>
                        <div class="col-sm-7">
                          <input type="text" name="start_time" id="start_time" class="form-control" value="<?php if(isset($_GET['start_time'])) echo($_GET['start_time']); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-5" style="font-weight: bold" >End Time</label>
                        <div class="col-sm-7">
                          <input type="text" name="end_time" id="end_time" class="form-control" value="<?php if(isset($_GET['end_time'])) echo($_GET['end_time']); ?>">
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label class="control-label col-sm-5" style="font-weight: bold">Assign To</label>
                        <div class="col-sm-7">
                          <?php 
                            $sql = "SELECT ID, first_name,last_name FROM account WHERE department_belong=$de_id and level_log='user'";
                            $result4 = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result4)) {
                          ?>
                          <select class="form-control" name="assign_to" id="assign_to" required>
                            <option value="">Select Employee...</option>
                            <?php 
                              $i = 0;
                              while($rows = mysqli_fetch_assoc($result4)){
                              $i++;
                            ?>
                            <option value="<?php echo $rows['ID']; ?>"><?php echo $rows['first_name']; ?> <?php echo $rows['last_name']; ?></option>
                            <?php } ?>
                          </select>
                          <?php } ?>

                        </div>
                        <div class="fade">xcxzcxzczxczxcxc</div>
                  
                      </div>
                    <div class="modal-footer">
                      <button type="sumit" class="btn btn-primary"  name="create" >Create</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
            </form>
          </div>
        </div>
      </div>
      </div>

      <!---------------------------END MODAL ADD ------------------------------------------------------->

      <!-----------------------------MODAL---------------------------------->
      <div class="modal fade" id="rejected_task" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white ">
                <h4 style="font-weight:bold;" >Rejected Task</h4>
            </div>

            <div class="modal-body">
              <table class="table table-light table-striped table-hover table-borderles">
                <?php 
                  $asdasd=$_SESSION['department_belong'];
                  $sql001 = "SELECT *
                              FROM task_info 
                              INNER JOIN account ON(task_info.task_user_id = account.ID)
                              WHERE account.department_belong='$asdasd'
                              ORDER BY task_info.task_id ";
                  $result001 = mysqli_query($conn, $sql001);
                  if (mysqli_num_rows($result001)) {   
                ?>
                
                <thead class="table-dark">
                    <tr>
                        <th scope="col"><p>#</p></th>
                        <th scope="col"><p>Task ID</p></th>
                        <th scope="col"><p>Title</p></th>
                        <th scope="col"><p>Status</p></th>
                        <th scope="col"><p>Description</p></th>
                        <th scope="col"><p>Start time</p></th>
                        <th scope="col"><p>End time</p></th>
                        <th scope="col"><p>Assign To</p></th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody >
                    <?php 
                        $i = 0;
                        while($rows001 = mysqli_fetch_assoc($result001)){
                        $i++;
                        if ($rows001['task_status'] == 4) {
                    ?>

                    <tr>                                    
                        <td scope="row"><p><?=$i?></p></td>
                        <td><p><?php echo $rows001['task_id']; ?></p></td>
                        <td><p><?php echo $rows001['task_tittle']; ?></p></td>
                        <td><?php 
                                                    if ($rows001['task_status'] == 0) {
                                                        echo "<p><span class=' btn-primary btn-sm rounded-pill'>New</span></p>";
                                                    }
                                                    else if ($rows001['task_status'] == 1){
                                                        echo "<p><span class=' btn-info btn-sm rounded-pill'>In progress</span></p>";
                                                    }
                                                    else if ($rows001['task_status'] == 2){
                                                        echo "<p><span class=' btn-secondary btn-sm rounded-pill'>Cancel</span></p>";
                                                    }
                                                    else if ($rows001['task_status'] == 3){
                                                        echo "<p><span class=' btn-warning btn-sm rounded-pill'>Waiting</span></p>";
                                                    }
                                                    else if ($rows001['task_status'] == 4){
                                                        echo "<p><span class=' btn-danger btn-sm rounded-pill'>Rejected</span></p>";
                                                    }
                                                    else if ($rows001['task_status'] == 5){
                                                        echo "<p><span class=' btn-success btn-sm rounded-pill'>Completed</span></p>";
                                                    }
                                                ?></td>
                        <td ><p><?php echo $rows001['task_description']; ?></p></td>
                        <td><p><?php echo $rows001['start_time']; ?></p></td>
                        <td><p><?php echo $rows001['end_time']; ?></p></td>
                        <td><p><?php echo $rows001['first_name']; ?> <?php echo $rows001['last_name']; ?></p></td>

                        <?php }} ?>
                    </tr>
                </tbody>
                
              </table>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>

      <!-----------------------------END MODAL---------------------------------->

            <!-----------------------------MODAL---------------------------------->
      <div class="modal fade" id="sumited_task" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white ">
                <h4 style="font-weight:bold;" >Submited Task</h4>
            </div>

            <div class="modal-body">
              <table class="table table-light table-striped table-hover table-borderles">
                <?php 
                  $asdasd=$_SESSION['department_belong'];
                  $sql001 = "SELECT *
                              FROM task_info 
                              INNER JOIN account ON(task_info.task_user_id = account.ID)
                              WHERE account.department_belong='$asdasd'
                              ORDER BY task_info.task_id ";
                  $result001 = mysqli_query($conn, $sql001);
                  if (mysqli_num_rows($result001)) {   
                ?>
                
                <thead class="table-dark">
                    <tr>
                        <th scope="col"><p>#</p></th>
                        <th scope="col"><p>Task ID</p></th>
                        <th scope="col"><p>Title</p></th>
                        <th scope="col"><p>Status</p></th>
                        <th scope="col"><p>Description</p></th>
                        <th scope="col"><p>Start time</p></th>
                        <th scope="col"><p>End time</p></th>
                        <th scope="col"><p>Assign To</p></th>
                        <th scope="col"></th>
                        <th scope="col"></th>

                    </tr>
                </thead>

                <tbody >
                    <?php 
                        $i = 0;
                        while($rows001 = mysqli_fetch_assoc($result001)){
                        $i++;
                        if ($rows001['task_status'] == 3) {
                    ?>

                    <tr>                                    
                        <td scope="row"><p><?=$i?></p></td>
                        <td><p><?php echo $rows001['task_id']; ?></p></td>
                        <td><p><?php echo $rows001['task_tittle']; ?></p></td>
                        <td><?php 
                                                    if ($rows001['task_status'] == 0) {
                                                        echo "<p><span class=' btn-primary btn-sm rounded-pill'>New</span></p>";
                                                    }
                                                    else if ($rows001['task_status'] == 1){
                                                        echo "<p><span class=' btn-info btn-sm rounded-pill'>In progress</span></p>";
                                                    }
                                                    else if ($rows001['task_status'] == 2){
                                                        echo "<p><span class=' btn-secondary btn-sm rounded-pill'>Cancel</span></p>";
                                                    }
                                                    else if ($rows001['task_status'] == 3){
                                                        echo "<p><span class=' btn-warning btn-sm rounded-pill'>Waiting</span></p>";
                                                    }
                                                    else if ($rows001['task_status'] == 4){
                                                        echo "<p><span class=' btn-danger btn-sm rounded-pill'>Rejected</span></p>";
                                                    }
                                                    else if ($rows001['task_status'] == 5){
                                                        echo "<p><span class=' btn-success btn-sm rounded-pill'>Completed</span></p>";
                                                    }
                                                ?></td>
                        <td ><p><?php echo $rows001['task_description']; ?></p></td>
                        <td><p><?php echo $rows001['start_time']; ?></p></td>
                        <td><p><?php echo $rows001['end_time']; ?></p></td>
                        <td><p><?php echo $rows001['first_name']; ?> <?php echo $rows001['last_name']; ?></p></td>
                        <td>
                        <form action="action_task.php?id=<?php echo $rows001['task_id']; ?>" method="POST">
                            <input type="hidden" name="complete_id" value="<?php echo $rows001['task_id']; ?>">
                            <input type="submit" class="btn  btn-success" name="complete_task" onclick="return confirm('Are you sure you want to Complete this task?')" value="Complete">
                        </form>
                        </td>
                        <td>
                        <form action="action_task.php?id=<?php echo $rows001['task_id']; ?>" method="POST">
                            <input type="hidden" name="reject_id" value="<?php echo $rows001['task_id']; ?>">
                            <input type="submit" class="btn  btn-danger" name="reject_task" onclick="return confirm('Are you sure you want to Reject this task?')" value="Reject">
                        </form>
                        </td>
                        <?php }} ?>
                    </tr>
                </tbody>
                
              </table>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>

      <!-----------------------------END MODAL---------------------------------->
    </div>
  </div>
  </section>
  
  <?php 
  } else {
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
  flatpickr('#start_time', {
    enableTime: true
  });

  flatpickr('#end_time', {
    enableTime: true
  });
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
</body>
</html> 

