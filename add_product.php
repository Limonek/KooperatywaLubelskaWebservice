<?php
include 'db/db_connect.php';
$response = array();

if(isset($_POST['user_name'])&&isset($_POST['user_surname'])){
	$userName = $_POST['user_name'];
	$userSurname = $_POST['user_surname'];
	
	$query = "INSERT INTO users( name, surname) VALUES (?,?)";
	if($stmt = $con->prepare($query)){
		$stmt->bind_param("ss",$userName,$userSurname);
		$stmt->execute();
		if($stmt->affected_rows == 1){
			$response["success"] = 1;			
			$response["message"] = "User Successfully Added";						
		}else{
			$response["success"] = 0;
			$response["message"] = "Error while adding user";
		}
	}else{
		$response["success"] = 0;
		$response["message"] = mysqli_error($con);
	}
}else{
	$response["success"] = 0;
	$response["message"] = "missing mandatory parameters";

	if(!isset($_POST['user_name'])){
		$response["message"] = "missing user_name";
	}else if(!isset($_POST['user_surname'])){
		$response["message"] = "missing user_surname";
	}
}
//Displaying JSON response
echo json_encode($response);
?>			