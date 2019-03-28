<?php 
define('DB_USER', "maciejbaza");
define('DB_PASSWORD', "Base!8965990");
define('DB_DATABASE', "limonekhusband");
define('DB_SERVER', "127.0.0.1");
define('DB_PORT', "3306");

$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE,DB_PORT);

if(mysqli_connect_errno()){
	echo "macije Failed to connect to MySQL: " . mysqli_connect_error();
} 
?>