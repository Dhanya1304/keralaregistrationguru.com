<?php
if(isset($_POST['document-number']) && isset($_POST['document-date']) && isset($_POST['auth-name']) && isset($_POST['sub-english']) && $_GET['id']!="")
{
    // Get data
    $doc_number  = $_POST['document-number'];
    $doc_date    = $_POST['document-date'];
    $auth_name   = $_POST['auth-name'];
    $sub_english = $_POST['sub-english'];
    $category_name= $_POST['category-name'];


    $doc_name     = $_POST['doc-name'];
    $rel_sec      = $_POST['rel-sec'];
    $rel_sub_sec  = $_POST['rel-sub-sec'];
    $rel_num      = $_POST['rel-num'];
    $synp_english = $_POST['synp-english'];
    $typ_text_eng = $_POST['typed-text-english'];
    $org_material = $_POST['org-material'];

    $id          = $_GET['id'];
    if($_GET['file']!="")
    {
        $old_file_name = $_GET['file'];
    }
    else
    {
        $old_file_name = "";
    }
    // Database connection
    $conn = mysqli_connect("localhost","qhqnpwmy_info_autodocg","4DZF%{6hvDQD","qhqnpwmy_info_autodocg");
    if(!$conn) {
        die(mysql_error());
    }
    // Data insertion into database
    $query = "UPDATE `qhqnpwmy_info_autodocg`.`wp_form` SET `document_number` = '$doc_number', `document_name` = '$doc_name', `relevant_section` = '$rel_sec', `sub_section` = '$rel_sub_sec', `category_name` = '$category_name', `relevant_number` = '$rel_num', `document_date` = '$doc_date', `authority_name` = '$auth_name', `synopsis_english` = '$synp_english', `typed_text` = '$typ_text_eng', `subject_english` = '$sub_english', `orginal_material` = '$org_material', `upload_form` = '$old_file_name' WHERE `wp_form`.`id` = '$id'";
    mysqli_query($conn, $query);
    $last_id =  mysqli_insert_id($conn);
    //echo "<pre>"; print_r($_FILES);die;
    if($_FILES['pdf_doc'] && $_FILES['pdf_doc']['name']!="")
    {
        $pic     = rand(1000,100000)."-".$_FILES['pdf_doc']['name'];
        $pic_loc = $_FILES['pdf_doc']['tmp_name'];
        $folder  = "wp-content/pdf/";
        if(move_uploaded_file($pic_loc,$folder.$pic))
        {
            $update_query = "UPDATE `qhqnpwmy_info_autodocg`.`wp_form` SET `upload_form` = '$pic' WHERE `wp_form`.`id` = '$id'";
            mysqli_query($conn, $update_query);
        }
    }
    header("location:".$_SERVER['HTTP_REFERER'].'&&mes=succ');
}
else
{
    header("location:".$_SERVER['HTTP_REFERER'].'&&mes=err');
}

?>