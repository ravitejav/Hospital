<?php
include '../../connect.inc.php';
include '../../fun.inc.php';
require '../../header.php';
echo '<link rel="stylesheet" href="../../style.css">';
if(isset($_SESSION['userid']))
{
	$i=1;
	require 'next2.php';
	if(isset($_GET['iid']) && isset($_GET['type']))
	{
		$iid=$_GET['iid'];
		$type=$_GET['type'];
		if(!empty($iid))
		{
			$q="SELECT * FROM `user` WHERE `id`=".$iid." AND `type`='".$type."'";
			@$q_r=mysqli_query($con,$q);
			@$number=mysqli_num_rows($q_r);
			if($number==1)
			{
				@$data1=mysqli_fetch_assoc($q_r);
				$_SESSION['mainid']=$iid;
				header('location:removedone.php');
			}else
			{
				$_SESSION['error']="No records found!!!!!...";
			}
		}else
		{
			$_SESSION['error']="Please enter the id";
		}
	}
if($i==1)
{
?>
<center>
	<?php if(isset($_SESSION['error'])){ ?>
	<fieldset>
		<legend><font id="error">Message</font></legend>
		<?php echo "<font id='error'>".$_SESSION['error']."</font>"; unset($_SESSION['error']); ?>
	</fieldset>
	<?php } ?>
<fieldset>
	<legend><font id="error">Remove emplyee</font></legend>
<form action="remove.php" method="GET">
Id:<br /><input type="text" name="iid" value="<?php if(isset($iid)){ echo $iid;  } ?>" required="required"><br/>
Type:<br /><select name="type"><option>medicine</option><option>billing</option><option>recpeptionist</option><option>test</option><option>service</option></select><br />
<input type="submit" value="Search">
</form>
</fieldset>
<br /><a href="../emply.php"><input type="button" value="Back"></a>
</center>
<?php
}
}else
{
	header('location:../index.php');
}
echo "<div id='footer'>";
require '../../footer.php';
echo "</div>";;
?>
