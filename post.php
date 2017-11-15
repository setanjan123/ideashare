<?php

session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}


if(!empty($_POST['post']))
{
include 'connect.php';
$username=$_SESSION['username'];
$text= $_POST['post'];
if(!empty($_FILES['image']['name']))
{
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
        echo "File has to be a image";
        exit;   
    }
   $myname = strtolower($_FILES['image']['tmp_name']);
   $save_path="posts/";
   $target=$save_path.basename($_FILES['image']['tmp_name']);
   move_uploaded_file($_FILES['image']['tmp_name'],$target);
}
$sql = $conn->prepare("INSERT INTO `posts` (`username`, `post`,`image`) VALUES (?, ?, ?)");
$sql->bind_param("sss", $username, $text, $target);
if ($sql->execute() === FALSE) 
echo "Error";
}
else
echo "Post cannot be empty";
?>