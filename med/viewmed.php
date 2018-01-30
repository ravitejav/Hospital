<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if($_SESSION['medid'])
{
  $i=1;
  require 'nextheader.php';
  if(isset($_POST['name']) && isset($_POST['idd']))
  {
    $name=$_POST['name'];$idd=$_POST['idd'];
      if(!empty($name) || !empty($idd))
      {
        if(!empty($idd))
        {
            if(!empty($idd) && !empty($name))
            {
              $i=0;
              $q1="SELECT * FROM `med` WHERE `id`=".$idd." AND `name`='".$name."'";
              @$qr1=mysqli_query($con,$q1);
              @$qd1=mysqli_fetch_assoc($qr1);
              @$num1=mysqli_num_rows($qr1);
              $num11=$num1;
              if($num1>=1)
              {
                echo "<table border='2' bgcolor='#FFCOCB' width=60%><tr><td>ID</td><td>NAME</td><td>EXPIRY DATE</td><td>COST(10 TABLETS)</td><td>STOCK</td></tr>";
                while($num11--)
                {
                  echo "<tr><td>".$qd1['id']."</td><td>".$qd1['name']."</td><td>".$qd1['exp']."</td><td>".$qd1['cost']."</td><td>".$qd1['stock']."</td></tr>";
                }
                echo "</table>";
              }
            }else if(!empty($idd))
            {
              $i=0;
              $q1="SELECT * FROM `med` WHERE `id`=".$idd;
              @$qr1=mysqli_query($con,$q1);
              @$qd1=mysqli_fetch_assoc($qr1);
              @$num1=mysqli_num_rows($qr1);
              $num11=$num1;
              if($num1==1)
              {
                echo "<table border='2' bgcolor='#FFCOCB' width=60%><tr><td>ID</td><td>NAME</td><td>EXPIRY DATE</td><td>COST(10 TABLETS)</td><td>STOCK</td></tr>";
                while($num11--)
                {
                  echo "<tr><td>".$qd1['id']."</td><td>".$qd1['name']."</td><td>".$qd1['exp']."</td><td>".$qd1['cost']."</td><td>".$qd1['stock']."</td></tr>";
                }
                echo "</table>";
              }else {
                $_SESSION['error']="Not found please enter the correct id<br />";$i=1;
              }
            }else
            {
              $_SESSION['error']="No records found....";$i=1;
            }
        }else if(!empty($idd) && !empty($name))
        {
          $q1="SELECT * FROM `med` WHERE `id`=".$idd." AND `name`='".$name."'";
          @$qr1=mysqli_query($con,$q1);
          @$qd1=mysqli_fetch_assoc($qr1);
          @$num1=mysqli_num_rows($qr1);
          $num11=$num1;
          if($num1>=1)
          {
            echo "<table border='2' bgcolor='#FFCOCB'><tr><td>ID</td><td>NAME</td><td>EXPIRY DATE</td><td>COST(10 TABLETS)</td><td>STOCK</td></tr>";
            while($num11--)
            {
              echo "<tr><td>".$qd1['id']."</td><td>".$qd1['name']."</td><td>".$qd1['exp']."</td><td>".$qd1['cost']."</td><td>".$qd1['stock']."</td></tr>";
            }
            echo "</table>";
          }
        }else
        {
            $_SESSION['error']="No records found....";$i=1;
        }
      }else
      {
          $_SESSION['error']="Please enter all the fields";$i=1;
      }
  }
if($i==1)
{
?>
<center>
  <?php if (isset($_SESSION['error'])) { ?>
<fieldset>
  <legend><font id="error">Warning</font></legend>
  <?php echo "<font color='red' >".$_SESSION['error']."</font>"; unset($_SESSION['error']); ?>
</fieldset>
  <?php } ?>
  <fieldset>
    <legend><font id="error">Medicines</font></legend>
<form method="POST" action="viewmed.php">
  Name:<input type="text" name="name" ><br /><br />
  ID:  <input type="text" name="idd" ><br /><br />
  <input type="submit" value="Submit">
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
