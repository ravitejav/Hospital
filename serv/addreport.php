<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['serid']))
{
	require 'next.php';
  if(isset($_SESSION['ppp']) && isset($_POST['sub']) && isset($_POST['det']))
  {
    $sub=$_POST['sub'];$det=$_POST['det'];
    if(!empty($sub) && !empty($det))
    {
      $q="SELECT * FROM `patient` WHERE `id`=".$_SESSION['ppp'];
      @$qr=mysqli_query($con,$q);
      @$data=mysqli_fetch_assoc($qr);
      $q1="SELECT * FROM `serv` WHERE `id`=".$data['serv'];
      @$qr1=mysqli_query($con,$q1);
      @$qdata=mysqli_fetch_assoc($qr1);
      $q3=$sub."\n\n".$det;
      $r='report/'.$_SESSION['ppp'].'.txt';
      $handle=fopen($r,'w');
      fwrite($handle,$q3);
      fclose($handle);
      $f=$data['serbill']+$qdata['cost'];
      $q2="UPDATE `patient` SET `serbill`=".$f." WHERE `id`=".$_SESSION['ppp'];
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
    <form action="addreport.php" method="POST">
      <p>Brief:<br /><input type="text" name="sub" maxlength="100"></p>
      <p>Detailed report:<br /><textarea name="det" maxlength="800" rows="8" cols="80"></textarea></p>
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
