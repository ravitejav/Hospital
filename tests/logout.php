<?php
include '../connect.inc.php';
include '../fun.inc.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['testid']))
{
	unset($_SESSION['testid']);
	header('location:index.php');
}else
{
  header('location:index.php');
}
echo "<div id='footer'>";
require '../footer.php';
echo "</div>";
?>
