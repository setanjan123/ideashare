<?php

session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}

include 'connect.php';
$pid=$_POST['pid'];
$sql="SELECT pid,username,post,image FROM posts WHERE pid='".$pid."'";
$response=$conn->query($sql);
while($row=mysqli_fetch_row($response))
{
$comment="SELECT id,username,comment FROM comments WHERE pid='".$row[0]."' ORDER by timestamp";
$imgquery="SELECT imgpath FROM users WHERE username='".$row[1]."'";
$imgpath=mysqli_fetch_row($conn->query($imgquery));
$lquery="SELECT username FROM likes WHERE pid='".$row[0]."'";
$likes=$conn->query($lquery);
$res=$conn->query($comment);
 echo "<div class='jumbotron' id=".$row[0].">";
 if($_SESSION['username']===$row[1])
 echo "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<button class='delpost, btn btn-danger btn-sm'>Delete Post</button>";
 else
 {
 $fquery="SELECT username FROM `subscribed` WHERE pid='".$row[0]."' AND username='".$_SESSION['username']."'";
 $result=$conn->query($fquery);
 if ($result->num_rows==0)
 echo "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<button class='followpost2 , btn btn-success btn-sm'>Follow Post</button>";
 else
 echo "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<button class='unfollowpost2 , btn btn-danger btn-sm'>Unfollow Post</button>";
 }
 echo "<br><br><br>";
 echo "<img src=".$imgpath[0]." width='25px' height='25px' style=' border : 1px solid black'>";
 echo "<h3><a href='profile.php?user=".$row[1]."'>".$row[1]."</a></h3>";
 echo "<br>";
 echo $row[2];
 if($row[3]!=NULL)
 echo '<br><img src="'.$row[3].'"style="width:50%; max-width:500px;min-width:100px;"><br>';
 echo "<br><br>";
 $flag=0;
 if($likes->num_rows==0)
 echo "<b>No likes</b>";
 else
 { echo "<b>Liked by:</b> ";
  while($row3=mysqli_fetch_row($likes))
  {echo "<a href='profile.php?user=".$row3[0]."'>".$row3[0]."</a> ";
  if($row3[0]===$_SESSION['username'])
  $flag=1;
  }
 }
 echo "<br>";
 echo "<div class='abc'>";
 echo '<input type="hidden" name="pid" value="'.$row[0].'">';
 if($flag==0)
 echo "<button class='like2 ,btn btn-success'>Like</button>";
 else if($flag==1)
 echo "<br><button class='unlike2 ,btn btn-warning'>Unlike</button>";
 echo "</div>";
 echo "<br>";
 echo "<b>Comments:</b>";
 while($row2 = mysqli_fetch_row($res))
 {
 echo "<br>";
 echo "<br>";
 echo "<div id=".$row2[0].">";
 echo "<a href='profile.php?user=".$row2[1]."'>".$row2[1]."</a>";
 echo "<br>";
 echo "<br>";
 echo $row2[2];
 if($_SESSION['username']===$row2[1])
 echo "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<button class='delcomm2 , btn btn-danger btn-sm'>Delete Comment</button>";
 echo "</div>";
 }
 echo "<br>";
 echo "<div class='comment'>";
 echo '<input type="text" name="comment" placeholder="Comment">
			  <input type="hidden" name="pid" value="'.$row[0].'">
              <button class="comm2 ,btn btn-success">Comment</button>';
 echo "<br>";
 echo "</div>";
 echo "</div>";
 echo "<br>";
}
echo "<button class='btn btn-success' onclick='javascript:pull_feed()'>Back</button>";
?>
