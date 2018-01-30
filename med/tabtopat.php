<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['medid']))
{
  $i=1;
  require 'nextheader.php';
  if(isset($_POST['patid']))
  {
    $pat=$_POST['patid'];
    if(!empty($pat))
    {
        $query="SELECT * FROM `patient` WHERE `id`=".$pat;
        if(@$query_run=mysqli_query($con,$query))
        {
          $i=0;
          @$data=mysqli_fetch_assoc($query_run);
          echo "<fieldset><legend><font id='error'>Billing for medicines</font></legend>";
          echo "<form method='POST' action='billup.php'>";
          echo "<table><tr><td>Tablets cost:</td><td><input type='text' name='tab'></td></tr>";
          echo "<tr><td>Surp cost:</td><td><input type='text' name='sup'></td></tr>";
          echo "<tr><td>Power Cost:</td><td><input type='text' name='pow'></td></tr>";
          echo "<tr><td>Patient ID:</td><td><input type='text' name='patid' value='".$pat."' readonly></td></tr>";
          echo "<tr><td><input type='submit' value='Billup'></td></tr>";
          echo "</table></form></fieldset>";
        }else
        {
            $_SESSION['error']="Please try again<br />";
        }
    }else
    {
        $_SESSION['error']="Please fill all the fields required";
    }
  }
  if($i==1)
  {
  ?>
<center>
  <?php if(isset($_SESSION['error'])){ ?>
  <fieldset>
    <legend><font id="error">Warning</font></legend>
    <?php "<font id='error'>".$_SESSION['error']."</font>";unset($_SESSION['error']);?>
  </fieldset>
  <?php } ?>
<fieldset>
  <legend><font id="error">Patient</font></legend>
  <form method="POST" action="tabtopat.php">
  Patient ID:<input type="text" name="patid" required="required"><br /><br />
  <input type="submit" value="Fetch tablets">
  </form>
</fieldset>
  <br /><br /><br /><br /><a href="backend.php"><input type='button' value='Back'></a>
</center>
<?php
  }
}else
{
    header('location:index.php');
}
echo "<div id='footer'>";
require '../footer.php';
echo "</div>";
?>
