<?php
include "./connect.php";
include_once "./loginSQL.php";
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

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
              $_SESSION['UserName']=$row['UserName'];
              $_SESSION['FirstName'] = $row['FirstName'];
              $_SESSION['LastName'] = $row['LastName'];
              $_SESSION['Email'] = $row['Email'];
              $_SESSION['Status'] = $row['Status'];
              $_SESSION['ProfilePicture'] = $row['ProfilePicture'];
              $_SESSION['Password'] = $row['Password'];
              $array[]= $_SESSION;

        }

    } else {
        $_SESSION['status']='notloggedIn';
        return 'fail';
    }
    $conn->close();
    return json_encode($array);

  }




}




?>