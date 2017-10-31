<?php

session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.html");
  exit;
}


if(!empty($_POST['comment']))
{
include 'connect.php';
$username=$_SESSION['username'];
$postid=$_POST['pid'];
$comment=$_POST['comment'];
$sql = $conn->prepare("INSERT INTO `comments` (`pid`, `username`,`comment`) VALUES (?, ?, ?)");
$sql->bind_param("iss", $postid, $username,$comment);
if ($sql->execute() === TRUE) 
{echo "Commented successfully";
$sql="SELECT username FROM subscribed WHERE pid='".$postid."' AND username!='".$username."'";
$result=$conn->query($sql);
while($row=mysqli_fetch_row($result))
{
  $sql="INSERT INTO visited (`pid`,`subscriber`,`username`) VALUES('".$postid."','".$row[0]."','".$username."')";
  $conn->query($sql);
  
}
}
else
{
echo "Error.Could not comment";
}
}
else
echo "Comment cannot be empty";

?>