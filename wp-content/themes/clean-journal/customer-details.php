<?php
// Get data
$customer_name = $_POST["customer_name"];
$customer_email = $_POST["customer_email"];
$customer_sex = $_POST["customer_sex"];
$customer_age = $_POST["customer_age"];

// Database connection
$conn = mysqli_connect("localhost","qhqnpwmy_info_autodocg","4DZF%{6hvDQD","qhqnpwmy_info_autodocg");
if(!$conn) {
die(‘Problem in database connection: ‘ . mysql_error());
}

// Data insertion into database
$query = "INSERT INTO `qhqnpwmy_info_autodocg`.`wp_form` (`customer_name`, `customer_email`, `customer_sex`, `customer_age`) VALUES ('$customer_name', '$customer_email', '$customer_sex', '$customer_age')";
mysqli_query($conn, $query);

// Redirection to the success page
header("Location:www.google.com ");
?>