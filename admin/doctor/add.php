<?php
include '../../connect.inc.php';
include '../../fun.inc.php';
require '../../header.php';
echo '<link rel="stylesheet" href="../../style.css">';
if(isset($_SESSION['userid']))
{
	require 'next1.php';
	if(isset($_POST['docbill']) && isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['passa']) && isset($_POST['fname']) && isset($_POST['sname']) && isset($_POST['gender']) && isset($_POST['qual']) && isset($_POST['add']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['spc']) && isset($_POST['timea']) && isset($_POST['timeb']) && isset($_POST['sess']) && isset($_POST['sal']) && isset($_POST['date']))
	{
		$docbill=$_POST['docbill'];$usern=$_POST['username'];$pass1=$_POST['pass'];$pass2=$_POST['passa'];$first=$_POST['fname'];$second=$_POST['sname'];$gender=$_POST['gender'];$qual=$_POST['qual'];$address=$_POST['add'];$email=$_POST['email'];$phone=$_POST['phone'];$spc=$_POST['spc'];
		$time1=$_POST['timea'];$time2=$_POST['timeb'];$sess=$_POST['sess'];$sal=$_POST['sal'];$date=$_POST['date'];
		if(!empty($usern) && !empty($pass1) && !empty($pass2) && !empty($first) && !empty($second) && !empty($gender) && !empty($qual) && !empty($address) && !empty($email) && !empty($phone) && !empty($spc) && !empty($time1) && !empty($time2) && !empty($sess) && !empty($sal) && !empty($date))
        {
        	$q="SELECT * FROM `doctor` WHERE `username`='".$usern."'";
        	$q2="SELECT * FROM `user` WHERE `username`='".$usern."'";
        	$q_r=mysqli_query($con,$q);
        	$q_r2=mysqli_query($con,$q2);
        	@$num=mysqli_num_rows($q_r);
        	@$num2=mysqli_num_rows($q_r2);
        	if(($num!=1) && $num2!=1)
        	{
				if($pass1===$pass2)
				{
					if(($sess=='Day' && $time1<$time2) || ($sess=='Night' && $time2<$time1))
					{
						if (($_FILES['photo']['tmp_name']!='') && ($_FILES['cer']['tmp_name']!='') &&  ($_FILES['addpro']['tmp_name']!=''))
						{
							$target1 = 'profile/';
							$target2 = 'cer/';
							$target3 = 'addresspro/';
							$targetf1 = $target1.$usern.'.jpg';
							$targetf2 = $target2.$usern.'.jpg';
							$targetf3 = $target3.$usern.'.jpg';
							$uploadOk = 1;
							$imageFileType1 = pathinfo($targetf1,PATHINFO_EXTENSION);
							$imageFileType2 = pathinfo($targetf2,PATHINFO_EXTENSION);
							$imageFileType3 = pathinfo($targetf3,PATHINFO_EXTENSION);
							// Check if image file is a actual image or fake image
							$check1 = getimagesize($_FILES["photo"]["tmp_name"]);
							$check2 = getimagesize($_FILES["cer"]["tmp_name"]);
							$check3 = getimagesize($_FILES["addpro"]["tmp_name"]);
							if(($check1 !== false) && ($check2 !== false) && ($check3 !== false)) {
								//echo "File is an image - " . $check["mime"] . ".";
								$uploadOk = 1;
							} else {
								$_SESSION['error']="alert('Only Image Files are allowed')";
								$uploadOk = 0;
							}

							// Allow certain file formats
							if(($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg" && $imageFileType1 != "gif" ) && ($imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg" && $imageFileType2 != "gif" ) && ($imageFileType3 != "jpg" && $imageFileType3 != "png" && $imageFileType3 != "jpeg"&& $imageFileType3 != "gif" )) {
								$_SESSION['error']="alert('Only Image Files are allowed')";
								$uploadOk = 0;
							}

							// Check if $uploadOk is set to 0 by an error
							if ($uploadOk == 0)
							{
								$_SESSION['error']="alert('Sorry file was not uploaded')";
							// if everything is ok, try to upload file
							}else
							{
								if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetf1))
								{
									if (move_uploaded_file($_FILES["cer"]["tmp_name"], $targetf2))
									{
										if (move_uploaded_file($_FILES["addpro"]["tmp_name"], $targetf3))
										{
											// upload success
										}
										else
										{
											$_SESSION['error']="alert('There was a problem in uploading file')";
										}
									}
									else
									{
										$_SESSION['error']="alert('There was a problem in uploading file')";
									}
								}
								else
								{
									$_SESSION['error']="alert('There was a problem in uploading file')";
								}
						}
						$q3="INSERT INTO `user` VALUES ('','".$usern."','".md5($pass2)."','Doctor')";
						@$query_run2=mysqli_query($con,$q3);
						$q4="SELECT * FROM `user` WHERE `username`='".$usern."'";
						@$q_r4=mysqli_query($con,$q4);
						@$h=mysqli_fetch_assoc($q_r4);
						$query="INSERT INTO `doctor` VALUES (".$h['id'].",'".$usern."','".md5($pass1)."','".$first."','".$second."','".$gender."','".$qual."','".$address."','".$email."',".$phone.",'".$spc."',".$time1.",".$time2.",'".$sess."',".$sal.",'".$date."',".$docbill.")";
						@$query_run=mysqli_query($con,$query);
						header('location:../doctor.php');
					}
					}else
					{
						$_SESSION['error']="The timing and session didn't matched.";
					}
				}else
				{
				$_SESSION['error']="The two passwords didn't matched";
				}
			}else
			{
				$_SESSION['error']="The username already exists";

			}
		}else
		{
			$_SESSION['error']="Please enter the all the details.";
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
		<legend><font id="error">New doctor</font></legend>
		<form method="POST" action="add.php" enctype="multipart/form-data">
		<table>
			<tr><td>Username:</td><td><input type="text" name="username" required="required" maxlength="30" value="<?php if(isset($usern)) { echo $usern;	} ?>" /></td></tr>
			<tr><td>Password:</td><td><input type="password" required="required" name="pass" /></td></tr>
			<tr><td>Retype-Password:</td><td><input type="password" required="required" name="passa" /></td></tr>
			<tr><td>First name:</td><td><input type="text" name="fname" maxlength="30" required="required" value="<?php if(isset($first)) { echo $first;	} ?>" /></td></tr>
			<tr><td>Second name:</td><td><input type="text" name="sname" maxlength="30" required="required" value="<?php if(isset($second)) { echo $second;} ?>" /></td></tr>
			<tr><td>Gender:</td><td><select name="gender"><option>Male</option><option>Female</option></select></td></tr>
			<tr><td>Qualification:</td><td><input type="text" name="qual" required="required" maxlength="30" value="<?php if(isset($qual)) { echo $qual;} ?>" /></td></tr>
			<tr><td>Address:</td><td><textarea name="add" maxlength="240" required="required" value="<?php if(isset($address)) { echo $address;} ?>" /></textarea></td></tr>
			<tr><td>Email:</td><td><input type="email" name="email" maxlength="40" required="required" value="<?php if(isset($email)) { echo $email;} ?>" /></td></tr>
			<tr><td>Phone number:</td><td><input type="text" name="phone" required="required" value="<?php if(isset($phone)) { echo $phone;	} ?>" /></td></tr>
			<tr><td>Specilization:</td><td><select name="spc"><option >General Physician</option><option >Pregnancy doctor</option><option >Children doctor(1 to 16)</option><option >Eye doctor</option><option >Skin doctor</option><option >ENT doctor</option><option >Bone doctor</option><option >Heart doctor</option><option >Nerve doctor</option><option >Dental doctor</option><option >Urologist</option><option >Mental disorder doctor</option><option >Diagonse doctor</option><option >X-rays/Scanning doctor</option><option >anesthesia doctor</option><option >General Surgeon</option><option >Cancer doctor </option><option >Kidney</option><option >Throid doctor</option><option >Digestive doctor</option></select></td></tr>
			<tr><td>Timing</td><td><input type="text" name="timea" maxlength="2" value="<?php if(isset($time1)) { echo $time1;	} ?>"  required="required" />-<input type="text" value="<?php if(isset($time2)) { echo $time2;} ?>" required="required" name="timeb" maxlength="2" /></td></tr>
			<tr><td>Session:</td><td><select name="sess"><option>Day</option><option>Night</option></select></td></tr>
			<tr><td>Salary:</td><td><input required="required" type="text" name="sal" value="<?php if(isset($sal)) { echo $sal;	} ?>" maxlength="10" /></td></tr>
			<tr><td>Date of birth:</td><td><input type="date" required="required" value="<?php if(isset($date)) { echo $date;	} ?>" name="date" /></td></tr>
			<tr><td>Photo:</td><td><input type="file" name="photo" /></td></tr>
			<tr><td>Certificate:</td><td><input type="file" name="cer" /></td></tr>
			<tr><td>Adress proof:</td><td><input type="file" name="addpro" /></td></tr>
			<tr><td>Doctor bill</td><td><input type="text" name="docbill"></td></tr>
		</table>
		<input type="submit" value="Add doctor">
		</form>
	</fieldset
<br /><a href="../doctor.php"><input type="button" value="Back"></a>
</center>
<?php
}else
{
	header('location:../index.php');
}
require '../../footer.php';
?>
