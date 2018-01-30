<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['recid']))
{
	require 'next.php';
  if(isset($_POST['patid']) && isset($_POST['bill']))
  {
    $patid=$_POST['patid'];$bill=$_POST['bill'];
    if(!empty($patid) && !empty($bill))
    {
      $q3="SELECT * FROM `patient` WHERE `id`=".$patid;
      @$qr3=mysqli_query($con,$q3);
      @$pat1=mysqli_num_rows($qr3);
      @$pat=mysqli_fetch_assoc($qr3);
      if($pat1==1)
      {
				$bill=$bill+$pat['hossbill'];
        $q="UPDATE `patient` SET `hossbill`=".$bill." WHERE `id`=".$patid;
        @mysqli_query($con,$q);
        $_SESSION['error']="Bill updated successfully";
      }else
      {
          $_SESSION['error']="No paient found";
      }
    }else
    {
        $_SESSION['error']="Please fill all details..";
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
	<legend><font id="error">Update patient hospatials bill</font></legend>
  <form action="update.php" method="POST">
    <p>Patient id:<input type="text" required="required" name="patid"></p>
    <p>Hospatil bill:<input type="text" required="required" name="bill"></p>
    <p><input type="submit" value="Add bill"></p>
  </form>
</fieldset>
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
