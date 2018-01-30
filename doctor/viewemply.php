<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['docid']))
{
	$j=1;
	require 'nextheader.php';
	if(isset($_GET['type']) && isset($_GET['iid']))
	{
		$type=$_GET['type'];$iid=$_GET['iid'];
		if(!empty($type) || !empty($iid))
		{
			if(!empty($iid))
			{
			  $query="SELECT * FROM `".$type."` WHERE `id`=".$iid;
			  @$query_run=mysqli_query($con,$query);
				@$num=mysqli_num_rows($query_run);
				if($num!=0)
				{
				    $i=0;$j=0;
				    echo "<table border='3'>";
				    echo "<tr><td>Id</td><td>Name</td><td>Address</td><td>Qualification</td><td>Phone</td><td>Specilization</td><td>Timing</td><td>Session</td><td>Salary</td><td>Image</td></tr>";
				    while($i<$num)
				    {
				    	@$data=mysqli_fetch_assoc($query_run);
				    	echo "<tr><td>".$data['id']."</td><td>".$data['first']." ".$data['last']."</td><td>".$data['adress']."</td><td>".$data['qua']."</td><td>".$data['phone']."</td><td>".$data['type']."</td><td>".$data['timinga']." - ".$data['timingb']."</td><td>".$data['session']."</td><td>".$data['sal']."</td><td><img src='../admin/emply/profile/".$data['username'].".jpg' height='150' width='100'></td></tr>";
				    	$i++;
				    }
				    echo "</table>";
				}else
				{
					$_SESSION['error']="No records found!!!!!..";
				}
			}else
			{
				$query2="SELECT * FROM `".$type."` WHERE 1";
			  @$query_run2=mysqli_query($con,$query2);
				@$num=mysqli_num_rows($query_run2);
				if($num!=0)
				{
				    $i=0;$j=0;
				    echo "<table border='3'>";
				    echo "<tr><td>Id</td><td>Name</td><td>Address</td><td>Qualification</td><td>Phone</td><td>Specilization</td><td>Timing</td><td>Session</td><td>Salary</td><td>Image</td></tr>";
				    while($i<$num)
				    {
				    	@$data=mysqli_fetch_assoc($query_run2);
				    	echo "<tr><td>".$data['id']."</td><td>".$data['first']." ".$data['last']."</td><td>".$data['adress']."</td><td>".$data['qua']."</td><td>".$data['phone']."</td><td>".$data['type']."</td><td>".$data['timinga']." - ".$data['timingb']."</td><td>".$data['session']."</td><td>".$data['sal']."</td><td><img src='../admin/emply/profile/".$data['username'].".jpg' height='150' width='100'></td></tr>";
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
if($j==1)
{
?>
<center>
    <?php  if(isset($_SESSION['error'])) {?>
  <fieldset>
    <legend><font id="error">Message</font></legend>
  <?php echo "<font id='error' >".$_SESSION['error']."</font>";unset($_SESSION['error']);  ?>
  </fieldset>
  <?php } ?>
<fieldset>
	<legend><font id="error">Employee list</font></legend>
<form action="viewemply.php" method="GET">
Specilization:<br /><select name="type"><option>medicine</option><option>recpeptionist</option><option>test</option></select><br />
ID(Optional):<br /><input type="text" name="iid"><br />
<input type="submit" value="Search">
</form>
</fieldset>
<br /><a href="backend.php"><input type="button" value="Back"></a>
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
