<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['testid']))
{
	require 'next.php';
  if(isset($_POST['patid']))
  {
    $patid=$_POST['patid'];
    if(!empty($patid))
    {
      $q="SELECT * FROM `patient` WHERE `id`=".$patid;
      @$qr=mysqli_query($con,$q);
      @$num=mysqli_num_rows($qr);
      if($num==1)
      {
        @$data=mysqli_fetch_assoc($qr);
        echo "<center><fieldset><legend><font id='error'>Test given</font></legend>".$data['tests']."</fieldset></center>";
        echo "<center><br /><a href='addrep.php'><input type='button' value='Add report'></a></center>";
        $_SESSION['ppp']=$patid;
      }else
      {
        $_SESSION['error']="No patient exists";
      }
    }else
    {
        $_SESSION['error']="Please fill all the details....";
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
    <form action="test.php" method="POST">
      <p>Patient id: <input type="text" name="patid"></p>
      <p><input type="submit" value="Add test"></p>
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
