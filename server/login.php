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
  	
  	$userName = $_POST['email'];
  	$password = $_POST["password"];

  	$userName = clean_input($userName);
  	$password = clean_input($password);

  	$login = $loginWebService -> checkLogingetUserDetails($userName, $password);
  	
    if(!isset($_SESSION))
  {
    session_start();
  }
    if ($login == "fail")
    {
       
          if ($userName=="" || $password=="")
          {
           echo " <script>
                  var txt;
                  var r = confirm('All fields are required, Please try again.');
                  if(r==true || r==false)
                  {
                    window.location.href = 'http://qav2.cs.odu.edu/fordFanatics/index.php'; 
                  }
                 </script>


          ";
          }
          else 
          {
                   echo " <script>
                  var txt;
                  var r = confirm('wrong credentials, please try again.');
                  if(r==true || r==false)
                  {
                    window.location.href = 'http://qav2.cs.odu.edu/fordFanatics/index.php'; 
                  }
                 </script>


          ";
          }

    }
    else if ($login != "fail")
    {
      echo "<script> window.location.href = 'http://qav2.cs.odu.edu/fordFanatics/mainpage.php'</script>";
        //echo $login;
    }
        




  }







?>