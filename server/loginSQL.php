<?php
//enables error reporting
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

//this class will contain all sql procedures that deal with user logging in
class LoginSqlService{
  //function to check if the user with the credentials provided exist in the database
  public function getUserDetails($username, $password) {
      $sql = "SELECT * FROM fordFanatics.user WHERE UserName = '$username' AND Password = '$password'";
      return $sql;
    }

}
  



?>
