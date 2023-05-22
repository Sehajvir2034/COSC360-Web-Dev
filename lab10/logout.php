<?php
session_start();

if($_SESSION['loggedIn'] == 'true'){
    session_unset();

    session_destroy();
    

    echo "You have successfully logged out! In 3 secs you will be redirected to the login page.";

    header("refresh:3;url=login.php");
}else{
    echo "You need to be logged in to log out! You will be redirected to the login page in 3 secs!";
    header("refresh:3;url=login.php");
}

?>
