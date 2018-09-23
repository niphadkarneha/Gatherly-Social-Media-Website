<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

   
class LoginSqlService{

  public function getUserDetails($username, $password) {
      $sql = "SELECT * FROM fordFanatics.user WHERE UserName = '$username' AND Password = '$password'";
      return $sql;
    }

}
  



?>