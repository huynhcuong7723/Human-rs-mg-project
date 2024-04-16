<?php
include "config.php";
 
$userid = $_POST['userid'];
 
$sql7 = 
"SELECT * FROM account WHERE ID=$userid ";
$result7 = mysqli_query($conn,$sql7);
while( $row7 = mysqli_fetch_array($result7) ){
?>
<table border='0' width='100%'>
<tr>
    <td width="150px"><img src="image/user/<?=$row7['avatar']?>" class="rounded-circle" style="width: 130px; margin: 0 10px 5px 50px;" >          
    <td style="padding:50px;">
    <p><?php echo $row7['first_name']; ?> <?php echo $row7['last_name']; ?></p>
    <p>ID : <?php echo $row7['ID']; ?></p>
    <p>Position : <?php echo $row7['position']; ?></p>
    <p>Username : <?php echo $row7['username']; ?></p>
    <p>Department : <?php 
    $asddsa=$row7['department_belong'];
    $sql70 = 
    "SELECT * FROM department WHERE ID_department='$asddsa'";
    $result70 = mysqli_query($conn,$sql70);
    $rowscheck = mysqli_fetch_assoc($result70);
    if (mysqli_num_rows($result70)){
        echo $rowscheck['department_name']; 
    }else {
        echo null;
    }
    ?></p>
    <p>Address : <?php echo $row7['address']; ?></p>
    </td>
</tr>
</table>
 
<?php } ?>