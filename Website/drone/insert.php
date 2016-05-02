<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$username = $_GET['username'];
$runtime = $_GET['runtime'];
$connection = mysqli_connect("localhost","user_here","password_here","CENG"); //must include mysql user and password
$query = "INSERT INTO flight (username, runtime) VALUES ('$username', '$runtime');";
echo $query;
$result = mysql_query($connection,$query);
echo $result;
if (!mysqli_query($connection,$query))
{
  error_log(mysqli_error($connection));
  die('Insertion Error: ' . mysqli_error($connection));
}
echo "1 record added";
mysqli_close($connection);

?>
