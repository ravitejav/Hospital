<?php
include '../connect.inc.php';
include '../fun.inc.php';
if(isset($_SESSION['docid']))
{
  $qq="UPDATE `discharge` SET `per`=1,`req`=0 WHERE `id`=".$_SESSION['pa'];
  @mysqli_query($con,$qq);
  header('location:per.php');
}else
{
    header('location:index.php');
}
?>
