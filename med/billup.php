<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if($_SESSION['medid'])
{
  if(isset($_POST['tab'])&&isset($_POST['sup'])&&isset($_POST['pow'])&&isset($_POST['patid']))
  {
    if(!empty($_POST['tab'])&&!empty($_POST['sup'])&&!empty($_POST['pow'])&&!empty($_POST['patid']))
    {
      $tab=$_POST['tab'];$sup=$_POST['sup'];$pow=$_POST['pow'];$patid=$_POST['patid'];
      $q="SELECT * FROM `patient` WHERE `id`=".$patid;
      @$qr=mysqli_query($con,$q);
      @$bill=mysqli_fetch_assoc($qr);
      $tot=$tab+$sup+$pow+$bill['medbill'];
      $query="UPDATE `patient` SET `medbill`=".$tot." WHERE `id`=".$patid;
      @$query_run=mysqli_query($con,$query);
      header('location:index.php');
    }
  }require 'nextheader.php';
}else
{
header('location:index.php');
}
echo "<div id='footer'>";
require '../footer.php';
echo "</div>";
?>
