<?php 
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  session_start();
  include_once "./loginService.php";
  include_once "./loginSQL.php";

  $loginWebService = new LoginWebService();
 
  	function clean_input($data) {
	  
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	
	}

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  	
  	$userName = $_POST['username'];
  	$password = $_POST["password"];

  	$userName = clean_input($userName);
  	$password = clean_input($password);

  	$login = $loginWebService -> checkLogingetUserDetails($userName, $password);
  	echo $login;

  }







?>