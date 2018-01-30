<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['recid']))
{
  require 'next.php';
  if(isset($_POST['breif']) && isset($_POST['descp']))
  {
    $breif=$_POST['breif'];$des=$_POST['descp'];
    if(!empty($breif) && !empty($des))
    {
      $q="UPDATE `discharge` SET `per`=0,`sub`='".$breif."',`descp`='".$des."' WHERE `id`=".$_SESSION['pa'];
      @mysqli_query($con,$q);
      header('location:disch.php');
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
	<legend><font id="error">Discharge report</font></legend>
  <table>
    <tr><td>Brief information</td><input type="text" required="required" name="brief" maxlength="200"><td></td></tr>
    <tr><td>Descriptation</td><td><textarea name="descp" required="required" rows="8" maxlength="800" cols="80"></textarea> </td></tr>
    <tr><td></td><td><input type="submit" value="Submit"></td></tr>
  </table>
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
