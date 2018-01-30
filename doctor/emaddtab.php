<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['docid']))
{
		require 'nextheader.php';
	if(isset($_SESSION['patid']))
	{
		if(isset($_POST['tabs']))
		{
			$tab=$_POST['tabs'];
			if(!empty($tab))
			{
				$q2="SELECT * FROM `patient` WHERE `id`=".$_SESSION['patid'];
				@$q_r2=mysqli_query($con,$q2);
				@$data=mysqli_fetch_assoc($q_r2);
				@$num=mysqli_num_rows($q_r2);
				$q3="SELECT * FROM `doctor` WHERE `id`=".$data['refdoc'];
				@$q_r3=mysqli_query($con,$q3);
				@$my=mysqli_fetch_assoc($q_r3);
				if($num==1)
				{
					$q2="SELECT * FROM `doctor` WHERE `id`=".$_SESSION['patid'];
					@$q_r2=mysqli_query($con,$q2);
					@$data=mysqli_fetch_assoc($q_r2);
					$q="INSERT INTO `patient` ('docbill') VALUES (".$my['docbill'].") WHERE `id`=".$_SESSION['patid'];
					$_SESSION['tab']=$tab;
					header('location:emaddtabdone.php');
				}else
				{
					$_SESSION['error']="Please try again....";
				}
			}
		}
	}else
	{
		header('location:newpat.php');
	}
?>
<center>
    <?php  if(isset($_SESSION['error'])) {?>
  <fieldset>
    <legend><font id="error">Message</font></legend>
  <?php echo "<font id='error' >".$_SESSION['error']."</font>";unset($_SESSION['error']);  ?>
  </fieldset>
  <?php } ?>
<fieldset>
	<legend><font id="error">Patient</font></legend>
<form method="POST" action="emaddtab.php">
Total number of tablets:<br /><input type="text" required="required" name="tabs"><br />
<input type="submit" Value="Fetch">
</form>
</fieldset>
</center>
<?php
}
else
{
	header('location:index.php');
}
echo "<div id='footer'>";
require '../footer.php';
echo "</div>";
?>
