<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['docid']))
{
		require 'nextheader.php';
	$tab=$_SESSION['tab'];
	$q2="SELECT * FROM `patient` WHERE `id`=".$_SESSION['patid'];
	@$q_r2=mysqli_query($con,$q2);
	@$data=mysqli_fetch_assoc($q_r2);
	@$num=mysqli_num_rows($q_r2);
	$q3="SELECT * FROM `doctor` WHERE `id`=".$data['refdoc'];
	@$q_r3=mysqli_query($con,$q3);
	@$my=mysqli_fetch_assoc($q_r3);
	echo "<fieldset><legend><font id='error'>Tablets</font></legend>";
	echo "Patient : ".$data['name'];
	echo "<form method='POST' action='emaddtabdone.php'>";
	echo "<table>";
	echo "<tr><td>Name</td><td>Number</td><td>Type</td></tr>";
	for ($i=0; $i < $tab; $i++)
	{
		echo "<tr><td><input type='text' required='required' name='".$i."a'></td><td><input type='text' required='required' name='".$i."b'></td><td><select name='".$i."c'><option>Tablets</option><option>Syrup</option><option>Powder</option></select></td></tr>";
	}
	echo "<tr><td>Total number of tablets:</td><td><input type='text' value='".$tab."' name='tabs' disabled><td>";
	echo "<tr><td><input type='submit' name='yes' value='Add tabs' /></td></tr>";
	echo "</table>";
	echo "</form>";
	if(isset($_POST['yes']))
	{
		for ($i=0; $i < $tab ; $i++)
		{
			$z=1;
			$f=$i.'a';$g=$i.'b';$h=$i.'c';
			if(isset($_POST[$f]) && isset($_POST[$g]) && isset($_POST[$h]))
			{
			}else
			{
				$z=0;
			}
		}
		for ($i=0; $i < $tab ; $i++)
		{
			$z1=1;
			$f=$i.'a';$g=$i.'b';$h=$i.'c';
			if(!empty($f) && !empty($g) && !empty($h))
			{
			}else
			{
				$z1=0;
			}
		}
		if($z==1)
		{
			if($z1==1)
			{
				$string="Patient name: ".$data['name']."\n\n\n";
				for ($i=0; $i < $tab ; $i++)
				{
					$f=$i.'a';$g=$i.'b';$h=$i.'c';
					$pk=$_POST[$f];$pk1=$_POST[$g];$pk2=$_POST[$h];
					$string=$string.$pk."\n"."                                         -".$pk1."  ".$pk2."\n";
				}
				$r='report/'.$_SESSION['patid'].'.txt';
				$handle=fopen($r,'w');
				fwrite($handle,$string);
				fclose($handle);
				header('location:backend.php');
			}else
			{
				echo "<center><fieldset><legend><font id='error'>Message</font></legend>Please fill all the details</fieldset></center>";
			}
		}else
		{
			echo "<center><fieldset><legend><font id='error'>Message</font></legend>please try again</fieldset></center>";
		}
	}
}
echo "<div id='footer'>";
require '../footer.php';
echo "</div>";
?>
