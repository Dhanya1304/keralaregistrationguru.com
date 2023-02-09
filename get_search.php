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
		echo $_GET['keyword'];
	$sql           = "SELECT * FROM wp_form  WHERE document_number like '%".$keyword."%' OR document_date like '%".$keyword."%' OR authority_name like '%".$keyword."%' OR subject_english like '%".$keyword."%' OR upload_form like '%".$keyword."%'";
	$result        = $conn->query($sql); 
	$record_array  = array();
    while($row = $result->fetch_assoc()) {
    	array_push($record_array,$row);
    }
	echo json_encode($record_array);
?>