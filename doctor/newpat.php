<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['docid']))
{
	$i=1;
		require 'nextheader.php';
	if(isset($_GET['idd']))
	{
		$idd=$_GET['idd'];
		if(!empty($idd))
		{
			$q2="SELECT * FROM `patient` WHERE `id`=".$idd;
			@$q_r2=mysqli_query($con,$q2);
			@$data=mysqli_fetch_assoc($q_r2);
			@$num=mysqli_num_rows($q_r2);
			if($data['emer']==0)
			{
				$q3="SELECT * FROM `doctor` WHERE `id`=".$data['refdoc'];
				@$q_r3=mysqli_query($con,$q3);
				@$d=mysqli_fetch_assoc($q_r3);
				if($num==1)
				{
					if($data['emer']==0)
					{
						$i=0;
						echo "<center><fieldset id='feed'><legend><font id='error'>Patient details</font></legend>";
						echo "<p id='tab'><label>Id:</label>".$data['id']."</p>";
						echo "<p id='tab'><label>Name:</label>".$data['name']."</p>";
						echo "<p id='tab'><label>Father name:</label>".$data['fname']."</p>";
						echo "<p id='tab'><label>Gender:</label>".$data['gender']."</p>";
						echo "<p id='tab'><label>Reference doctor:</label>".$d['first']." ".$d['last']."</p>";
						echo "<p id='tab'><label>Problem:</label>".$data['prob']."</p>";
						echo "<p id='tab'><label>Problem description:</label>".$data['probdes']."</p>";
						echo "<p id='tab'><label>Date of birth:</label>".$data['date']."</p>";
						echo "<p id='tab'><a href='addtab.php'><input type='button' value='Add tablets'></p>";
						echo "</fieldset></center>";
						$_SESSION['patid']=$data['id'];
					}
				}else
				{
					$_SESSION['error']="No records found!!!!....";
				}
			}else
			{
				header('location:viewem.php');
			}
		}
	}
	if($i==1)
	{
?>
<center>
    <?php if(isset($_SESSION['error'])){?>
  <fieldset>
    <legend><font id="error">Message</font></legend>
<?php  echo "<font id='error'>".$_SESSION['error']."</font>";unset($_SESSION['error']);?>
  </fieldset>
<?php  } ?>
<fieldset>
	<legend><font id="error">Patient</font></legend>
<form action="newpat.php" method="GET">
Patient ID:<br /><input type="text" required="required" name="idd"><br />
<input type="submit" value="Fetch details"><br />
</form>
</fieldset>
<a href="backend.php"><input type='button' value='Back'></a>
</center>
<?php
}
}else
{
	header('location:index.php');
}
echo "<div id='footer'>";
require '../footer.php';
echo "</div>";
?>
