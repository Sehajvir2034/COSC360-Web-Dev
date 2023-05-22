<?php

session_start();

if ($_SESSION['loggedIn'] == 'true'){
    echo "Welcome to the Secure page site!";
    echo "<br>";
    echo "<br>";
    echo  '<a href="logout.php">Logout</a>';

}else{
    echo "This place is only accessible to logged in users";
    echo "<br>";
    echo "<br>";

    echo  '<a href="login.php">Log In Page</a>';

}


?>