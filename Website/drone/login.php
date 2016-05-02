<?php
$connection = mysqli_connect("localhost","user_here","password_here","CENG"); //must include mysql user and password
$query="select * from users where username = '" . $_GET['username'] . "'";
$result = mysqli_query($connection,$query);

$emparray = array();
while($row =mysqli_fetch_assoc($result))
{
  $emparray[] = $row;
}

echo "{ \"login\" : ";
echo json_encode($emparray);
echo "}";
mysqli_close($connection);
?>
