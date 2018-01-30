<?php
include '../connect.inc.php';
include '../fun.inc.php';
echo '<link rel="stylesheet" href="../style.css">';
if (isset($_SESSION['medid']))
{
	unset($_SESSION['medid']);
	header('location:index.php');
}else
{
header('location:index.php');
}
echo "<div id='footer'>";
require '../footer.php';
echo "</div>";
?>
