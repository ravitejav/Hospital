<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['testid']))
{
	require 'next.php';
  if(isset($_SESSION['ppp']) && isset($_POST['sub']) && isset($_POST['det']) && isset($_POST['bill']))
  {
    $sub=$_POST['sub'];$det=$_POST['det'];$bill=$_POST['bill'];
    if(!empty($sub) && !empty($det) && !empty($bill))
    {
      $q=$sub."\n\n".$det;
      $r='report/'.$_SESSION['ppp'].'.txt';
      $handle=fopen($r,'w');
      fwrite($handle,$q);
      fclose($handle);
			$q="SELECT * FROM `patient` WHERE `id`=".$_SESSION['ppp'];
			@$qr=mysqli_query($con,$q);
			@$data=mysqli_fetch_assoc($qr);
			$b=$bill+$data['testbill'];
			$q2="UPDATE `patient` SET `testbill`=".$b." WHERE `id`=".$_SESSION['ppp'];
			@mysqli_query($con,$q2);
      header('location:backend.php');
    }else
    {
        $_SESSION['error']="Please fill all details";
    }
  }
?>
<center>
<?php if(isset($_SESSION['error'])) { ?>
  <fieldset>
    <legend><font id="error">Message</font></legend>
  <?php echo "<font id='error'>".$_SESSION['error']."</font>";unset($_SESSION['error']); ?>
</fieldset>
<?php } ?>
  <fieldset>
    <legend><font id="error">Patient test</font></legend>
    <form action="addrep.php" method="POST">
      <p>Brief:<br /><input type="text" name="sub" maxlength="100"></p>
      <p>Detailed report:<br /><textarea name="det" maxlength="800" rows="8" cols="80"></textarea></p>
			<p>Test bill:<br /><input type="text" name="bill" ></p>
      <p><input type="submit" value="Add test report"></p>
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
