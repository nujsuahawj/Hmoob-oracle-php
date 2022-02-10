<?php 

session_start();
require_once "config/db.php";

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$city_name = $_POST['city_name'];
	$email = $_POST['email'];
	$query = oci_parse($conn, "INSERT INTO employee(first_name,last_name,city_name,email) 
	values ('$first_name','$last_name','$city_name','$email')");
	$result = oci_execute($query);
	if ($result) {
        $_SESSION['success'] = "Data has been inserted successfully";
        header("location: index.php");
	}
	else{
		$_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: index.php");
	}
}


?>