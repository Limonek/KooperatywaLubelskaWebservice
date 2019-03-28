<?php
include 'db/db_connect.php';
$response = array();

//Check for mandatory parameters
if(isset($_POST['user_name'])&&isset($_POST['user_surname'])){
	$userName = $_POST['user_name'];
	$userSurname = $_POST['user_surname'];
	
	//Query to insert a movie
	$query = "INSERT INTO users( name, surname) VALUES (?,?)";
	//Prepare the query
	if($stmt = $con->prepare($query)){
		//Bind parameters
		$stmt->bind_param("ss",$userName,$userSurname);
		//Exceting MySQL statement
		$stmt->execute();
		//Check if data got inserted
		if($stmt->affected_rows == 1){
			$response["success"] = 1;			
			$response["message"] = "User Successfully Added";			
			
		}else{
			//Some error while inserting
			$response["success"] = 0;
			$response["message"] = "Error while adding user";
		}					
	}else{
		//Some error while inserting
		$response["success"] = 0;
		$response["message"] = mysqli_error($con);
	}

}else{
	//Mandatory parameters are missing
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