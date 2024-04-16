<?php
    include('config.php');
    if (isset($_POST['approve'])){
		
        $appid = $_POST['appid'];
		$sql3 = "UPDATE leave_info SET status='1' WHERE id_leave = '$appid'";
		$run3 = mysqli_query($conn,$sql3);
		if($run3 == true){
			
			echo "<script> 
					alert('Application Approved');
					window.open('leave_head.php','_self');
				  </script>";
		}else{
			echo "<script> 
			alert('Failed To Approved');
			</script>";
		}
	}
	
	if (isset($_POST['cancel'])){
		
        $appid = $_POST['appid'];
		$sql3 = "UPDATE leave_info SET status='3' WHERE id_leave = '$appid'";
		$run3 = mysqli_query($conn,$sql3);
		if($run3 == true){
			
			echo "<script> 
					alert('Leave canceled');
					window.open('leave_head.php','_self');
				  </script>";
		}else{
			echo "<script> 
			alert('Failed To Canceled');
			</script>";
		}
    }
 ?>