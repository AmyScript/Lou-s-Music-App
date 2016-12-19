<?php
session_start();
$sessionvalue = session_id();
include("dbfile.php");
$email ="";
$password ="";
$custID ="";

//echo $sessionvalue;


if(!empty($_POST['email']) && !empty($_POST['pswd']))
{
	// do processing
	$email = $_POST['email'];
	$password  = $_POST['pswd'];


	$custID = process_login($email,$password);

	if($custID > 0)
	{
		if(session_insert($custID,$sessionvalue))
		{
			header('Location: ./landingpage.php');
		}
		else
		{
			header('Location: index.php');
		}

	}
	else
	{
		header('Location: index.php');
	}
}
else
{

	header('Location: index.php');
}



function Session_insert($customerid, $sessval)
{
	global $connection;
	$sql = "call session_insert($customerid,'$sessval')";
	$connection->next_result();

	if($connection->query($sql))
	{
		if($connection->affected_rows > 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	else
	{
		return 0;
	}


}
function process_login($email, $password)
{
	global $connection;
	$password = md5($password);
	$sql ="call customer_verify_login('$email', '$password')";
	$connection->next_result();
	$result = $connection->query($sql);
	if($result->num_rows > 0)
	{
		$row = $result->fetch_row();
		$customer = $row[0];
		return $customer;
	}
	else
	{
		return 0;
	}
}

//header('Location: ./landingpage.php');
?>
