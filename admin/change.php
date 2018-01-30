<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../bootstrap/style.css">';
if(isset($_SESSION['userid']))
{
	require 'next.php';
	if(isset($_POST['old']) && isset($_POST['new']) && isset($_POST['renew']))
	{
		$old=$_POST['old'];
		$new=$_POST['new'];
		$renew=$_POST['renew'];
		if(!empty($old) && !empty($new) && !empty($renew))
		{
			$query="SELECT * FROM `admin` WHERE `id`=".$_SESSION['userid'];
			@$queryrun=mysqli_query($con,$query);
			@$mydata=mysqli_fetch_assoc($queryrun);
			$oldhash=md5($old);
			if($oldhash===$mydata['password'])
			{
				if($new===$renew)
				{
					$query2="UPDATE `admin` SET `password`='".md5($new)."' WHERE `id`=".$_SESSION['userid'];
					@mysqli_query($con,$query2);
					$_SESSION['error']="Password changed successfully..";
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
	<?php if(isset($_SESSION['error'])){ ?>
	<script type="text/javascript">
		alert("<?php echo $_SESSION['error']; ?>");<? unset($_SESSION['error']); ?>
	</script>
	<?php } ?>
<div class="redi">
	<form action="change.php" method="POST">
		<table>
			<tr><td width="35%"></td><td>Old password</td><td><input type="password" name="old"></td><td width="35%"></td></tr><br />
			<tr><td width="35%"></td><td>New password</td><td><input type="password" name="new"></td><td width="35%"></td></tr><br />
			<tr><td width="35%"></td><td>Re-type new password</td><td><input type="password" name="renew"></td><td width="35%"></td></tr><br />
		</table>
		<input type="submit" value="Change password">
	</form>
</div>
<br /><a href="backend.php"> <input type="button" value="Back"></a>
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
