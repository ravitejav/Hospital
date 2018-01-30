<?php
include '../../connect.inc.php';
include '../../fun.inc.php';
require '../../header.php';
echo '<link rel="stylesheet" href="../../style.css">';
if(isset($_SESSION['userid']))
{
		require 'next2.php';
	if($_SESSION['mainid'])
	{
				$iid=$_SESSION['mainid'];
				$q="SELECT * FROM `user` WHERE `id`=".$iid;
				@$q_r=mysqli_query($con,$q);
				@$data1=mysqli_fetch_assoc($q_r);
				$q2="SELECT * FROM `".$data1['type']."` WHERE `id`=".$_SESSION['mainid'];
				@$q_r2=mysqli_query($con,$q2);
				@$data=mysqli_fetch_assoc($q_r2);
				echo "<center><fieldset><legend><font id='error'>Remove employee</font></legend><table>";
				echo "<tr><td>Photo</td><td><img src='profile/".$data['username'].".jpg' height='150' width='110'></td></tr>";
				echo "<tr><td>Id:</td><td>".$data['id']."</td></tr>";
				echo "<tr><td>Username:</td><td>".$data['username']."</td></tr>";
				echo "<tr><td>Name:</td><td>".$data['first']." ".$data['last']."</td></tr>";
				echo "<tr><td>Gender:</td><td>".$data['gender']."</td></tr>";
				echo "<tr><td>Qualification:</td><td>".$data['qua']."</td></tr>";
				echo "<tr><td>Address:</td><td>".$data['adress']."</td></tr>";
				echo "<tr><td>Email:</td><td>".$data['email']."</td></tr>";
				echo "<tr><td>Phone number:</td><td>".$data['phone']."</td></tr>";
				echo "<tr><td>Specilization:</td><td>".$data['type']."</td></tr>";
				echo "<tr><td>Timings:</td><td>".$data['timinga']." - ".$data['timingb']."</td></tr>";
				echo "<tr><td>Session:</td><td>".$data['session']."</td></tr>";
				echo "<tr><td>Salary:</td><td>".$data['sal']."</td></tr>";
				echo "<tr><td>Date of birth:</td><td>".$data['date']."</td></tr>";
				echo "</table></fieldset></center>";
				if(isset($_POST['con']))
				{
					$confirm=$_POST['con'];
					if(!empty($confirm))
					{
						$qu="SELECT * FROM `admin` WHERE `username`='".$_SESSION['username']."' AND `password`='".md5($confirm)."'";
						@$qurun=mysqli_query($con,$qu);
						@$num4=mysqli_num_rows($qurun);
						if($num4==1)
						{
							$q1="DELETE FROM `user` WHERE `id`=".$_SESSION['mainid'];
							$qw="DELETE FROM `".$data['type']."` WHERE `id`=".$_SESSION['mainid'];
							mysqli_query($con,$q1);
							mysqli_query($con,$qw);
							$a='profile/'.$data['username'].'.jpg';
							$b='cer/'.$data['username'].'.jpg';
							$c='addresspro/'.$data['username'].'.jpg';
							unlink($a);
							unlink($b);
							unlink($c);
							header('location:../index.php');
						}else
						{
							$_SESSION['error']="Wrong password, try again.";
						}
					}else
					{
						$_SESSION['error']="Please enter the password";
					}
				}
	}else
	{
		header('location:remove.php');
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
		<legend><font id="error">Confirm</font></legend>
<form action="removedone.php" method="POST">
Enter password to confirm to remove:<br /><input type="password" required="required" name="con" /><br />
<input type="submit" value="Remove"><br />
</fieldset>
<br /><a href="../emply.php"><input type="button" value="Cancel"></a>
</center>
<?php
}else
{
		header('location:../index.php');
}
require '../../footer.php';
?>
