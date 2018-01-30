<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if($_SESSION['recpid'])
{
	require 'nextheader.php';
$time=time()+(((4*60)+30)*60);
if(isset($_POST['patid']) && isset($_POST['amt']) && isset($_POST['bill']))
{
	$patid=$_POST['patid'];$amt=$_POST['amt'];$bill=$_POST['bill'];
 	if(!empty($patid) && !empty($amt) && !empty($bill))
	{
		$q3="SELECT * FROM `patient` WHERE `id`=".$patid;
		@$qr3=mysqli_query($con,$q3);
		@$pat1=mysqli_num_rows($qr3);
		@$pat=mysqli_fetch_assoc($qr3);
		if($pat1==1)
		{
			if($pat['serbill']>0)
			{
				$compbill=$pat['serbill']-$amt;
				if($compbill>=0)
				{
					$q="INSERT INTO `billed` VALUES ('',".$patid.",".$_SESSION['recpid'].",".$amt.",'Service bill','".date('D M Y',$time)."','".date('H:i:s',$time)."')";
					@$qr=mysqli_query($con,$q);
					$q1="SELECT * FROM `billed` WHERE `patid`=".$patid." AND `billerid`=".$_SESSION['recpid']." AND `billamt`=".$amt." AND `date`='".date('D M Y',$time)."' AND `time`='".date('H:i:s',$time)."'";
					@$qr2=mysqli_query($con,$q1);
					@$data=mysqli_fetch_assoc($qr2);
					$q4="SELECT * FROM `billing` WHERE `id`=".$_SESSION['recpid'];
					@$qr4=mysqli_query($con,$q4);
					@$d4data=mysqli_fetch_assoc($qr4);
					$string="\n"."\n"."\n"."Bill Id: ".$data['id']."\n"."patient Name:".$pat['name']."                                                      "."Date:".$data['date']."\n";
					$string=$string."Biller Name:".$d4data['first']." ".$d4data['last']."                                                         "."Time:".$data['time']."\n";
					$string=$string."-------------------------------------------------------------------------------------------------"."\n".$data['forwhat']."                                         ".$amt."\n\n\n\n\n\n\n\n\n";
					$string=$string."-------------------------------------------------------------------------------------------------"."\n"."Total amount:                                          ".$amt."\n\n\n\n"."																Sign";
					$r='report/'.$patid.'.txt';
					$handle=fopen($r,'a');
					fwrite($handle,$string);
					fclose($handle);
					$query="UPDATE `patient` SET `serbill`=".$compbill." WHERE `id`=".$patid;
					@mysqli_query($con,$query);
					header('location:backend.php');
				}else
				{
					$_SESSION['error']="His bill is the ".$pat['serbill']."\n".",Please pay the exact amount";
				}
			}else
			{
				$_SESSION['error']="There is no bill have to pay by patient <strong>".$pat['name']."</strong>";
			}
		}else
		{
			$_SESSION['error']="Patient does not exist,enter the correct id";
		}
	}else
	{
		$_SESSION['error']="Please fill all the details....";
	}
}
?>
<center>
	<?php if(isset($_SESSION['error'])){ ?>
	<fieldset>
		<legend><font id="error">Bill</font></legend>
		<?php echo "<font id='error'>".$_SESSION['error']."</font>"; unset($_SESSION['error']); ?>
	</fieldset>
	<?php } ?>
	<fieldset>
		<legend><font id="error">Service billing</font></legend>
		<form method="POST" action="bills.php">
			<table>
				<tr><td>Patient Id:</td><td><input type="text" required="required" name="patid"></td></tr>
				<tr><td>Biller Id:</td><td><?php echo $_SESSION['recpid']; ?></td></tr>
				<tr><td>Billing amount:</td><td><input type="text" required="required" name="amt"></td><td>Time:</td><td><?php echo date('H:i:s',$time); ?></td></tr>
				<tr><td>For:</td><td><input type="text" required="required" value="Services bill" name="bill" readonly></td><td>Date:</td><td><?php echo date('D M Y',$time); ?></td></tr>
			 	<tr><td><input type="submit" value="Add bill"></td></tr>
			</table>
		</form>
	</fieldset>
<br /><br /><br /><a href="backend.php"><input type="button" value="back"></a>
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
