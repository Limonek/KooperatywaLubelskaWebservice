<?php
include 'db/db_connect.php';
$movieArray = array();
$response = array();
//Check for mandatory parameter movie_id
if(isset($_GET['user_id'])){
	$userId = $_GET['user_id'];
	//Query to fetch movie details
	$query = "SELECT id, name, surname FROM users WHERE id=?";
	if($stmt = $con->prepare($query)){
		//Bind movie_id parameter to the query
		$stmt->bind_param("i",$userId);
		$stmt->execute();
		//Bind fetched result to variables $movieName, $genre, $year and $rating
		$stmt->bind_result($id,$userName,$userSurname);
		//Check for results		
		if($stmt->fetch()){
			//Populate the movie array
			$movieArray["id"] = $userId;
			$movieArray["user_name"] = $userName;
			$movieArray["user_surname"] = $userSurname;			
			$response["success"] = 1;
			$response["data"] = $movieArray;				
		}else{
			//When movie is not found
			$response["success"] = 0;
			$response["message"] = "User not found";
		}
		$stmt->close();


	}else{
		//Whe some error occurs
		$response["success"] = 0;
		$response["message"] = mysqli_error($con);
		
	}

}else{
	//When the mandatory parameter movie_id is missing
	$response["success"] = 0;
	$response["message"] = "missing parameter aaauser_id";
}

//Display JSON response
echo json_encode($response);
?>