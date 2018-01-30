<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if($_SESSION['medid'])
{
  require 'nextheader.php';
  $j=1;
  if(isset($_GET['id']))
  {
      $id=$_GET['id'];
      if(!empty($id))
      {
        $q="SELECT * FROM `med` WHERE `id`=".$id;
        @$qr=mysqli_query($con,$q);
        @$qd=mysqli_fetch_assoc($qr);
        $j=0;
        echo "<fieldset><legend><font id='error'>Billing for medicines</font></legend>";
        echo "<center><form method='POST' action='stockdone.php'><table>";
        echo "<tr><td>Name</td><td><input type='text' name='name' value='".$qd['name']."' required='required'></td></tr>";
        echo "<tr><td>ID</td><td><input type='text' name='idd' value='".$qd['id']."' required='required' readonly></td></tr>";
        echo "<tr><td>Stock</td><td><input type='text' name='stock' value='".$qd['stock']."' required='required'></td></tr>";
        echo "<tr><td></td><td><input type='submit' value='Update'></td></tr>";
        echo "</table></form></center></fieldset>";
      }else
      {
          $_SESSION['error']="Please fill all the details.....";
      }
  }
if($j==1)
{
?>
<center>
  <?php if(isset($_SESSION['error'])){ ?>
<fieldset>
  <legend><font id="error">Warning</font></legend>
  <? echo "<font id='error'>".$_SESSION['error']."</font>";unset($_SESSION['error']);?>
</fieldset>
<?php } ?>
<fieldset>
  <legend><font id="error">Updating stock</font></legend>
<form method="GET" action="stock.php">
Medicine ID:<input type="text" name="id"><br /><br />
  <input type="submit" value="Fetch details">
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
