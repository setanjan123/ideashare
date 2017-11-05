<?php
include 'connect.php';
if(empty($_POST['user'])|| empty($_POST['pass'])|| empty($_POST['fname'])|| empty($_POST['email'])|| empty($_POST['gender'])|| empty($_POST['bday']))
echo "The Information you entered is incomplete";
	
else {
$username=preg_replace('/\s+/', '', $_POST['user']);
$password=preg_replace('/\s+/', '', $_POST['pass']);
$query1 = "SELECT username FROM `users` WHERE username='".$username."'";
$query2 = "SELECT email FROM `users` WHERE email='".$_POST['email']."'";
$result1 = $conn->query($query1);
$result2 = $conn->query($query2);
if ($result1->num_rows!=0)
{ echo "Your username already exists. Kindly change it";
}
else if($result2->num_rows!=0)
{
echo "The e-mail you provided is already registered here. Please change it";
}
else
{
 if(!empty($_FILES['image']['name']))
{
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
        echo "File has to be a image";
        exit;   
    }
   $myname = strtolower($_FILES['image']['tmp_name']);
   $save_path="images/";
   $target=$save_path.basename($_FILES['image']['tmp_name']);
   move_uploaded_file($_FILES['image']['tmp_name'],$target);
}
else
$target="images/default.jpg";

$sql = "INSERT INTO `users` VALUES ('".$username."', '".$password."','".$_POST['fname']."','".$_POST['email']."','".$_POST['gender']."','".$target."','".$_POST['bday']."')";

if ($conn->query($sql) === TRUE) {
$mailto      = $_POST['email'];
$code        = mt_rand(1000,9999);
$mailsubject = "IdeaShare Account Verification";
$mailmessage = " Please follow <a href='https://shareideas.me/verify.php?u=".$username."&c=".$code."'>this</a> link to activate your account.";
$mailheader  = "From: IdeaShare <webmaster@shareideas.me>\n";
$headers .= "X-Mailer: PHP/".phpversion()."\r\n";
$mailheader .= "X-Priority: 1\n"; // Urgent message!
$mailheader .= "MIME-Version: 1.0\r\n";
$mailheader .= "Content-Type: text/html; charset=iso-8859-1\n";
mail($mailto, $mailsubject, $mailmessage, $mailheader);
$sql="INSERT INTO auth VALUES('".$username."','".$code."')";
$conn->query($sql);
echo "1";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
}
$conn->close();
?>