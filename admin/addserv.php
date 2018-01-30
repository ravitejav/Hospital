<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['userid']))
{
	require 'next.php';
	if(isset($_POST['serv']) && isset($_POST['cost']))
	{
		$serv=$_POST['serv'];
		$cost=$_POST['cost'];
		if(!empty($serv) && !empty($cost))
		{
			$query="INSERT INTO `serv` VALUES ('','".$serv."',".$cost.")";
			@$query_run=mysqli_query($con,$query);
			$q="SELECT * FROM `serv` WHERE `ser`='".$serv."' AND `cost`=".$cost;
			@$q_run=mysqli_query($con,$q);
			@$data=mysqli_fetch_assoc($q_run);
			$_SESSION['error']=$data['id']." is the ID of the ".$serv;
		}else
		{
			$_SESSION['error']="Please enter all the details";
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
		<legend><font id="error">Add services</font></legend>
<form method="POST" action="addserv.php">
<p>Service name:</p><p><input type="text" name="serv" maxlength="120"></p>
<p>cost:</p><p><input type="text" name="cost"></p>
<input type="submit" value="Add services"><br />
</form>
</fieldset>
<a href="backend.php"><input type="button" value="Back"></a>
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
