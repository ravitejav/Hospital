<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['recid']))
{
	require 'next.php';
	if(isset($_GET['type']) && isset($_GET['iid']))
	{
		$type=$_GET['type'];$iid=$_GET['iid'];
		if(!empty($type) || !empty($iid) || $type==0)
		{
			if(!empty($iid))
			{
			  $query="SELECT * FROM `patient` WHERE `emer`=".$type." AND `id`=".$iid;
			  @$query_run=mysqli_query($con,$query);
				@$num=mysqli_num_rows($query_run);
				if($num!=0)
				{
				    $i=0;
				    echo "<table border='3'>";
				    echo "<tr><td>Id</td><td>Name</td><td>Date Of Birth</td><td>Gender</td><td>Phone</td><td>Address</td><td>Problem</td><td>Problem Description</td></tr>";
				    while($i<$num)
				    {
				    	@$data=mysqli_fetch_assoc($query_run);
				    	echo "<tr><td>".$data['id']."</td><td>".$data['name']."</td><td>".$data['date']."</td><td>".$data['gender']."</td><td>".$data['phone']."</td><td>".$data['address']."</td><td>".$data['prob']."</td><td>".$data['probdes']."</td></tr>";
				    	$i++;
				    }
				    echo "</table>";
				}else
				{
					$_SESSION['error']="No records found!!!!!..";
				}
			}else
			{
				$query2="SELECT * FROM `patient` WHERE `emer`=".$type;
			  @$query_run2=mysqli_query($con,$query2);
				@$num=mysqli_num_rows($query_run2);
				if($num!=0)
				{
				    $i=0;
				    echo "<table border='3'>";
				    echo "<tr><td>Id</td><td>Name</td><td>Gender</td><td>Date Of Birth</td><td>Address</td><td>Phone NO</td><td>Problem</td><td>Problem Description</td></tr>";
				    while($i<$num)
				    {
				    	@$data=mysqli_fetch_assoc($query_run2);
				    	echo "<tr><td>".$data['id']."</td><td>".$data['name']."</td><td>".$data['gender']."</td><td>".$data['date']."</td><td>".$data['address']."</td><td>".$data['phone']."</td><td>".$data['prob']."</td><td>".$data['probdes']."</td></tr>";
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
    <?php if(isset($_SESSION['error'])){?>
  <fieldset>
    <legend><font id="error">Message</font></legend>
<?php  echo "<font id='error'>".$_SESSION['error']."</font>";unset($_SESSION['error']);?>
  </fieldset>
<?php  } ?>
<fieldset>
	<legend><font id="error">Change password</font></legend>
<form action="view.php" method="GET">
Patient type:<br /><select name="type"><option value="1">Emergency</option><option value="0">Non-Emergency</option></select><br />
Patient ID:<br /><input type="text" name="iid"><br />
<input type="submit" value="Search">
</form>
</fieldset>
<br /><a href="backend.php"><input type="button" value="Back"></a>
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
