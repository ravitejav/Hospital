<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['medid']))
{
  require 'nextheader.php';
  if(isset($_POST['name'])&&isset($_POST['idd'])&&isset($_POST['stock']))
  {
    $name=$_POST['name'];$idd=$_POST['idd'];$stock=$_POST['stock'];
    if(!empty($name) && !empty($idd) && (!empty($stock) || $stock==0))
    {
      if($stock>0 || $stock==0)
      {
        $q1="UPDATE `med` SET `name`='".$name."',`stock`=".$stock." WHERE `id`=".$idd;
        @$qr1=mysqli_query($con,$q1);
        header('location:stock.php');
      }else
      {
          header('location:stock.php');
      }
    }
  }
}else
{
    header('location:index.php');
}
echo "<div id='footer'>";
require '../footer.php';
echo "</div>";
?>
