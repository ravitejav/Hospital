<?php
include 'fun.inc.php';
require 'header.php';
echo '<link rel="stylesheet" href="bootstrap/style.css">';
require "nextheader.php";
if(isset($_GET['type']))
{
	$type=$_GET['type'];
	if(!empty($type))
	{
		redirect($type);
	}
}
?>
<center>
	<div class="redi">
		<form method='GET' action='staff.php'>
			<font color="green" id="loginredi">Type:</font><br><br><select name="type" id="loginredi"><option>medicine</option><option>doctor</option><option>billing</option><option>recpeptionist</option><option>test</option><option>services</option></select><br />
			<br>
			<input type='submit' value='Log in' id="loginredi" onclick="alert('Redirecting to your login page')">
		</form>
	</div>
</center>
<?php
echo "<div id='footer'>";
require 'footer.php';
echo "</div>";
?>
