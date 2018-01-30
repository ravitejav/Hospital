<?php
include '../connect.inc.php';
include '../fun.inc.php';
require '../header.php';
echo '<link rel="stylesheet" href="../style.css">';
if(isset($_SESSION['userid']))
{
  require 'next.php';
    $query="SELECT * FROM `feedback` WHERE 1";
    @$queryrun=mysqli_query($con,$query);
    @$num=mysqli_num_rows($queryrun);
    echo "<center>";
    if($num!=0)
    {
      echo "<fieldset><table border='2' bgcolor='yellow'>";
      echo "<tr><td>NAME</td><td>PHONE NUMBER</td><td>EMAIL</td><td>SUBJECT</td><td>DESCRIPITION</td></tr>";
      for($i=0; $i < $num ; $i++)
      {
          @$mydata=mysqli_fetch_assoc($queryrun);
          echo "<tr><td>".$mydata['name']."</td><td>".$mydata['phone']."</td><td>".$mydata['email']."</td><td>".$mydata['subject']."</td><td>".$mydata['sug']."</td></tr>";
      }
      echo "</table></fieldset>";
    }else
    {
        echo "<fieldset><legend><font id='error'>Message</font></legend><font id='error'>No feedbacks found</font></fieldset>";
    }
    echo "<br /><a href='backend.php'><input type='button' value='Back'></a></center>";
}else
{
	header('location:index.php');
}
echo "<div id='footer'>";
require '../footer.php';
echo "</div>";
?>
