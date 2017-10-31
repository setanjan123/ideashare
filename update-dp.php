<?php
session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}
$username=$_SESSION['username'];
if(!empty($_FILES['image']['name']))
{
include 'connect.php';
$username=$_SESSION['username'];
$check = getimagesize($_FILES["image"]["tmp_name"]);
 if($check == false) {
        echo "<h1>File has to be a image</h1>";
		header( "refresh:2; url='profile.php?user=".$username.""); 
        exit;   
    }
$sql="SELECT imgpath FROM users WHERE username='".$username."'";
$result=mysqli_fetch_row($conn->query($sql));
if($result[0]!="images/default.jpg")
unlink($result[0]);
$myname = strtolower($_FILES['image']['tmp_name']);
$save_path="images/";
$target=$save_path.basename($_FILES['image']['tmp_name']);
move_uploaded_file($_FILES['image']['tmp_name'],$target);
$sql="UPDATE users SET imgpath='".$target."' WHERE username='".$username."'";
if($conn->query($sql)==TRUE)
echo "<h1>Updated profile picture successfully</h1>";
else
echo $conn->error();
}
else
echo "<h1> Please give a picture</h1>";
header( "refresh:2; url='home.php'"); 
?>