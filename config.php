<?php

    $conn = mysqli_connect("localhost", "root", "","final_web");

    if (!$conn) {
	    echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}

    // Set timezone 
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	mysqli_set_charset($conn, 'utf8');
	
?>