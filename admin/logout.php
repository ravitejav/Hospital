<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
if (isset($_SESSION['userid']))
{
	unset($_SESSION['userid']);
	header('location:index.php');
}else
{
	echo "Please <a href='index.php'><strong>Click</strong></a> here to log in";
}
?>
