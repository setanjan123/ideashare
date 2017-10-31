<?php
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.html");
  exit;
}
$cid=$_POST['cid'];
$sql="SELECT username FROM comments WHERE id='".$cid."'";
include "connect.php";
$temp=mysqli_fetch_row($conn->query($sql));
if($temp[0]===$_SESSION['username'])
{
 $sql="DELETE FROM `comments` WHERE id='".$cid."'";
 $conn->query($sql);
}
else
echo "You are a smartass arent you ? ";
?>