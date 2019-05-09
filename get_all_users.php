<?php
include 'db/db_connect.php';
$query = "SELECT id, first_name, last_name, address, phone, email, active_account 
FROM users";
$result = array();
$userArray = array();
$response = array();
if($stmt = $con->prepare($query)){
	$stmt->execute();
	$stmt->bind_result($id, $firstName, $lastName, $address, $phone, $email, $activeAccount);
	while($stmt->fetch()){
		$userArray["id"] = $id;
		$userArray["firstName"] = $firstName;
		$userArray["lastName"] = $lastName;	
		$userArray["address"] = $address;	
		$userArray["phone"] = $phone;	
		$userArray["email"] = $email;	
		if($activeAccount == 1){
			$userArray["activeAccount"] = "true";
		}else{
			$userArray["activeAccount"] = "false";
		}
		$result[]=$userArray;
	}
	$stmt->close();
	$response["success"] = 1;
	$response["userArrayList"] = $result;
}else{
	$response["success"] = 0;
	$response["message"] = mysqli_error($con);
}
//Display JSON response
echo json_encode($response);
?>