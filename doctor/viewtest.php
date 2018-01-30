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
			if($num==1)
			{
				$p='../tests/report/'.$idd.'.txt';
				if(file_exists($p))
				{
					$i=0;
					$handle=fopen($p,'r');
					$q=file_get_contents($p);
					fclose($handle);
				}else
				{
					$_SESSION['error']="Not attend any tests";
				}
			}else
			{
				$_SESSION['error']="No records found!!!!!....";
			}
		}else
		{
			$_SESSION['error']="Please fill the deatils..";
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
<form action="viewtest.php" method="GET">
Patient ID:<br /><input type="text" required="required" name="idd"><br />
<input type="submit" value="Fetch Report"><br />
</form>
</fieldset>
<a href="backend.php"><input type="button" value="Back"></a>
</center>
<?php
}
@$q2="SELECT * FROM `patient` WHERE `id`=".$idd;
$q_r2=mysqli_query($con,$q2);
@$data=mysqli_fetch_assoc($q_r2);
@$num=mysqli_num_rows($q_r2);
if($num==1)
{
	if(file_exists($p))
	{
		echo "<center><fieldset><legend><font id='error'>Report</font></legend>";
		echo "<table>";
		echo "<tr><td><table>";
		echo "<tr><td>Report</td></tr>";
		echo "<tr><td>Name: </td><td>".$data['name']."</td></tr>";
		echo "<tr><td>Patient Id: </td><td>".$data['id']."</td></tr>";
		echo "</table></td></tr>";
		echo "<td><tr><table>";
		echo "<tr><td>".$q."</td></tr>";
		echo "</table></td></tr>";
		echo "</table></fieldset></center>";
	}
}
}else
{
	header('location:index.php');
}
echo "<div id='footer'>";
require '../footer.php';
echo "</div>";
?>
