<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "crazylouwah";
	$connection = new mysqli($host,$user,$password,$database);
	if($connection->connect_error)
	{
		die("Failed to Connect"); 
	}
?>