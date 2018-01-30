<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if($_SESSION['docid'])
{
  require'nextheader.php';
  if(isset($_POST['patid']))
  {
    $patid=$_POST['patid'];
    if(!empty($patid))
    {
      $q="SELECT * FROM `discharge` WHERE `id`=".$patid;
      @$qr=mysqli_query($con,$q);
      @$num=mysqli_num_rows($qr);
      @$data=mysqli_fetch_assoc($qr);
      if($num==1)
      {
        if($data['req']==1)
        {
        ?>
        <center>
          <fieldset>
            <legend><font id="error">Permissions</font></legend>
            <?php $_SESSION['pa']=$patid;echo "Permission for the patient ".$patid."<a href='grant.php'><input type='button' value='Grant permission'></a> "; ?>
          </fieldset>
        </center>
        <?php
      }else
      {
        $_SESSION['error']="No request are available";
      }
      }else
      {
        $_SESSION['error']="Patient not exist for discharge";
      }
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
    <legend><font id="error">Patient service</font></legend>
    <form action="per.php" method="post">
      <p>Patient id:<input type="text" name="patid"></p>
      <p><input type="submit" value="Search"></p>
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
