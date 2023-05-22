<!DOCTYPE html>
<html>
<head></head> 
<body> 
<?php 
include "login_msg.php";
$logged_in = true; 
$user = "Arthur"; 
 echo "<p>Hello, world</p>"; 
 echo login_message($logged_in); 
?> 
</body> 
</html>