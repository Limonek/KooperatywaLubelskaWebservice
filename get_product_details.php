<?php
include 'db/db_connect.php';
$userArray = array();
$response = array();
$data = array();
if(isset($_GET['user_id'])){
	$userId = $_GET['user_id'];
	$query = "SELECT id, first_name, last_name, address, phone, email, active_account, administrator 
	FROM users WHERE id = ?";
	if($stmt = $con->prepare($query)){
		$stmt->bind_param("i",$userId);
		$stmt->execute();
		$stmt->bind_result($id, $firstName, $lastName, $address, $phone, $email, $activeAccount, $administrator);
		if($stmt->fetch()){
			$response["firstName"] = $firstName;			
			if($activeAccount == 1){
				$data["activeAccount"] = "true";
				$response["activeAccount"] = "true";
			}else{
				$data["activeAccount"] = "false";
				$response["activeAccount"] = "false";
			}
			if($administrator== 1){
				$data["administrator"] = "true";
				$response["actadministratoriveAccount"] = "true";
			}else{
				$data["administrator"] = "false";
				$response["administrator"] = "false";
			}

			$response["user"] = $data;		

			$response["success"] = 1;

		}else{
			$response["success"] = 0;
			$response["message"] = "User not found";
		}
		$stmt->close();
	}else{
		$response["success"] = 0;
		$response["message"] = mysqli_error($con);		
	}
}else{
	$response["success"] = 0;
	$response["message"] = "missing parameter user_id";
}

//Display JSON response
echo json_encode($response);
?>		