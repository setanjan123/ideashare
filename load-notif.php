<?php
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}
$username=$_SESSION['username'];
$query1="SELECT username,pid FROM likes WHERE pid IN(SELECT pid FROM posts WHERE username ='".$username."') AND status=1 AND username!='".$username."' ORDER BY timestamp DESC";
$query3="SELECT username,pid FROM comments WHERE pid IN(SELECT pid FROM posts WHERE username ='".$username."') AND status=1 AND username!='".$username."' ORDER BY timestamp DESC";
$query5="SELECT follower FROM followers WHERE username='".$username."' AND status=1 ORDER BY timestamp DESC";
$query7="SELECT pid,username FROM visited WHERE subscriber='".$username."' AND status=1 AND username!='".$username."' ORDER BY timestamp DESC";
include 'connect.php';
$likes=$conn->query($query1);
$comments=$conn->query($query3);
$follows=$conn->query($query5);
$subscribed=$conn->query($query7);
$conn->close();
while($row=mysqli_fetch_row($likes))
{echo "<div class=".$row[1].">";
echo "<p><a><b>".$row[0]."</b> liked your post</a></p><hr></div>";
}
while($row=mysqli_fetch_row($comments))
{echo "<div class=".$row[1].">";
echo "<p><a><b>".$row[0]."</b> commented on your your post</a></p><hr></div>";
}
while($row=mysqli_fetch_row($follows))
echo "<a href='profile.php?user=".$row[0]."'><b>".$row[0]."</b> followed you</a><hr>";

while($row=mysqli_fetch_row($subscribed))
{echo "<div class=".$row[0].">";
echo "<p><a><b>".$row[1]."</b> commented on a post you are following</a></p><hr></div>";
}
?>