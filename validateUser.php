<?php 

  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  session_start();
  include_once "./server/loginService.php";
  include_once "./server/loginSQL.php";
  include_once "./server/connect.php";

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $username = "empty";
    $password = "empty";
    $email = "empty";

    function clean_input($data) {
    
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }
    if(isset($_POST['firstName'])){
   
    $username = clean_input($_POST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    
    $password = clean_input($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    $email = clean_input($_POST['email']);
    $email = mysqli_real_escape_string($conn, $email);
    
    $firstName = clean_input($_POST['firstName']);
    $firstName = mysqli_real_escape_string($conn, $firstName);

    $lastName  = clean_input($_POST['lastName']);
    $lastName = mysqli_real_escape_string($conn, $lastName);

    $conn->close();

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();


    $sql_service = new LoginSqlService();
    $MyloginWebService = new LoginWebService();
    
    $checkEmail = "SELECT * FROM fordFanatics.user WHERE Email = '$email'";

    $sqlCheckuname = "SELECT * FROM fordFanatics.user WHERE UserName = '$username'";

    $result = $conn->query($checkEmail);

    $sameEmail = $result->num_rows;

    $resultTwo = $conn->query($sqlCheckuname);

    $sameUsername = $resultTwo->num_rows;


  
 

    if($sameEmail == 0 && $sameUsername==0)
    {
            $MyloginWebService->insertNewUser($firstName, $lastName, $username, $email, $password);
            $userId = $MyloginWebService->getUserIdFromUserEmail($email);
            $MyloginWebService->addUserToGroup(3, $userId);
           
            echo 1;
    }
    else if ($sameEmail == 0 && $sameUsername > 0)
    {
        //case that there is a invalid username
            //echo "case 2: " . " " . $resultCount . " " . $resultTwoCount;
            echo 2;
    }
    else if ($sameEmail > 0 && $sameUsername == 0)
    {
            //echo "case 3: " . " " . $resultCount . " " . $resultTwoCount;
            echo 3;
    }
    else if($sameEmail > 0 && $sameUsername > 0)
    {
        echo 4;
    }
    // else
    // {
            
    // }



}
    
?>