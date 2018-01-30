<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['medid']))
{
  require 'nextheader.php';
  if(isset($_POST['name']) && isset($_POST['date']) && isset($_POST['cost']) && isset($_POST['stock']))
  {
      $name=$_POST['name'];$date=$_POST['date'];$cost=$_POST['cost'];$stock=$_POST['stock'];
      if(!empty($name) && !empty($date) && !empty($cost) && !empty($stock))
      {
          $query="INSERT INTO `med` VALUES ('','".$name."','".$date."',".$cost.",".$stock.")";
          @$queryrun=mysqli_query($con,$query);
          header('location:newmed.php');
      }else
      {
          $_SESSION['error']="Enter the all details...";
      }
  }
?>
<center>
    <?php if(isset($_SESSION['error'])){?>
  <fieldset>
    <legend><font id="error">Error</font></legend>
<?php  echo "<font id='error'>".$_SESSION['error']."</font>";unset($_SESSION['error']);?>
  </fieldset>
<?php  } ?>
<fieldset>
  <legend><font id="error">Addin New Tablet</font></legend>
  <form method="POST" action="newmed.php">
  <table>
    <tr><td>Name:</td><td><input type='text' required='required' name='name'></td></tr>
    <tr><td>Date of expire</td><td><input type='date' required='required' name='date'></td></tr>
    <tr><td>Cost(10 tablets)</td><td><input type='text' required='required' name='cost'></td></tr>
    <tr><td>Stock</td><td><input type='text' required='required' name='stock'></td></tr>
    <tr><td></td><td><input type='submit' value='Add medicine'></td></tr>
  </table>
</form>
</fieldset>
<br /><br /><br /><br /><a href="backend.php"><input type='button' value='Back'></a>
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
