<html>
<body>
<style type="text/css">

h1{
  font-size: 30px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
}
table{
  width:100%;
  table-layout: fixed;
}
.tbl-header{
  background-color: rgba(255,255,255,0.3);
}
.tbl-content{
  height:300px;
  overflow-x:auto;
  margin-top: 0px;
  border: 1px solid rgba(255,255,255,0.3);
}
th{
  padding: 20px 15px;
  text-align: left;
  font-weight: 500;
  font-size: 12px;
  color: #fff;
  text-transform: uppercase;
}
td{
  padding: 15px;
  text-align: left;
  vertical-align:middle;
  font-weight: 300;
  font-size: 12px;
  color: #fff;
  border-bottom: solid 1px rgba(255,255,255,0.1);
}

/* demo styles */

@import url(http://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
body{
  /*
  background: -webkit-linear-gradient(left, #25c481, #25b7c4);
  background: linear-gradient(to right, #25c481, #25b7c4);
  font-family: 'Roboto', sans-serif;
  background: url("http://www.flying-hobby.com/images/large/H107C-BR/H107C-BR_16.jpg") 50% fixed;
  height: 100vh;
  */
  font-family: "Open Sans", sans-serif;
  height: 100vh;
  background: url("img.jpg") 50% fixed;
  background-size: cover;

}
section{
  margin: 50px;
}
.copy-right {
  text-align: center;
  color: #a8f6e7;
  margin: 100px 0 0;
  font-size: 12px;
  font-weight: 300;
  border-top: 1px solid  rgba(255,255,255,0.2);
  padding: 20px 2%;
  position: absolute;
  left: 0;
  bottom: 0;
  width: 96%;
  text-shadow: 1px 0 1px rgba(0, 0, 0, 0.4);
  text-decoration: none;
}
.copy-right:visited {
  color: #a8f6e7;
  text-decoration: none;
}
.copy-right:hover, .copy-right:focus, .copy-right:visited:hover, .copy-right:visited:focus {
  text-decoration: underline;
  color: #fff;
}

/* for custom scrollbar for webkit browser*/

::-webkit-scrollbar {
  width: 6px;
}
::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}
::-webkit-scrollbar-thumb {
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}
</style>
</body>
</html>
<?php

$newLine="\n";

header("content-type: text/html");
#Connect to database
$con = mysqli_connect("localhost","user_here","password_here","CENG"); //must include mysql user and password
if (!$con)
{
  die('Could not connect: ' . mysqli_connect_error());
}
$result = mysqli_query($con,"SELECT *  FROM flight where username= '". $_GET['username'] . "'");

echo "<section>";
echo "<h1>Drone Data</h1>";
echo "<div class=\"tbl-header\">";
echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
echo "<thead>";
echo "<tr>";
echo "<th>Username</th>";
echo "<th>Runtime</th>";
echo "</tr>";

echo "</thead>";
echo "</table>";
echo "</div>";
echo "<div class=\"tbl-content\">";
echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
echo "<tbody>";
while($row = mysqli_fetch_array($result, MYSQL_BOTH))
{
  echo "<tr>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['runtime'] . "</td>";
  echo "</tr>\n";
}

echo "</tbody>";
echo "</table>";

echo "</div>";
mysqli_close($con);
?>
