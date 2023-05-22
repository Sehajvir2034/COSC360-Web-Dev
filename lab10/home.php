<?php

session_start();

if ($_SESSION['loggedIn'] == 'true'){
    echo "Welcome to the test site!";
    echo "<br>";
    echo "<br>";
    echo  '<a href="secure.php">Secure Data Page</a>';
    echo "<br>";
    echo  '<a href="logout.php">Logout</a>';

}else{
    echo "Go back to login";
    echo "<br>";
    echo "<br>";
    echo  '<a href="login.php">Login Page</a>';

}


?>