<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if($_SESSION['docid'])
{
  require'nextheader.php';
  if(isset($_POST['patid']) && isset($_POST['test']))
  {
    $patid=$_POST['patid'];$test=$_POST['test'];
    if(!empty($patid) && !empty($test))
    {
      $q="UPDATE `patient` SET `tests`='".$test."' WHERE `id`=".$patid;
      @$qr=mysqli_query($con,$q);
      $_SESSION['error']="The test is added succesfully....";
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
    <form action="addtest.php" method="POST">
      <p>Patient id: <input type="text" name="patid"></p>
      <p>Test name:<input type="text" name="test"></p>
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
