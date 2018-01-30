<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['docid']))
{
		require 'nextheader.php';
	$query="SELECT * FROM `serv` WHERE 1";
	@$query_run=mysqli_query($con,$query);
	$i=0;
	@$num=mysqli_num_rows($query_run);
	if($num)
	{
		echo "<table border='1' bgcolor='pink'>";
		echo "<tr><td>Id</td><td>Service</td><td>Cost</td></tr>";
		while($i!=$num)
		{
			@$data=mysqli_fetch_assoc($query_run);
			echo "<tr><td>".$data['id']."</td><td>".$data['ser']."</td><td>".$data['cost']."</td></tr>";
			$i++;
		}
		echo "</table>";
	}else
	{
			echo "<center><fieldset><legend><font id='error'>Message</font></legend><font id='error'>No services....</font></fieldset></center>";
	}
	echo "<center><br /><a href='backend.php'><input type='button' value='Back'></a></center>";
}else
{
	header('location:index.php');
}
echo "<div id='footer'>";
require '../footer.php';
echo "</div>";
?>
