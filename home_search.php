<?php

	$doc_number    = $_POST['document_number'];
    $doc_name      = $_POST['document_name'];
    // $rel_number    = $_POST['relevant_number'];
    $auth_name     = $_POST['authority_name'];
    $subject_eng   = $_POST['subject_english'];
    $from_date     = $_POST['from_date'];
    $from_date     = str_replace("/","-",$from_date);
    $to_date       = $_POST['to_date'];
    $to_date       = str_replace("/","-",$to_date);
    

    $document_number = isset($doc_number)?$doc_number:'';
    $document_name   = isset($doc_name)?$doc_name:'';
    // $relevant_number = isset($rel_number)?$rel_number:'';
    $authority_name  = isset($auth_name)?$auth_name:'';
    $subject_english = isset($subject_eng)?$subject_eng:'';
    $from_doc_date   = ($from_date != '')?date("Y-m-d", strtotime($from_date)):'';
    $to_doc_date     = ($to_date != '')?date("Y-m-d", strtotime($to_date)):'';

    $document_start_year = '1800-01-01';


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
	
	$sql           = "SELECT * FROM wp_form WHERE";
    $where_query = '';
    $where          = array();

    if($document_number){
        //sql    .= "WHERE ";
        $where[] = " document_number like '%".$document_number."%' ";
    }
    if($document_name){
        //sql    .= "WHERE ";
        $where[] = " document_name like '%".$document_name."%' ";
    }
    // if($relevant_number){
    //     //sql    .= "WHERE ";
    //     $where[] = " relevant_number like '%".$relevant_number."%' ";
    // }
    if($authority_name){
        //sql    .= "WHERE ";
        $where[] = " authority_name like '%".$authority_name."%' ";
    }
    if($subject_english){
        //sql    .= "WHERE ";
        $where[] = " subject_english like '%".$subject_english."%' ";
    }
    if($from_doc_date && $to_doc_date){
        //echo $from_doc_date."--both";die;
        $where[] = " document_date BETWEEN '".$from_doc_date."' AND '".$to_doc_date."' ";
    }else{
        if($from_doc_date){
            //echo "start";die;
            $where[] = " document_date BETWEEN '".$from_doc_date."' AND '".date('Y-m-d')."' ";
        }
        if($to_doc_date){
            //echo "end";die;
            $where[] = " document_date BETWEEN '".$document_start_year."' AND '".$to_doc_date."' ";
        }
    }

    


    if(sizeof($where) > 0 )
    {
        $where_query = implode(' OR ', $where);
    }
    $where_total = $sql.$where_query;
    //echo $where_total;die;

	$result        = $conn->query($sql.$where_query); 
	
    $record_array  = array();
    while($row = $result->fetch_assoc()) {
    	array_push($record_array,$row);
    }
	echo json_encode($record_array);
?>