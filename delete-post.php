<?php
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.html");
  exit;
}
$pid=$_POST['pid'];
$sql="SELECT username,image FROM posts WHERE pid='".$pid."'";
include "connect.php";
$temp=mysqli_fetch_row($conn->query($sql));
if($temp[0]===$_SESSION['username'])
{
 $sql1="DELETE FROM `likes` WHERE pid='".$pid."'";
 $sql2="DELETE FROM `comments` WHERE pid='".$pid."'";
 $sql3="DELETE FROM `posts` WHERE pid='".$pid."'";
 $conn->query($sql1);
 $conn->query($sql2);
 $conn->query($sql3);
 if($temp[1]!==NULL)
 unlink($temp[1]);
}
else
echo "You are a smartass arent you ? ";
?>
