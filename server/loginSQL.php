<?php
//enables error reporting
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
include_once "connect.php";
//this class will contain all sql procedures that deal with user logging in
class LoginSqlService{
  //function to check if the user with the credentials provided exist in the database
  public function getUserDetails($username, $password) {
      $sql = "SELECT * FROM fordFanatics.user WHERE UserName = '$username' AND Password = '$password'";
      return $sql;
    }

  public function getComments($messageId)
  {
    $sql = "SELECT * FROM fordFanatics.comments WHERE parent_messageId = '$messageId'";
    return $sql;
  }

  public function addCommentsSQL($commentInput, $userId, $parentMessageId)
  {
    $sql = "INSERT INTO fordFanatics.comments (parent_messageId, comment, commentUserId)  VALUES ('$parentMessageId', '$commentInput', '$userId')";
    return $sql;
  }

  public function incrementLikeSql($messageId){

    $sql = "UPDATE posts SET likeCount = likeCount + 1 WHERE messageId = $messageId";
    return $sql;
  }

  public function getLikeCountFrmLikeTableSql($messageId){

    $sql = "SELECT * FROM userLikes WHERE message_id = $messageId AND reactionId = '1'";
    return $sql;

  }

  public function insertNewUserSql($username, $email, $password){

    $sql = "INSERT INTO fordFanatics.user (FirstName, LastName, UserName, Email, Password) VALUES ('', '', '$username', '$email', '$password')";

    return $sql;
  }

  public function checkIfUserExistsSql($email){

        $sql = "SELECT * FROM fordFanatics.user WHERE Email = '$email'";
        return $sql;
}

  public function getDislikeCountFrmLikeTable($messageId){

    $sql = "SELECT * FROM userLikes WHERE message_id = $messageId AND reactionId = '0'";
    return $sql;

  }


  public function decrementLikeSql($messageId){

    $sql = "UPDATE posts SET likeCount = likeCount - 1 WHERE messageId = $messageId";
    return $sql;

  }

  public function recordDislikeSql($messageId, $userId)
  {

    $sql = "INSERT INTO fordFanatics.userLikes (message_id, userId, reactionId) VALUES ('$messageId', '$userId', '0') ON DUPLICATE KEY UPDATE reactionId=0";
    return $sql;

  }

  public function recordLikesSql($messageId, $userId)
  {
    $sql = "INSERT INTO fordFanatics.userLikes (message_id, userId, reactionId) VALUES ('$messageId', '$userId', '1') ON DUPLICATE KEY UPDATE reactionId=1";
    return $sql;
  }

  public function getLikesSql($messageId, $userId){

    $sql = "SELECT * FROM fordFanatics.userLikes WHERE message_id = '$messageId' AND userId = '$userId'";
    return $sql;

  }

  public function getLikeCountForMes($messageId)
  {
    $sql = "SELECT likeCount FROM fordFanatics.posts WHERE messageId = '$messageId'";
    return $sql;
  }

    public function postToDB($userId, $message){

    $sql = "INSERT INTO fordFanatics.posts (message, UserId, groupId) VALUES ('$message', '$userId', '3')";
    return $sql;

  }

  public function unlikePost($userId, $messageId)
  {
    $sql = "DELETE FROM fordFanatics.userLikes WHERE userId='$userId' AND message_id='$messageId'";
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
