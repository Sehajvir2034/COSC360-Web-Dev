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
  $output = "<p>Database connection unsuccessful.</p>";
  exit($output);
}
else
{
    if (isset($_SERVER["REQUEST_METHOD"]) &&  $_SERVER["REQUEST_METHOD"] == "POST")
    {
      if (isset($_POST["username"])){
        $user_name = $_POST["username"];
      }
      if (isset($_SERVER['HTTP_REFERER'])){
        $return_link = $_SERVER['HTTP_REFERER'];
      }
        $sql = "SELECT * FROM users where username = '$user_name';";
        $results = mysqli_query($connection, $sql);

        echo "<fieldset><legend>User: $user_name</legend>";
        echo "<table id= \"usertable\" >";

        if ($row = mysqli_fetch_assoc($results))
        {
            echo "<tr><td>First Name: </td><td>".$row['firstName']."</td></tr>";
            echo "<tr><td>Last Name: </td><td>".$row['lastName']."</td></tr>";
            echo "<tr><td>Email: </td><td>".$row['email']."</td></tr>";
        }
        else
        {
          echo "<tr><td>Invalid username and/or password</tr></td>";

        }
        echo "</table>";
        echo "</fieldset>";
        if (isset($return_link))
        {
          echo '<a href="'.$return_link.'">Return to user entry</a>';
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
