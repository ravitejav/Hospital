<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
if (isset($_SESSION['recpid']))
{
	unset($_SESSION['recpid']);
	header('location:index.php');
}else
{
	header('location:index.php');
}
require '../../footer.php';
?>
