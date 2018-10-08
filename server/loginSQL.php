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

  public function postToDB($userId, $message){

  	$sql = "INSERT INTO fordFanatics.posts (message, UserId, groupId) VALUES ('$message', '$userId', '3')";
  	return $sql;

  }

  public function groupPostToDbSQL($userId, $message, $groupId)
  {
    $sql = "INSERT INTO fordFanatics.posts (message, userId, groupId) VALUES ('$message', '$userId', '$groupId')";
    return $sql;
  }


  //sql to get all of the posts
  public function getGlobalPostsSQL()
  {
  	$sql = "SELECT * FROM fordFanatics.posts WHERE groupId='3' ORDER by TimeOfPost DESC";
  	return $sql;
  }

  public function getGroupNamesSQL($groupId)
  {
    $sql = "SELECT * FROM fordFanatics.groups WHERE groupId = '$groupId'";

    return $sql;
  }


  public function matchPostWithUser($userId)
  {
  	$sql = "SELECT * FROM fordFanatics.user WHERE ID='$userId'";
  	return $sql;
  }

  public function getPostByGroup($groupId)
  {
    $sql = "SELECT * FROM fordFanatics.posts WHERE groupId='$groupId' ORDER by TimeOfPost DESC ";
    return $sql;
  }

  public function getGroupsForUser($userId)
  {
  	$sql = "SELECT * FROM userGroup WHERE groupUserId = '$userId'";
  	return $sql;
  }


}
  



?>
