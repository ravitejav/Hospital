<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if($_SESSION['recpid'])
{
	require 'nextheader.php';
if(isset($_POST['patid']))
{
	$patid=$_POST['patid'];
 	if(!empty($patid))
	{
		$q3="SELECT * FROM `patient` WHERE `id`=".$patid;
		@$qr3=mysqli_query($con,$q3);
		@$pat1=mysqli_num_rows($qr3);
		@$pat=mysqli_fetch_assoc($qr3);
		if($pat1==1)
		{
			echo "<table border='5' bgcolor='lightgreen'>";
			echo "<tr><td>Hospatil bill</td><td>".$pat['hossbill']."</td></tr>";
			echo "<tr><td>Doctor bill</td><td>".$pat['docbill']."</td></tr>";
			echo "<tr><td>Test bill</td><td>".$pat['testbill']."</td></tr>";
			echo "<tr><td>Medicine bill</td><td>".$pat['medbill']."</td></tr>";
			echo "</table>";
		}else
		{
			$_SESSION['error']="Patient does not exist,enter the correct id";
		}
	}else
	{
		$_SESSION['error']="Please fill all the details....";
	}
}
?>
<center>
	<?php if(isset($_SESSION['error'])){ ?>
	<fieldset>
		<legend><font id="error">Change password</font></legend>
		<?php echo "<font id='error'>".$_SESSION['error']."</font>"; unset($_SESSION['error']); ?>
	</fieldset>
	<?php } ?>
	<fieldset>
		<legend><font id='error'>Stauts of patient bill</font></legend>
		<form method="POST" action="status.php">
			<table>
				<tr><td>Patient Id:</td><td><input type="text" required="required" name="patid"></td></tr>
	 			<tr><td><input type="submit" value="Check status"></td></tr>
			</table>
		</form>
	</fieldset>
	<a href="backend.php"><input type="button" value="back"></a>
</center>
<?php
}else
{
	header('location:index.php');
}
echo "<div id='footer'>";
require '../footer.php';
echo "</div>";
?>
