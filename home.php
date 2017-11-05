<?php
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.html");
  exit;
}
include 'connect.php';
$imgquery="SELECT imgpath FROM users WHERE username='".$_SESSION['username']."'";
$imgpath=mysqli_fetch_row($conn->query($imgquery));
$_SESSION['dp']=$imgpath[0];
?>
<!DOCTYPE html>
<html>
<title>ideaShare</title>
<head>
<link rel="stylesheet" href="home.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script>
<script src="core.js"></script>
<style>
body { padding-top: 70px;
 background-image: url("bg.jpg");
 background-size:cover;
    }
</style>
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span> 
</button>
<a class="navbar-brand" href="home.php">ideaShare</a>
</div>
</ul>
<div class="collapse navbar-collapse" id="myNavbar">
<ul class="nav navbar-nav">
<li><a><input type="search" size="20" placeholder="Search for a user" id="sbar" style="color:black"></a>
<div class="search" id="sbox">
</div></li>
<li><a class="nbutton">Notifications</a>
<div class="notbox">
</div></li>
<li><a href="javascript:pull_feed()">Refresh Feed</a></li>
<li><a href=<?php echo "profile.php?user=".$_SESSION['username']; ?> ><?php echo $_SESSION['username']; ?></a></li>
<li><img src=<?php echo $_SESSION['dp'];?> width='45px' height='45px' style=" border : 1px solid black"></li>
</ul>
  <ul class="nav navbar-nav navbar-right">
  <li class=".navbar-btn"><a href="logout.php" >Logout</a></li></ul>
</div>
</div></nav>
<div class="row">
<div class="col-md-4">
<p><textarea rows="4" cols="50" id="txtbox" placeholder="Share an Idea!"></textarea></p>
<button id="post" class="btn btn-success">Post</button><br><br></div>
</head>
<body>
<div class="col-md-4">
<div class="feed"></div></div>
</body>
</html>
