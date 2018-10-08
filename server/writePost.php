<?php
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  session_start();
  include_once "./loginService.php";
  include_once "./loginSQL.php";
  //echo "it is here";
   	$loginWebService = new LoginWebService();
  	$firstTimeVisitingPage = true;

   	function clean_input($data) {
	  
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	
	 }

	 function my_simple_crypt( $string, $action = 'e' ) {
        // you may change these values to your own
        $secret_key = 'my_simple_secret_key';
        $secret_iv = 'my_simple_secret_iv';

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }

        return $output;
    }


	// echo "it is here";
	  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	  	
	  	if(isset($_POST['groupPost']))
	  	{
	  		echo "it is here";

	  		echo "group id: " . $_POST['groupId'];
	  		echo "post : "  . $_POST['groupPost'];
	  	
	  	if($_POST['groupPost'] == "")
	  		{
	  			  echo " <script>
                  var txt;
                  var r = confirm('Posts cannot be empty, Please try again.');
                  if(r==true || r==false)
                  {
                    window.location.href = 'http://qav2.cs.odu.edu/fordFanatics/groupsPage.php'; 
                  }
                 </script>


        		  ";

	  	    }
	  	  else 
	  	  {

	  	  		if(isset($_SESSION['UserId']))
 			 	{
				 	   $userId = $_SESSION['UserId'];
				 	   $groupId = $_POST['groupId'];
				 	   //echo "user id: " . $userId;
				 	   $encryptedGroupId = my_simple_crypt($groupId, 'e');
				 	   $uncleanedMessage = $_POST['groupPost'];
			           $cleanedMessage = clean_input($uncleanedMessage);
			     	//   // echo $userId;
				 	  

			   		   $login = $loginWebService -> writeGroupPostToDB($userId, $cleanedMessage, $groupId);

			   	  echo "
			   	  <script> window.location.href ='http://qav2.cs.odu.edu/fordFanatics/groupsPage.php?groupId=$encryptedGroupId'; 


			   	  </script>";

 			 	}


	  	  }


	  	}




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
				 	  // echo "user id: " . $userId;
				 	   $uncleanedMessage = $_POST['postMessage'];
			     	   $cleanedMessage = clean_input($uncleanedMessage);
			     	  // echo $userId;
				 	   //echo $cleanedMessage;

			   		   $login = $loginWebService -> writePostToDB($userId, $cleanedMessage);

			   		   echo "<script> window.location.href ='http://qav2.cs.odu.edu/fordFanatics/mainpage.php'</script>";

 			 	}

	  		}

	  	}

	  }


?>