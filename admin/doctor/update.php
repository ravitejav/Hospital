<?php
include '../../connect.inc.php';
include '../../fun.inc.php';
require '../../header.php';
echo '<link rel="stylesheet" href="../../style.css">';
if(isset($_SESSION['userid']))
{
	require 'next1.php';
	if(isset($_GET['id']))
	{
		$iid=$_GET['id'];
		if (!empty($iid))
		{
			$q2="SELECT * FROM `doctor` WHERE `id`=".$iid;
			@$q_r2=mysqli_query($con,$q2);
			@$data=mysqli_fetch_assoc($q_r2);
			@$num=mysqli_num_rows($q_r2);
			if($num==1)
			{
				$_SESSION['updateid']=$iid;
				header('location:updatedone.php');
			}else
			{
				$_SESSION['error']="No records found!!!!....";
			}
		}
	}
?>
<center>
	<?php if(isset($_SESSION['error'])){ ?>
	<fieldset>
		<legend><font id="error">Message</font></legend>
		<?php echo "<font id='error'>".$_SESSION['error']."</font>"; unset($_SESSION['error']); ?>
	</fieldset>
	<?php } ?>
	<fieldset>
		<legend><font id="error">Update doctor</font></legend>
<form>
Id:<br /><input type="text" value="<?php if(isset($iid)){ echo $iid;} ?>" name="id"><br />
<input type="submit" value="Search">
</form>
</fieldset>
<br /><a href="../doctor.php"><input type="button" value="Back"></a>
</center>
<?php
}else
{
	header('location:index.php');
}
echo "<div id='footer'>";
require '../../footer.php';
echo "</div>";
?>
