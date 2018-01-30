<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(testloggedin())
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
			$query="SELECT * FROM `user` WHERE `username`='".$username."' AND `password`='".$passa."' AND `type`='test'";
			if(@$query_run=mysqli_query($con,$query))
			{
		    		@$query_rows=mysqli_num_rows($query_run);
		    		if($query_rows==1)
		    		{
		    			@$mydata=mysqli_fetch_assoc($query_run);
		    			$_SESSION['testid']=$mydata['id'];
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
    <fieldset>
      <legend><font id="error">Error</font></legend>
      <?php echo "<font id='error'>".$_SESSION['error']."</font>"; unset($_SESSION['error']);?>
    </fieldset>
    <?php } ?>
  <fieldset>
    <legend><font id="error">LOG IN</font></legend>
    <form action="index.php" method="POST">
    Username<br /><br /><input type="text" required="required" name="username"><br /><br />
    Password<br /><br /><input type="password" name="passa" required="required"><br /><br />
    <input type="submit" value="LOG IN"><br />
    </form>
  </fieldset>
</center>
<?php
}
echo "<div id='footer'>";
require '../footer.php';
echo "</div>";
?>
