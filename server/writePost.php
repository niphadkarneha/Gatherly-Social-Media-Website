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
// //<?php



// //

	if (isset($_GET['postMessage']))
 	{
		if(!isset($_SESSION))
 		{
 			session_start();
 		}
		
 		if(isset($_SESSION['UserId']))
 		{
			   $userId = $_SESSION['UserId'];

			   $uncleanedMessage = $_GET['postMessage'];
	    	   $cleanedMessage = clean_input($uncleanedMessage);
	    	   echo $userId;
			  // echo $cleanedMessage;

	   		   $login = $loginWebService -> writePostToDB($userId, $cleanedMessage);




 		}




 	}


  


?>