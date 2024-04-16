<?php
include "config.php";
 
$userid = $_POST['userid'];
?>
<div class="form-group">
<div class="col-sm-7 ">
  <?php 
    $sql3 = "SELECT * FROM account WHERE department_belong=$userid";
    
    $result4 = mysqli_query($conn, $sql3);
  ?>
  <input type="text" name="id_depart" value="<?php echo $userid;?>" hidden>
  <select class="form-control rounded-pill" name="get_user_id" id="get_user_id"  required>
    <option value="" >Select Account...</option>
    <?php 
    if (mysqli_num_rows($result4)) {
      $i = 0;
      while($rows = mysqli_fetch_assoc($result4)){
      $i++;
    ?>
    <option value="<?php echo $rows['ID']; ?>"><?php echo $rows['first_name']; ?> <?php echo $rows['last_name']; ?></option>
    <?php } ?>
  </select>
  <?php } ?>

</div>


 
    