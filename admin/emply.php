<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['userid']))
{
require 'next2.php';
}else
{
	echo "Please <a href='index.php'><strong>Click</strong></a> here to log in";
}
echo "<div id='footer'>";
require '../footer.php';
echo "</div>";
?>
