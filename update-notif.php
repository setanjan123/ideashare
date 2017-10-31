<?php
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}
$username=$_SESSION['username'];
$query1="SELECT username,pid FROM likes WHERE pid IN(SELECT pid FROM posts WHERE username ='".$username."') AND status=0 AND username!='".$username."' ORDER BY timestamp DESC";
$query2="UPDATE likes set status=1 WHERE pid IN(SELECT pid FROM posts WHERE username ='".$username."') AND status=0";
$query3="SELECT username,pid FROM comments WHERE pid IN(SELECT pid FROM posts WHERE username ='".$username."') AND status=0 AND username!='".$username."' ORDER BY timestamp DESC";
$query4="UPDATE comments set status=1 WHERE pid IN(SELECT pid FROM posts WHERE username ='".$username."') AND status=0";
$query5="SELECT follower FROM followers WHERE username='".$username."' AND status=0 ORDER BY timestamp DESC";
$query6="UPDATE followers set status=1 WHERE username='".$username."' AND status=0";
$query7="SELECT pid,username FROM visited WHERE subscriber='".$username."' AND status=0 AND username!='".$username."' ORDER BY timestamp DESC";
$query8="UPDATE visited SET status=1 WHERE subscriber='".$username."' AND status=0"; 
include 'connect.php';
$likes=$conn->query($query1);
$conn->query($query2);
$comments=$conn->query($query3);
$conn->query($query4);
$follows=$conn->query($query5);
$conn->query($query6);
$subscribed=$conn->query($query7);
$conn->query($query8);
$conn->close();
while($row=mysqli_fetch_row($likes))
{echo "<div class=".$row[1].">";
echo "<p><a><b>".$row[0]." liked your post</b></a></p><hr></div>";
}
while($row=mysqli_fetch_row($comments))
{echo "<div class=".$row[1].">";
echo "<p><a><b>".$row[0]." commented on your your post</b></a></p><hr></div>";
}
while($row=mysqli_fetch_row($follows))
echo "<a href='profile.php?user=".$row[0]."'><b>".$row[0]." followed you</b></a><hr>";

while($row=mysqli_fetch_row($subscribed))
{echo "<div class=".$row[0].">";
echo "<p><a><b>".$row[1]."</b> commented on a post you are following</a></p><hr></div>";
}
?>
