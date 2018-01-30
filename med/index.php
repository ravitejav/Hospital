<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../bootstrap/style.css">';
echo '<script type="text/javascript" src="js/start.js"></script>';
if(medloggedin())
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
			$query="SELECT * FROM `user` WHERE `username`='".$username."' AND `password`='".$passa."' AND `type`='medicine'";
			if(@$query_run=mysqli_query($con,$query))
			{
		    		@$query_rows=mysqli_num_rows($query_run);
		    		if($query_rows==1)
		    		{
		    			@$mydata=mysqli_fetch_assoc($query_run);
		    			$_SESSION['medid']=$mydata['id'];
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
    <?php  if(isset($_SESSION['error'])) {?>
  <script type="text/javascript">
    alert("<?php echo $_SESSION['error'];?>");<?unset($_SESSION['error']);  ?>
  </script>
  <?php } ?>
  <div class="redi">
    <form action="index.php" method="POST">
      <input type="text" required="required" placeholder="Username" name="username"><br /><br />
      <input type="password" name="passa" placeholder="Password" required="required"><br /><br />
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
