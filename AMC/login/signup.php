<?php
include("conn.php");

$username = $_POST["user"];
$gmail = $_POST["email"];
$mobile = $_POST["mob"];
$password = $_POST["pass"];
$cpassword = $_POST["cpass"];

$sql = "insert into signup values('$username','$gmail',$mobile,'$password','$cpassword')";
$result = mysqli_query($conn,$sql);

if($result)
{
   header("location:login.php");
}
else
{
    echo "error in data insertion";
}

?>