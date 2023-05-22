
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
      if (isset($_POST["firstname"])){
        $first_name = $_POST["firstname"];

      }
      if (isset($_POST["lastname"])){
        $last_name = $_POST["lastname"];

      }
      if (isset($_POST["username"])){
        $user_name = $_POST["username"];

      }
      if (isset($_POST["email"])){
        $email = $_POST["email"];

      }
      if (isset($_POST["password"])){
        $pass = $_POST["password"];
      }
        if (isset($_SERVER['HTTP_REFERER'])){
          $return_link = $_SERVER['HTTP_REFERER'];

        }

        $sql = "SELECT * FROM users where username = '$user_name' OR email = '$email';";
        $results = mysqli_query($connection, $sql);


        if ($row = mysqli_fetch_assoc($results))
        {
          echo "<p>User already exists with this name and/or email<p>";
          if (isset($return_link))
          {
            echo '<a href="'.$return_link.'">Return to user entry</a>';
          }
        }
        else {

          $hashedPassword = md5($pass);
          $sql = "INSERT INTO users (username, firstname, lastname, email, password) VALUES ('$user_name','$first_name','$last_name','$email','$hashedPassword')";
            if (mysqli_query($connection, $sql))
            {
              $count = mysqli_affected_rows($connection);
              echo "<p>The user with username: $user_name has been created</p>";
            }
        }
        mysqli_free_result($results);

    }
    else {
      echo "<p>Bad information has been entered</p>";
      if (isset($_SERVER['HTTP_REFERER']))
          $return_link = $_SERVER['HTTP_REFERER'];
      if (isset($return_link))
      {
        echo '<a href="'.$return_link.'">Return to user entry</a>';
      }
    }

    mysqli_close($connection);
}
?>
</body>
</html>
