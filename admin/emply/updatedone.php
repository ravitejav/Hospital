<?php
include '../../connect.inc.php';
include '../../fun.inc.php';
require '../../header.php';
echo '<link rel="stylesheet" href="../../style.css">';
if(isset($_SESSION['userid']))
{
		require 'next2.php';
	if(isset($_SESSION['updateid']))
	{
		$iid=$_SESSION['updateid'];
		$q="SELECT * FROM `user` WHERE `id`=".$iid;
		@$q_r=mysqli_query($con,$q);
		@$data1=mysqli_fetch_assoc($q_r);
		$q2="SELECT * FROM `".$data1['type']."` WHERE `id`=".$iid;
		@$q_r2=mysqli_query($con,$q2);
		@$data=mysqli_fetch_assoc($q_r2);
		@$num=mysqli_num_rows($q_r2);
		if(!empty($iid))
		{
			if(isset($_POST['add']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['timea']) && isset($_POST['timeb']) && isset($_POST['sess']) && isset($_POST['sal']))
			{
				$address=$_POST['add'];$email=$_POST['email'];$phone=$_POST['phone'];$time1=$_POST['timea'];$time2=$_POST['timeb'];$sess=$_POST['sess'];$sal=$_POST['sal'];
				if(!empty($address) && !empty($email) && !empty($phone) && !empty($time1) && !empty($time2) && !empty($sess) && !empty($sal))
				{
					if(($sess=='Day' && $time1<$time2) || ($sess=='Night' && $time2<$time1))
					{
						if ($_FILES['addproof']['tmp_name']!='')
						{
							$target3 = 'addresspro/';
							$targetf3 = $target3.$data['username'].'.jpg';
							$uploadOk =1;
							$imageFileType3 = pathinfo($targetf3,PATHINFO_EXTENSION);
							// Check if image file is a actual image or fake image
							$check3 = getimagesize($_FILES["addproof"]["tmp_name"]);
							if($check3 !== false)
							{
								//echo "File is an image - " . $check["mime"] . ".";
								$uploadOk = 1;
							} else {
								$_SESSION['error']="alert('Only Image Files are allowed')";
								$uploadOk = 0;
							}
							// Allow certain file formats
							if($imageFileType3 != "jpg" && $imageFileType3 != "png" && $imageFileType3 != "jpeg" && $imageFileType3 != "gif" )
							{
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
								if (move_uploaded_file($_FILES["addproof"]["tmp_name"], $targetf3))
								{
									// upload success
								}
								else
								{
									$_SESSION['error']="alert('There was a problem in uploading file')";
								}
							}
							$query="UPDATE `".$data['type']."` SET `adress`='".$address."',`email`='".$email."',`phone`=".$phone.",`timinga`=".$time1.",`timingb`=".$time2.",`session`='".$sess."',`sal`=".$sal." WHERE `id`=".$iid;
							@$queryrun=mysqli_query($con,$query);
							$_SESSION['error']="Update successfully done";
						}
					}else
					{
						$_SESSION['error']="The timing and session is not matched";
					}
				}else
				{
					$_SESSION['error']="Please fill all the fields";
				}
			}
		}
	}else
	{
		header('location:update.php');
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
		<legend><font id="error">Updating details</font></legend>
			<form method="POST" action="updatedone.php" enctype="multipart/form-data">
			<table>
			<tr><td>Photo</td><td><img src='profile/<?php echo $data['username']; ?>.jpg' height='150' width='110'></td></tr>
			<tr><td>Id:</td><td><?php echo $data['id']; ?></td></tr>
			<tr><td>Username:</td><td><?php echo $data['username']; ?></td></tr>
			<tr><td>Name:</td><td><?php echo $data['first']." ".$data['last']; ?></td></tr>
			<tr><td>Gender:</td><td><?php echo $data['gender'] ?></td></tr>
			<tr><td>Qualification:</td><td><?php echo $data['qua']; ?></td></tr>
			<tr><td>Address:</td><td><input type="text" maxlength="240" name="add" value="<?php echo $data['adress']; ?>" /></td></tr>
			<tr><td>Address proof</td><td><img src='addresspro/<?php echo $data['username']; ?>.jpg' height='150' width='110'></td>
				</tr>
			<tr><td>Email:</td><td><input value="<?php echo $data['email']; ?>" maxlength="40" type="text" name="email" ></td></tr>
			<tr><td>Phone number:</td><td><input type="text" value="<?php echo $data['phone']; ?>" name="phone"></td></tr>
			<tr><td>Type:</td><td><?php echo $data['type']; ?></td></tr>
			<tr><td>Timings:</td><td><input type="text" maxlength="2" value="<?php echo $data['timinga']; ?>" name="timea"> - <input type="text" maxlength="2" value="<?php echo $data['timingb']; ?>" name="timeb"></td></tr>
			<tr><td>Session:</td><td><select name="sess"><option>Day</option><option>Night</option></select></td></tr>
			<tr><td>Salary:</td><td><input value="<?php echo $data['sal']; ?>" name="sal" type="text"></td></tr>
			<tr><td>Date of birth:</td><td><?php echo $data['date']; ?></td></tr>
			<tr><td>address proof</td><td><input type="file" name="addproof" /></td></tr>
			<tr><td></td><td><input type="submit" value="Update"></td></tr>
			</table>
			</form>
		</fieldset>
		<a href="../emply.php"><input type="button" value="Cancel"></a>
</center>
<?php
}else
{
	header('location:../index.php');
}
require '../../footer.php';
?>
