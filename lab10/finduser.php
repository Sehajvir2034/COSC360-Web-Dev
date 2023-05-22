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
            echo "<tr><td>User ID: </td><td>".$row['userID']."</td></tr>";
            $userID = $row['userID'];

            $sql = "SELECT contentType, image FROM userImages where userID=?"; 
            // build the prepared statement SELECTing on the userID for the user 
            $stmt = mysqli_stmt_init($connection);   
            //init prepared statement object 
            mysqli_stmt_prepare($stmt, $sql);  
            // bind the query to the statement 
            mysqli_stmt_bind_param($stmt, "i", $userID); 
                // bind in the variable data (ie userID) 
            $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt)); 
                // Run the query.  run spot run!   
            mysqli_stmt_bind_result($stmt, $type, $image); //bind in results 
                      // Binds the columns in the resultset to variables 
            mysqli_stmt_fetch($stmt); 
                // Fetches the blob and places it in the variable $image for use as well  
            // as the image type (which is stored in $type)  
            mysqli_stmt_close($stmt); 
                // release the statement

            

        }
        else
        {
          echo "<tr><td>Invalid username and/or password</tr></td>";

        }
        echo "</table>";
        echo "</fieldset>";
        echo '<img src="data:image/'.$type.';base64,'.base64_encode($image).'"/>';
        echo"<br>";
        if (isset($return_link))
        {
          echo '<a href="'.$return_link.'">Return to Find User Page</a>';
        }
        mysqli_free_result($results);

    }
    else {
      echo "<p>Bad data entered</p>";
      echo"<br>";
      echo '<a href="'.$return_link.'">Return to Find User Page</a>';

    }

    mysqli_close($connection);
}
?>
</body>
</html>
