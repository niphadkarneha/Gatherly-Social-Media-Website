<?php 
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  session_start();
  include_once "./loginService.php";
  include_once "./loginSQL.php";
  include_once "./connect.php";
  
  $loginWebService = new LoginWebService();
 
  	function clean_input($data) {
	  
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	
	}

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  	
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

  	$userName = mysqli_real_escape_string($conn, $_POST['email']);// $_POST['email'];
  	$password = mysqli_real_escape_string($conn, $_POST['password']); // $_POST["password"];

  	$userName = clean_input($userName);
  	$password = clean_input($password);
    $secret = "6LfpEHsUAAAAAJmkV6GzP3D0JmIHGyM213V9aGYJ";
    $response = $_POST["captcha"];
    
    $verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
    $captcha_success=json_decode($verify);
    
    if ($captcha_success->success==false) {

    //This user was not verified by recaptcha.
      echo "failCaptcha";

    }
    else if ($captcha_success->success==true) {

    //This user is verified by recaptcha
        $login = $loginWebService -> checkLogingetUserDetails($userName, $password, $conn);
    

        if(!isset($_SESSION))
        {
          session_start();
        }
          if ($login == "fail")
          {
             
                if ($userName=="" || $password=="")
                {
                 echo "empty";
                }
                else 
                {
                         echo "WrongCredentials";
                }

          }
          else if ($login != "fail")
          {
          
           if(!isset($_SESSION))
           {
              session_start();
           }
    
            $userId = $_SESSION['UserId'];
            $userEmail =  $_SESSION['Email'];
            $displayPic = $_SESSION['displayPic'];

            if($displayPic == "1")
            {
               $url = $loginWebService -> get_gravatar($userEmail);
               $_SESSION['gravatarProfilePicture'] = $url;
            }
           
             echo "success";
          }
 

    }


  	




  }







?>
