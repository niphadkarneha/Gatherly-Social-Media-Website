<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
include_once "connect.php";
include_once "loginSQL.php";
class LoginWebService{

  public function checkLogingetUserDetails($email_id, $password)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    // echo "Hello";
    $sql_service = new LoginSqlService();
    $getUserDetails = $sql_service->getUserDetails($email_id, $password);
    // echo $getUserDetails;
    $result = $conn->query($getUserDetails);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
              if(!isset($_SESSION))
              {
                  session_start();
              }

              $_SESSION['UserName']=$row['UserName'];
              $_SESSION['FirstName'] = $row['FirstName'];
              $_SESSION['LastName'] = $row['LastName'];
              $_SESSION['Email'] = $row['Email'];
              $_SESSION['Status'] = $row['Status'];
              $_SESSION['ProfilePicture'] = $row['ProfilePicture'];
              $_SESSION['Password'] = $row['Password'];
              $_SESSION['UserId'] = $row['ID'];
              $array[]= $_SESSION;

        }

    } else {
        $_SESSION['status']='notloggedIn';
        return 'fail';
    }
    $conn->close();
    return json_encode($array);

  }

  public function writePostToDB($userId, $message)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $writeToDB = $sql_service->postToDB($userId, $message);

    $result = $conn->query($writeToDB);

    $conn->close();
    return "write to db called";

  }

  public function getPosterDetails($userId){

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $getPoster = $sql_service->matchPostWithUser($userId);

    $result = $conn->query($getPoster);

     if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
             
             if(!isset($_SESSION)){

                session_start();

             }

              $_SESSION['PostFirstName']=$row['FirstName'];
              $_SESSION['PostLastName'] = $row['LastName'];
              $_SESSION['MessageUserId'] = $row['UserId'];
              //$_SESSION['TimeOfPost'] = $row['TimeOfPost'];
              $array[]= $_SESSION;

        }

        $conn->close();
        return $array;


     }


  }

  public function getAllGlobalPosts(){

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $getAllPosts = $sql_service->getGlobalPostsSQL();

    $result = $conn->query($getAllPosts);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
              if(!isset($_SESSION))
              {
                  session_start();
              }

              $_SESSION['messageId']=$row['messageId'];
              $_SESSION['message'] = $row['message'];
              $_SESSION['UserId'] = $row['UserId'];
              $_SESSION['TimeOfPost'] = $row['TimeOfPost'];
              $array[]= $_SESSION;

        }

        $conn->close();
        return $array;

    }

  }

}






?>