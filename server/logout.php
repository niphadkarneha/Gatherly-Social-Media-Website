<?php

session_start();
$_SESSION = Array();
foreach(array_keys($_SESSION) as $k) unset($_SESSION[$k]);
// session_unset();
// unset($_SESSION["UserId"]); 
// session_destroy();

header("location:http://qav2.cs.odu.edu/fordFanatics/index.php");
exit();

?>