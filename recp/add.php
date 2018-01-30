<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['recid']))
{
	require 'next.php';
	if( isset($_POST['fname']) && isset($_POST['sname']) && isset($_POST['gender'])&& isset($_POST['date']) && isset($_POST['add']) && isset($_POST['email']) && isset($_POST['phone'])  && isset($_POST['pro']) && isset($_POST['pdesc']) &&  isset($_POST['hbill']) && isset($_POST['emer']) && isset($_POST['ref']))
	{
		$first=$_POST['fname'];$second=$_POST['sname'];$gender=$_POST['gender'];$date=$_POST['date'];$address=$_POST['add'];$email=$_POST['email'];$phone=$_POST['phone'];$pro=$_POST['pro'];$pdesc=$_POST['pdesc'];
		$hbill=$_POST['hbill'];$emer=$_POST['emer'];$ref=$_POST['ref'];
		if(!empty($first) && !empty($second) && !empty($gender) && !empty($address) && !empty($date) && !empty($email) && !empty($phone) && !empty($ref) && !empty($pro) && !empty($pdesc) && !empty($hbill)&& !empty($emer))
		{
			if($emer==2){$emer=0;}
      	$query="INSERT INTO `patient` VALUES ('','".$first."','".$second."','".$date."','".$gender."','".$address."',".$phone.",'".$email."',".$ref.",'".$pro."','".$pdesc."','','',".$hbill.",'','','','',".$emer.",'')";
				@$query_run=mysqli_query($con,$query);
				header('location:backend.php');
		}else
		{
			$_SESSION['error']="Please fill all deatils";
		}
	}
?>
<center>
    <?php if(isset($_SESSION['error'])){?>
  <fieldset>
    <legend><font id="error">Message</font></legend>
<?php  echo "<font id='error'>".$_SESSION['error']."</font>";unset($_SESSION['error']);?>
  </fieldset>
<?php  } ?>
<fieldset>
	<legend><font id="error">Add patient</font></legend>
<form method="POST" action="add.php" enctype="multipart/form-data">
<table>
	<tr><td>First name:</td><td><input type="text" name="fname" maxlength="30" required="required" ></td></tr>
	<tr><td>Father name:</td><td><input type="text" name="sname" maxlength="30" required="required"  ></td></tr>
	<tr><td>Date Of birth:</td><td><input type="text" name="date" maxlength="30" required="required"></td></tr>
	<tr><td>Gender:</td><td><select name="gender"><option>SELECT</option><option>Male</option><option>Female</option></select></td></tr>
	<tr><td>Address:</td><td><textarea name="add" maxlength="240" required="required" cols="33" rows="3" /></textarea></td></tr>
	<tr><td>Email:</td><td><input type="email" name="email" maxlength="40" required="required"  ></td></tr>
	<tr><td>Reference Doctor</td><td><?php
	$time=time()+(((4*60)+30)*60);
	$var=date('G:i:s',$time);
	if($var[1]!=':')
	{$v=$var[0].$var[1];}else{$v=$var[0];}
	$q="SELECT * FROM `doctor` WHERE `timinga`<=".$v." AND `timingb`>".$v;
	@$qr=mysqli_query($con,$q);@$num=mysqli_num_rows($qr);@$num1=$num;echo "<select name='ref'>";
	if($num!=0)
	{
			while($num--)
			{
					@$data=mysqli_fetch_assoc($qr);
					echo "<option value=".$data['id'].">".$data['first']." ".$data['last']."(".$data['speci'].")</option>";
			}
	}else{

		echo "<option value='0'> NO Doctors Available</option>";

}

	 echo "</select>";
	 ?></td></tr>
	<tr><td>Phone number:</td><td><input type="text" name="phone" maxlength="30" required="required" ></td></tr>
	<tr><td>Problem</td><td><input type="text" name="pro" maxlength="30"  required="required" /></td></tr>
	<tr><td>Problem Description:</td><td><textarea name="pdesc" cols="33" rows="3"></textarea></td></tr>
	<tr><td>Hospital Bill:</td><td><input type="text" name="hbill" /></td></tr>
	<tr><td>Emergency:</td><td><select name="emer" ><option>SELECT</option><option value="1">Emergency</option><option value="2">Non-Emergency</option></select></td></tr>
</table>
<input type="submit" value="Add Patient">
</form>
</fieldset>
<a href="backend.php"><input type="button" value="Back"></a>
</center>
<?php
}else
{
		header('location:index.php');
}
require '../footer.php';
 ?>
