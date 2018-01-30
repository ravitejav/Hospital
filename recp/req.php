<?php
include '../connect.inc.php';
include '../fun.inc.php';
if(isset($_SESSION['recid']))
{
  $qq="INSERT INTO `discharge`(`id`,`req`) VALUES(".$_SESSION['pa'].",1)";
  @mysqli_query($con,$qq);
  header('location:disch.php');
}else
{
    header('location:index.php');
}

?>
