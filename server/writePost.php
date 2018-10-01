<?php
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  session_start();
  include_once "./loginService.php";
  include_once "./loginSQL.php";
  //echo "it is here";
   	$loginWebService = new LoginWebService();
  	
   	function clean_input($data) {
	  
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	
	 }
	// echo "it is here";
	  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	  	if(isset($_POST['postMessage']))
	  	{	

	  		if($_POST['postMessage'] == "")
	  		{
	  			  echo " <script>
                  var txt;
                  var r = confirm('Posts cannot be empty, Please try again.');
                  if(r==true || r==false)
                  {
                    window.location.href = 'http://qav2.cs.odu.edu/fordFanatics/mainpage.php'; 
                  }
                 </script>


          ";

	  		}
	  		else
	  		{
	  			if(isset($_SESSION['UserId']))
 			 	{
				 	   $userId = $_SESSION['UserId'];
				 	   echo "user id: " . $userId;
				 	   $uncleanedMessage = $_POST['postMessage'];
			     	   $cleanedMessage = clean_input($uncleanedMessage);
			     	   echo $userId;
				 	   echo $cleanedMessage;

			   		   $login = $loginWebService -> writePostToDB($userId, $cleanedMessage);

			   		   echo "<script> window.location.href ='http://qav2.cs.odu.edu/fordFanatics/mainpage.php'</script>";

 			 	}

	  		}

	  	}

	  }


?>