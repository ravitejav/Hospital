<?php
$host="localhost";
$user="root";
$password="";
$db="hosp";
if(@$con=mysqli_connect($host,$user,$password,$db))
{
	if(@mysqli_select_db($con,$db))
	{

	}else
	{
		die("Error in the storage,Please try again");
	}
}else
{
	die("Error in the connection,Please try again");
}
?>
