<?php
if((!isset($_GET[Username]) || trim($_GET[Username]) == '')   || (!isset($_GET[Password]) || trim($_GET[Password]) == ''))
{
  header("Location: register.php");
  echo ".";
}
$con = mysqli_connect("localhost","user_here","password_here","CENG"); //must include mysql user and password
if (!$con)
{
  error_log("Could not connect to db");
  die('Could not connect: ' . mysqli_connect_error());
}

$sql="insert into users(FullName, Username, Password, Email)
values
('$_GET[FullName]','$_GET[Username]','$_GET[Password]','$_GET[Email]')";

if (!mysqli_query($con,$sql))
{
  error_log(mysqli_error($con));
  die('Insertion Error: ' . mysqli_error($con));
  header("Location: register.php");
} else {
  header("Location: index.php");
}

mysqli_close($con);
?>
