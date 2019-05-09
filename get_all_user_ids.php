<?php
include 'db/db_connect.php';
$query = "SELECT id
FROM users";
$result = array();
$userIdArray = array();
$response = array();
if($stmt = $con->prepare($query)){
	$stmt->execute();
	$stmt->bind_result($id);
	while($stmt->fetch()){
		$userIdArray["id"] = $id;
		$result[]=$userIdArray;
	}
	$stmt->close();
	$response["success"] = 1;
	$response["userIdArray"] = $result;
}else{
	$response["success"] = 0;
	$response["message"] = mysqli_error($con);
}
//Display JSON response
echo json_encode($response);
?>	