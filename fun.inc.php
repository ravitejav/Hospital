<?php
ob_start();
session_start();
function adminloggedin()
{
	if(isset($_SESSION['userid']))
	  return true;
	else
	  return false;
}
function docloggedin()
{
	if(isset($_SESSION['docid']))
		return true;
	else
		return false;
}
function redirect($type)
{
	switch ($type)
	{
		case 'doctor':header('location:doctor/index.php');
			break;
		case 'medicine':header('location:med/index.php');
			break;
		case 'test':header('location:tests/index.php');
			break;
		case 'billing':header('location:billing/index.php');
			break;
		case 'recpeptionist':header('location:recp/index.php');
			break;
	  case 'services':header('location:serv/index.php');
				break;
		default:echo "error try again";
			header('location:index.php');
			break;
	}
}
function recploggedin()
{
	if(isset($_SESSION['recpid']))
		return true;
	else
		return false;
}
function recloggedin()
{
	if(isset($_SESSION['recid']))
		return true;
	else
		return false;
}
function medloggedin()
{
	if(isset($_SESSION['medid']))
		return true;
	else
		return false;
}
function testloggedin()
{
	if(isset($_SESSION['testid']))
		return true;
	else
		return false;
}
function serloggedin()
{
	if(isset($_SESSION['serid']))
		return true;
	else
		return false;
}
?>
