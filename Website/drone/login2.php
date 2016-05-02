<?php
$connection = mysqli_connect("localhost","user_here","password_here","CENG"); //must include mysql user and password
$query="select * from users where username = '" . $_GET['username'] . "'";
$result = mysqli_query($connection,$query);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $usernameResult = $row["Username"];
    $passwordResult = $row["Password"];
  }
}

mysqli_close($connection);

if ($_GET['username'] == $usernameResult && $_GET['password'] == $passwordResult) {
  header('Location: dump.php?username=' . $_GET['username']);
} else {
  header('Location: index.php');
}
?>
