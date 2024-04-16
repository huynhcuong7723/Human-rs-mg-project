<?php
include "config.php";
 
$userid = $_POST['userid'];
 
$sql7 = 
"SELECT * FROM task_info WHERE task_id=$userid ";
$result7 = mysqli_query($conn,$sql7);
while( $row7 = mysqli_fetch_array($result7) ){
?>
<table border='0' width='auto'>
<tr><p>Task ID: <?php echo $row7['task_id']; ?></p>
    <p>Title: <?php echo $row7['task_tittle']; ?></p>
    <p>Description : <?php echo $row7['task_description']; ?></p>
    <p>Start Time: <?php echo $row7['start_time']; ?></p>
    <p>End Time: <?php echo $row7['end_time']; ?></p>
</tr>
</table>
 
<?php } ?>