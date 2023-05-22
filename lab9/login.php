<!DOCTYPE html>
<html>
<body>

<?php

$host     = "localhost";
$database = "lab9";
$user     = "webuser";
$password = "P@ssw0rd";

$connection = mysqli_connect($host, $user, $password, $database);
$error = mysqli_connect_error();

if($error != null)
{
  $output = "<p>Database connection unsuccessful!</p>";
  exit($output);
}
else
{
    if (isset($_SERVER["REQUEST_METHOD"]) &&  $_SERVER["REQUEST_METHOD"] == "POST")
    {
      if (isset($_POST["username"])){
        $user_name = $_POST["username"];
      }
      if (isset($_POST["password"])){
        $password = $_POST["password"];
      }
      if (isset($_SERVER['HTTP_REFERER'])){
        $return_link = $_SERVER['HTTP_REFERER'];
      }

        $hashedPassword = md5($password);
        $sql = "SELECT * FROM users where username = '$user_name' AND password = '$hashedPassword';";

        $results = mysqli_query($connection, $sql);
        if ($row = mysqli_fetch_assoc($results)){
          echo "<p>User has a valid account<p>";
        }
        else{
          echo "<p>username and/or password are invalid</p>";
          if (isset($return_link)){
            echo '<a href="'.$return_link.'">Return to user entry</a>';
          }
        }
        mysqli_free_result($results);
    }
    else {
      echo "<p>Bad data entered</p>";

    }
    mysqli_close($connection);
}
?>
</body>
</html>
