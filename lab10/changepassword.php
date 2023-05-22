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
      if (isset($_POST["oldpassword"])){
        $oldpassword = $_POST["oldpassword"];
      }
      if (isset($_POST["newpassword"])){
        $newpassword = $_POST["newpassword"];
      }
      if (isset($_SERVER['HTTP_REFERER'])){
        $return_link = $_SERVER['HTTP_REFERER'];
      }

        $hashedPassword = md5($oldpassword);

        $sql = "SELECT * FROM users where username = '$user_name' AND password = '$hashedPassword';";
        $results = mysqli_query($connection, $sql);

        if ($row = mysqli_fetch_assoc($results))
        {
          $sql = "UPDATE users SET password = md5('$newpassword') WHERE username = '$user_name';";
            if (mysqli_query($connection, $sql)){
              $count = mysqli_affected_rows($connection);
              echo "<p>User's password has been updated</p>";
            }
        }
        else
        {
          echo "<p>username and/or password are invalid.</p>";
          if (isset($return_link))
          {
            echo '<a href="'.$return_link.'">Return to user entry</a>';
          }
        }
        mysqli_free_result($results);

    }
    else {
      //redirect
      echo "<p>Bad data entered</p>";

    }

    mysqli_close($connection);
}
?>
</body>
</html>
