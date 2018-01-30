<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['medid']))
{
	require 'nextheader.php';
	if(isset($_POST['old']) && isset($_POST['new']) && isset($_POST['renew']))
	{
		$old=$_POST['old'];
		$new=$_POST['new'];
		$renew=$_POST['renew'];
		if(!empty($old) && !empty($new) && !empty($renew))
		{
			$query="SELECT * FROM `user` WHERE `id`=".$_SESSION['medid'];
			@$queryrun=mysqli_query($con,$query);
			@$mydata=mysqli_fetch_assoc($queryrun);
			$oldhash=md5($old);
			if($oldhash===$mydata['password'])
			{
				if($new===$renew)
				{
					$query2="UPDATE `user` SET `password`='".md5($new)."' WHERE `id`=".$_SESSION['medid'];
					$q="UPDATE `medicine` SET `password`='".md5($new)."' WHERE `id`=".$_SESSION['medid'];
					@mysqli_query($con,$query2);
					@mysqli_query($con,$q);
					$_SESSION['error']="The password changed succesfully";
				}else
				{
					$_SESSION['error']="The new passwords doesn't matched";
				}
			}else
			{
				$_SESSION['error']="The old password doesn't matched";
			}
		}
	}
?>
<center>
	<?php	if(isset($_SESSION['error'])){ ?>
	<fieldset>
		<legend><font id="error">Message</font></legend>
	<?php echo "<font color='red' size='5'>".$_SESSION['error']."</font><br />";	unset($_SESSION['error']); ?>
	</fieldset>
<?php	} ?>
<fieldset>
	<legend><font id="error">Change password:</font></legend>
			<form action="change.php" method="POST">
			<table>
			<tr><td>Old password</td><td><input type="password" required="required" name="old"></td></tr><br />
			<tr><td>New password</td><td><input type="password" required="required" name="new"></td></tr><br />
			<tr><td>Re-type new password</td><td><input type="password" name="renew"  required="required"></td></tr><br />
			<tr><td><input type="submit" value="Change password"></td><td></td></tr>
			</table>
			</form>
</fieldset>
<br /><a href="backend.php"><input type="button" value="Back"></a>
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
