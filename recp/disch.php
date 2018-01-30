<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['recid']))
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
        $q1="SELECT * FROM `discharge` WHERE `id`=".$patid;
        @$qr1=mysqli_query($con,$q1);
        @$num1=mysqli_num_rows($qr1);
        $_SESSION['pa']=$patid;
        if($num1==1)
        {
          $da=mysqli_fetch_assoc($qr1);
          if($da['per'])
          {
            header('location:pergran.php');
          }else
          {
              $_SESSION['error']="Permission is not granted";
          }
        }else
        {
            $_SESSION['error']="Request for patient to respective doctor,Do you want to request<a href='req.php'><input type='button' value='request'></a>";
        }
      }else
      {
            $_SESSION['error']="No patient found";
      }
    }else
    {
        $_SESSION['error']="Fill the id ";
    }
  }
?>
<center>
  <?php if(isset($_SESSION['error'])){ ?>
  <fieldset>
    <legend><font id="error">Message</font></legend>
    <?php echo "<font id='error'>".$_SESSION['error']."</font>"; unset($_SESSION['error']);?>
  </fieldset>
  <?php } ?>
  <fieldset>
    <legend><font id="error">Discharging report</font></legend>
    <form  action="disch.php" method="POST">
      <p>Patient ID <input type="text" name="patid"></p>
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
