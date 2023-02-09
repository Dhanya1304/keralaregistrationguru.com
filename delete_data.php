<?php
	$keyword    = $_POST['keyword'];
	$servername = "localhost";
	$username   = "qhqnpwmy_info_autodocg";
	$password   = "4DZF%{6hvDQD";
	$dbname     = "qhqnpwmy_info_autodocg";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	     die("Connection failed: " . $conn->connect_error);
	} 

    $get_data_sql = "SELECT upload_form FROM wp_form WHERE id='".$keyword."'";
    $result       = $conn->query($get_data_sql);
    $final        = $result->fetch_assoc();

    if($final['upload_form'] != ''){
        $path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/pdf/'.$final['upload_form'];
        unlink($path);
    }

	$sql           = "DELETE FROM wp_form WHERE id='".$keyword."'";
	$result        = $conn->query($sql); 

    echo json_encode(true);
	
?>