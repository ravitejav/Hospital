<?php
include '../../connect.inc.php';
include '../../fun.inc.php';
require '../../header.php';
echo '<link rel="stylesheet" href="../../style.css">';
if(isset($_SESSION['userid']))
{
	require 'next1.php';
	if(isset($_GET['spc']) && isset($_GET['iid']))
	{
		$spc=$_GET['spc'];$iid=$_GET['iid'];
		if(!empty($spc) || !empty($iid))
		{
			if(!empty($iid))
			{
			    $query="SELECT * FROM `doctor` WHERE `speci`='".$spc."' AND `id`=".$iid;
			    @$query_run=mysqli_query($con,$query);
				  @$num=mysqli_num_rows($query_run);
				if($num!=0)
				{
				    $i=0;
				    echo "<table border='3'>";
				    echo "<tr><td>Id</td><td>Name</td><td>Address</td><td>Phone</td><td>Qualification</td><td>Specilization</td><td>Timing</td><td>Session</td><td>Salary</td><td>Doctor bill</td><td>Image</td></tr>";
				    while($i<$num)
				    {
				    	$data=mysqli_fetch_assoc($query_run);
				    	echo "<tr><td>".$data['id']."</td><td>".$data['first']." ".$data['last']."</td><td>".$data['adress']."</td><td>".$data['qua']."</td><td>".$data['phone']."</td><td>".$data['speci']."</td><td>".$data['timinga']." - ".$data['timingb']."</td><td>".$data['session']."</td><td>".$data['sal']."</td><td>".$data['docbill']."</td><td><img src='profile/".$data['username'].".jpg' height='150' width='100'></td></tr>";
				    	$i++;
				    }
				    echo "</table>";
				}else
				{
					$_SESSION['error']="No records found!!!!!..";
				}
			}else
			{
				$query2="SELECT * FROM `doctor` WHERE `speci`='".$spc."'";
			    @$query_run2=mysqli_query($con,$query2);
				  @$num=mysqli_num_rows($query_run2);
				if($num!=0)
				{
				    $i=0;
				    echo "<table border='3'>";
				    echo "<tr><td>Id</td><td>Name</td><td>Address</td><td>Phone</td><td>Qualification</td><td>Specilization</td><td>Timing</td><td>Session</td><td>Salary</td><td>Doctor bill</td><td>Image</td></tr>";
				    while($i<$num)
				    {
				    	@$data=mysqli_fetch_assoc($query_run2);
				    	echo "<tr><td>".$data['id']."</td><td>".$data['first']." ".$data['last']."</td><td>".$data['adress']."</td><td>".$data['qua']."</td><td>".$data['phone']."</td><td>".$data['speci']."</td><td>".$data['timinga']." - ".$data['timingb']."</td><td>".$data['session']."</td><td>".$data['sal']."</td><td>".$data['docbill']."</td><td><img src='profile/".$data['username'].".jpg' height='150' width='100'></td></tr>";
				    	$i++;
				    }
				    echo "</table>";
				}else
				{
					$_SESSION['error']="No records found!!!!!..";
				}
			}
		}else
		{
			$_SESSION['error']="Please fill all the required fields";
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
		<legend><font id="error">View doctor</font></legend>
<form action="view.php" method="GET">
Specilization:<br /><select name="spc"><option >General Physician</option><option >Pregnancy doctor</option><option >Children doctor(1 to 16)</option><option >Eye doctor</option><option >Skin doctor</option><option >ENT doctor</option><option >Bone doctor</option><option >Heart doctor</option><option >Nerve doctor</option><option >Dental doctor</option><option >Urologist</option><option >Mental disorder doctor</option><option >Diagonse</option><option >X-rays/Scanning doctor</option><option >anesthesia doctor</option><option >General Surgeon</option><option >Cancer doctor </option><option >Kidney</option><option >Throid doctor</option><option >Digestive doctor</option></select><br />
ID(Optional):<br /><input type="text" name="iid"><br />
<input type="submit" value="Search">
</fieldset>
</form>
<br /><a href="../doctor.php"><input type="button" value="Back"></a>
</center>
<?php
}else
{
	header('location:../index.php');
}
echo "<div id='footer'>";
require '../../footer.php';
echo "</div>";
?>
