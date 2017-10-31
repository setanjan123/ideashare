<?php
session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.html");
  exit;
}
include 'connect.php';
$oldpass=$_POST['oldpass'];
$newpass=$_POST['newpass'];
$username=$_SESSION['username'];
if(empty($oldpass)||empty($newpass))
echo "<h1>Incomplete Information</h1>";
else
{
$sql="SELECT password FROM users WHERE username='".$username."'";
$result=mysqli_fetch_row($conn->query($sql));
if($result[0]!=$oldpass)
echo "<h1>Wrong Password. Enter your old password correctly.</h1>";
else
{
$sql="UPDATE users SET password='".$newpass."' WHERE username='".$username."'";
if($conn->query($sql)==TRUE)
echo "<h1>Changed Password Successfully</h1>";
else
echo $conn->error();
}
}
header( "refresh:2; url='profile.php?user=".$username.""); 
?>
