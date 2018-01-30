<?php
include 'fun.inc.php';
include 'connect.inc.php';
require 'header.php';
echo '<link rel="stylesheet" href="bootstrap/style.css">';
echo '<script type="text/javascript" src="js/start.js"></script>';
require "nextheader.php";
if(isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['sub']) && isset($_POST['sug']))
{
	$name=$_POST['name'];$phone=$_POST['phone'];$email=$_POST['email'];$sub=$_POST['sub'];$sug=$_POST['sug'];
	if(!empty($name) && !empty($phone) && !empty($email) && !empty($sub) && !empty($sug))
	{
		$q="INSERT INTO `feedback`(`id`, `name`, `phone`, `email`, `subject`, `sug`) VALUES ('','".$name."','".$phone."','".$email."','".$sub."','".$sug."')";
		@mysqli_query($con,$q);
		header('location:index.php');
	}else
	{
		$_SESSION['error']="Fill all details......";
	}
}
?>
<center>
	<fieldset id="feed">
		<?php if(isset($_SESSION['error'])){ echo "<font id='error'>".$_SESSION['error']."</font>";unset($_SESSION['error']);} ?>
		<legend><font color="RED">FEEDBACK</font></legend>
			<form method="POST" action="feedback.php">
				<table height="80px	">
					<tr><td width="35%"></td><td id="fed"><label for='name'>Name:</label></td><td id="fed1"><input id="name type="text" required="required" name="name" maxlength="30"></td><td width="35%"></td></tr>
					<tr><td width="35%"></td><td id="fed"><label for='phone'>Phone number:</label></td><td id="fed1"><input  id="phone" type="text" required="required" name="phone" maxlength="16"></td><td width="35%"></td></tr>
					<tr><td width="35%"></td><td id="fed"><label for='email'>Email:</label></td><td id="fed1"><input id="email" type="text" name="email" required="required" maxlength="30"></td><td width="35%"></td></tr>
					<tr><td width="35%"></td><td id="fed"><label for='sub'>Subject:</label></td><td id="fed1"><input id="sub" type="text" name="sub" required="required" maxlength="80"></td><td width="35%"></td></tr>
					<tr><td width="35%"></td><td id="fed"><label for='sug'>Suggestion:</label></td><td id="fed1"><input id="sug" type="text" name="sug" required="required" maxlength="400"></td><td width="35%"></td></tr>
					<tr><td width="40%"></td><th><input type="submit" value="Send Feedback" onclick="formsubmit1()"></p><span id="status"></span></th><td width="40%"></td></tr>
				</table>
		</form>
	</fieldset>
</center>
<?php
echo "<div id='footer'>";
require 'footer.php';
echo "</div>";
?>
