<?php
    include('config.php');
    if (isset($_POST['start_task'])){
		
        $id_user_start = $_POST['start_id'];
		$sql3 = "UPDATE task_info SET task_status='1' WHERE task_id = '$id_user_start'";
		$run3 = mysqli_query($conn,$sql3);
		if($run3 == true){
            header("Location: task_user.php");
		}else{
			echo "<script> 
			alert('Failed To Start');
			</script>";
		}
	}

    if (isset($_POST['cancel_task'])){
		
        $id_user_cancel = $_POST['cancel_id'];
		$sql4 = "UPDATE task_info SET task_status='2' WHERE task_id = '$id_user_cancel'";
		$run4 = mysqli_query($conn,$sql4);
		if($run4 == true){
            header("Location: task_info.php");
		}else{
			echo "<script> 
			alert('Failed To Cancel');
			</script>";
		}
	}

    if (isset($_POST['waiting_id'])){
        $id_user_waiting = $_POST['waiting_id_user'];
		$sql5 = "UPDATE task_info SET task_status='3' WHERE task_id = '$id_user_waiting'";
		$run5 = mysqli_query($conn,$sql5);
		if($run5 == true){
            header("Location: task_user.php");
		}else{
			echo "<script> 
			alert('Failed To Submit');
			</script>";
		}
	}

    if (isset($_POST['complete_task'])){
        $id_user_complete = $_POST['complete_id'];
		$sql6 = "UPDATE task_info SET task_status='5' WHERE task_id = '$id_user_complete'";
		$run6 = mysqli_query($conn,$sql6);
		if($run6 == true){
            header("Location: task_info.php");
		}else{
			echo "<script> 
			alert('Failed To Complete');
			</script>";
		}
	}

	if (isset($_POST['reject_task'])){
        $id_user_reject = $_POST['reject_id'];
		$sql7 = "UPDATE task_info SET task_status='4' WHERE task_id = '$id_user_reject'";
		$run7 = mysqli_query($conn,$sql7);
		if($run7 == true){
            header("Location: task_info.php");
		}else{
			echo "<script> 
			alert('Failed To Reject');
			</script>";
		}
	}


?>