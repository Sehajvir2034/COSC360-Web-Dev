
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

      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
          echo "<br>";

          echo "File is not an image.";
          $uploadOk = 0;
        }
      }

      // Check if file already exists
      if (file_exists($target_file)) {
        echo "<br>";
        echo "Sorry, file already exists.";
        $uploadOk = 0;
      }

      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
      }

      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        echo "<br>";
        echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "<br>";
          echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
          echo "<br>";
          echo "Sorry, there was an error uploading your file.";
        }
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

        // fetch the userID of the new user
        $sql = "SELECT * FROM users where username = '$user_name' OR email = '$email';";
        $results = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($results);
        $userID = $row['userID'];

        $imagedata = file_get_contents($_FILES['fileToUpload']['tmp_name']); 
        //store the contents of the files in memory in preparation for upload 
 
        $sql = "INSERT INTO userImages (userID, contentType, image) VALUES(?,?,?)"; 
              // create a new statement to insert the image into the table.  Recall 
            // that the ? is a placeholder to variable data. 
          
        $stmt = mysqli_stmt_init($connection);   //init prepared statement object 
            
        mysqli_stmt_prepare($stmt, $sql);     // register the query  
            
        $null = NULL; 
        mysqli_stmt_bind_param($stmt, "isb", $userID, $imageFileType, $null);  
        // bind the variable data into the prepared statement.  You could replace 
        // $null with $data here and it also works.  You can review the details 
        // of this function on php.net.  The second argument defines the type of  
        // data being bound followed by the variable list.  In the case of the  
        // blob, you cannot bind it directly so NULL is used as a placeholder.   
        // Notice that the parametner $imageFileType (which you created previously) 
        // is also stored in the table.  This is important as the file type is 
        // needed when the file is retrieved from the database.  
            
        mysqli_stmt_send_long_data($stmt, 2, $imagedata);  
        // This sends the binary data to the third variable location in the  
        // prepared statement (starting from 0). 
        
        $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt)); 
            // run the statement  
              
        mysqli_stmt_close($stmt);



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
