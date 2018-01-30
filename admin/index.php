<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../bootstrap/style.css">';
if(adminloggedin())
{
     header('location:backend.php');
}else
{
	if(isset($_POST['username']) && isset($_POST['passa']))
	{
		$username=$_POST['username'];
		$password=$_POST['passa'];
		$passa=md5($password);
		if(!empty($username) && !empty($password) )
		{
			$query="SELECT * FROM `admin` WHERE `username`='".$username."' AND `password`='".$passa."'";
			if(@$query_run=mysqli_query($con,$query))
			{
		    		@$query_rows=mysqli_num_rows($query_run);
		    		if($query_rows==1)
		    		{
		    			@$mydata=mysqli_fetch_assoc($query_run);
		    			$_SESSION['userid']=$mydata['id'];
		    			$_SESSION['username']=$mydata['username'];
		    			header('location:backend.php');
		    		}else
		    		{
		    			$_SESSION['error']="Password and Username not matched";
		    		}
			}else
			{
          $_SESSION['error']="Please try again";
			}
		}else
		{
			$_SESSION['error']="Please enter the correct details";
		}
	}
?>
<center>
	<?php if(isset($_SESSION['error'])){ ?>
	   <script type="text/javascript">
	    alert("<?php echo $_SESSION['error'];?>");<? unset($_SESSION['error']); ?>
	     </script>
	<?php } ?>
<div class="redi">
  <form action="index.php" method="POST">
    <input type="text" maxlength="10" placeholder="Username" required="required" value="admin" name="username"><br /><br />
    <input type="password" placeholder="Password" name="passa" required="required"><br /><br />
    <input type="submit" value="LOG IN"><br />
  </form>
</div>
</center>
<?php
}
echo "<div id='footer'>";
require '../footer.php';
echo "</div>";
?>
