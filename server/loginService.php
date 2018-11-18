<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
include_once "connect.php";
include_once "loginSQL.php";
class LoginWebService{

  public function checkLogingetUserDetails($email_id, $password, $conn)
  {
    // $database_connection = new DatabaseConnection();
    // $conn = $database_connection->getConnection();
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
              $_SESSION['ProfilePictureLoggedIn'] = $row['ProfilePicture'];
              $_SESSION['Password'] = $row['Password'];
              $_SESSION['UserId'] = $row['ID'];
              $_SESSION['userType'] = $row['type'];
              $_SESSION['ProfilePicture'] = $row['ProfilePicture'];
              $array[]= $_SESSION;

        }

    } else {
        $_SESSION['status']='notloggedIn';
        return 'fail';
    }
    $conn->close();
    return json_encode($array);

  }

  public function checkIfUserIsInGroup($UserId, $groupId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $checkUserInGroupSql = "SELECT * FROM userGroup WHERE groupUserId = '$UserId' AND groupId = '$groupId'";

   // $checkIfUserIsOwnerSql = "SELECT * FROM groups WHERE ownerUserId = '$UserId' AND groupId = '$groupId'";

    //$checkIfUserIsOwner = $conn->query($checkIfUserIsOwnerSql);

    $checkUserInGroup = $conn->query($checkUserInGroupSql);

    if($checkUserInGroup->num_rows == 0)
    {
      return false;
    }
    else if ($checkUserInGroup->num_rows > 0)
    {
      return true;
    }

    $conn->close();

  }


  public function deleteMessage($messageId)
  { 
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $sql_service = new LoginSqlService();

    $deleteMessageSql = $sql_service->deleteMessageSql($messageId);

    $result = $conn->query($deleteMessageSql);

    $conn->close();

  }

  public function lockGroup($groupId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $sql_service = new LoginSqlService();

    $lockGroupSql = $sql_service->lockGroupSql($groupId);

    $result = $conn->query($lockGroupSql);

    $conn->close();


  }

  public function unlockGroup($groupId)
  {

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $sql_service = new LoginSqlService();

    $lockGroupSql = $sql_service->unlockGroupSql($groupId);

    $result = $conn->query($lockGroupSql);

    $conn->close();



  }



  public function uploadProfilePicture($userId, $filePath)
  {
    
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $sql_service = new LoginSqlService();

    $uploadProfilePictureSql = $sql_service->uploadProfilePictureSql($userId, $filePath);

    $result = $conn->query($uploadProfilePictureSql);

    $conn->close();
  
  }

  public function sendInvitationToUser($groupId, $userIdInvited)
  {
      $database_connection = new DatabaseConnection();
      $conn = $database_connection->getConnection();
      $sql_service = new LoginSqlService();

      $sendInvitationSql = "INSERT INTO fordFanatics.groupInvite (groupId, userIdInvited) VALUES ('$groupId', '$userIdInvited')";

      $result = $conn->query($sendInvitationSql);

      $conn->close();

  }


  public function getGroupInfo($groupId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $sql_service = new LoginSqlService();

    $getGroupInfoSql = $sql_service->getGroupInfoSql($groupId);

    $result = $conn->query($getGroupInfoSql);

    if($result->num_rows > 0) {

      while ($row = $result->fetch_assoc()) {

        $data['groupInfo'][] = $row;

      }

      return json_encode($data);

    }

  }


  public function getLatestPost($userId, $groupId)
  {

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $sql_service = new LoginSqlService();

    $getLatestPostSql = $sql_service->getLatestPostSql($userId, $groupId);

    $result = $conn->query($getLatestPostSql);

    if($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

            $data['latestPost'][]=$row;
        }


        return json_encode($data);

    }

  }


  public function getAllExistingGroups() {

  $database_connection = new DatabaseConnection();
  $conn = $database_connection->getConnection();
  $sql_service = new LoginSqlService();

  $getAllExistingGroupsSql = $sql_service -> getAllExistingGroupsSql();

  $result = $conn->query($getAllExistingGroupsSql);

  if($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

      $data['groups'][] = $row;

    }

    return json_encode($data);

  }

  }


  public function getListOfInvitesbyUserId($userId){

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $sql_service = new LoginSqlService();

    $getInvites = $sql_service->getInvitesSql($userId);


    $result = $conn->query($getInvites);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
              if(!isset($_SESSION))
              {
                  session_start();
              }

              $_SESSION['inviteId']=$row['inviteId'];
              $_SESSION['groupIdInvitation'] = $row['groupId'];
              $_SESSION['userIdInvitation'] = $row['userIdInvited'];
              $_SESSION['timeOfInvite'] = $row['timeOfInvite'];
              //$_SESSION['parentMessageId'] = $row['parent_messageId'];
              
              $array[]= $_SESSION;

        }

       
        return $array;

    }







  }

  public function checkIfUserHasBeenInvited($userIdInvited, $groupIdTobeInvitedTo)
  {

     $database_connection = new DatabaseConnection();
     $conn = $database_connection->getConnection();

     $sql_service = new LoginSqlService();

     $checkIfUserHasBeenInvitedSql = $sql_service->checkIfUserHasBeenInvitedSql($userIdInvited, $groupIdTobeInvitedTo);

     $result = $conn->query($checkIfUserHasBeenInvitedSql);

     if($result->num_rows == 0)
     {
        return false;
     }
     else
     {
        return true;
     }

     $conn->close();

  }


  public function checkIfUserExistsByEmail($emailId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $checkUserExistsByEmailSql = "SELECT * FROM user WHERE Email = '$emailId'";

    $checkUserByEmail = $conn->query($checkUserExistsByEmailSql);

    if($checkUserByEmail->num_rows == 0)
    {
      return false;
    }
    else{
      return true;
    }
    $conn-close();

  }


  public function checkIfUserExistsByUsername($username)
  {

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();


    $checkUserName = "SELECT * FROM user WHERE UserName = '$username'";

    $checkUserByUserName = $conn->query($checkUserName);

    return $checkUserByUserName->num_rows;

  }


  function checkUserLiked($messageId, $userId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();

    $checkUserLikedQuery = "SELECT * FROM userLikes WHERE message_id = '$messageId' AND userId = '$userId' AND reactionId= 1";

    $checkUserLiked_res = $conn->query($checkUserLikedQuery);

    if($checkUserLiked_res->num_rows == 0)
    {
      return false;
    }
    else if ($checkUserLiked_res->num_rows > 0)
    {
      return true;
    }

    $conn->close();

  }

  public function getUserIdFromUserEmail($userEmail)
  {
      $database_connection = new DatabaseConnection();
      $conn = $database_connection->getConnection();

      $getUserIdFromEmailSql = "SELECT ID FROM user WHERE Email = '$userEmail'";

      $result = $conn->query($getUserIdFromEmailSql)->fetch_object()->ID;

      $conn->close();
      return $result;

  }



  function checkUserDisliked($messageId, $userId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();

    $checkUserLikedQuery = "SELECT * FROM userLikes WHERE message_id = '$messageId' AND userId = '$userId' AND reactionId= 0";

    $checkUserLiked_res = $conn->query($checkUserLikedQuery);

    if($checkUserLiked_res->num_rows == 0)
    {
      return false;
    }
    else if ($checkUserLiked_res->num_rows > 0)
    {
      return true;
    }




  }


  function checkIfGroupExists($groupName){

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();

    $checkIfUserExistsSql = $sql_service->checkIfGroupExistsSql($groupName);

    $result = $conn->query($checkIfUserExistsSql);

    $resultCount = $result->num_rows;


    $conn->close();
    
    return $resultCount;




  }

  function getGroupIdFromName($groupName)
  {
     $database_connection = new DatabaseConnection();
     $conn = $database_connection->getConnection();

     $sql_service = new LoginSqlService();

     $getGroupIdFromNameSql = $sql_service->getGroupIdFromNameSql($groupName);


     $result = $conn->query($getGroupIdFromNameSql)->fetch_object()->groupId;

    $conn->close();

    return $result;
  }


  function getRatingCount ($messageId)
  {

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();

    $likes_Query = "SELECT * FROM userLikes WHERE message_id = '$messageId' AND reactionId = '1'";

    $dislikes_Query = "SELECT * FROM userLikes WHERE message_id = '$messageId' AND reactionId = '0'";
    $likes = "empty";
    $dislikes = "empty";

    $likes_rs = $conn->query($likes_Query);
    $dislikes_rs = $conn->query($dislikes_Query);

    $likes = $likes_rs->num_rows;
    $dislikes = $dislikes_rs->num_rows;

    $rating = $likes . "/" . $dislikes;
    return $rating;
}


  public function recordDislike($messageId, $userId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $reactionId = "empty";

    $sql_service = new LoginSqlService();
    $recordDislikeSql = $sql_service->recordDislikeSql($messageId, $userId);

    $result = $conn->query($recordDislikeSql);
    $conn->close();

  }

  public function deleteLike($messageId, $userId)
  {
     $database_connection = new DatabaseConnection();
     $conn = $database_connection->getConnection();

     $sql_service = new LoginSqlService();
     $deleteLikeSql = $sql_service->unlikePost($userId,$messageId);

     $result = $conn->query($deleteLikeSql);
     $conn->close();
  }

  public function recordLikes($messageId, $userId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $reactionId = "empty";

    $sql_service = new LoginSqlService();
    $recordLikesSql = $sql_service->recordLikesSql($messageId, $userId);

    $result = $conn->query($recordLikesSql);
    $conn->close();

  }

  public function insertNewUser($FirstName, $LastName, $username, $email, $password)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $InsertNewUserSql = $sql_service->insertNewUserSql($FirstName, $LastName, $username, $email, $password);

    $result = $conn->query($InsertNewUserSql);
    
    
  }


  public function getLikes($messageId, $userId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $reactionId = 'empty';

    $sql_service = new LoginSqlService();
    $getLikesSql = $sql_service->getLikesSql($messageId, $userId);

     $result = $conn->query($getLikesSql);

    while($row = $result->fetch_assoc()) {

      $reactionId = $row['reactionId'];


    }

    $conn->close();
    return $reactionId;

  }

  public function getGroupPosts($groupId)
  {
   
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $getAllPosts = $sql_service->getPostByGroup($groupId);

    $result = $conn->query($getAllPosts);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
              if(!isset($_SESSION))
              {
                  session_start();
              }

               $data['messages'][]=$row;

              // $_SESSION['groupMessageId']=$row['messageId'];
              // $_SESSION['groupMessage'] = $row['message'];
              // $_SESSION['groupMessageUserId'] = $row['UserId'];
              // $_SESSION['groupTimeOfPost'] = $row['TimeOfPost'];
              //  $_SESSION['groupLikeCount'] = $row['likeCount'];
              // $array[]= $_SESSION;

        }

       
        return json_encode($data);

    }

  }


  public function getComments($messageId)
  {
        $database_connection = new DatabaseConnection();
        $conn = $database_connection->getConnection();

        $sql_service = new LoginSqlService();
        $messageIdSql = $sql_service->getComments($messageId);

        $result = $conn->query($messageIdSql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
              if(!isset($_SESSION))
              {
                  session_start();
              }
              $data['comments'][]=$row;
              // $_SESSION['commentId']=$row['commentId'];
              // $_SESSION['comment'] = $row['comment'];
              // $_SESSION['commentUserId'] = $row['commentUserId'];
              // $_SESSION['timeOfComment'] = $row['timeOfComent'];
              // $_SESSION['parentMessageId'] = $row['parent_messageId'];
              
              //$array[]= $_SESSION;

        }

       
        return json_encode($data);

    }


  }

  public function createNewGroup($groupName, $type, $groupOwnerId)
  {
   
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
   
    $sql_service = new LoginSqlService();
   

    $createNewGroupSql = $sql_service->createNewGroupSql($groupName, $type, $groupOwnerId);

    $result = $conn->query($createNewGroupSql);

    $conn->close();


  }



  public function getAllPublicGroups()
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();

    $getAllPublicGroupsSql = $sql_service->getAllPublicGroupsSql();
    $result = $conn->query($getAllPublicGroupsSql);
   
    if($result->num_rows > 0)

    {
    
    while($row = $result->fetch_assoc()){
    
        $_SESSION['publicGroupId'] = $row['groupId'];
        $_SESSION['publicGroupName'] = $row['groupName'];
        $_SESSION['publicOwnerUserId'] = $row['ownerUserId'];
        $_SESSION['publicCreatedAt'] = $row['created_at'];
        $_SESSION['publicGroupStatus'] = $row['status'];

        $array[]= $_SESSION; 
    }
     $conn->close();
     return $array;




    }

  }


  public function addCommentToDB($commentInput, $userId, $parentMessageId, $conn)
  {
    $sql_service = new LoginSqlService();

    $addCommentsSQL = $sql_service->addCommentsSQL($commentInput, $userId, $parentMessageId);

    $result = $conn->query($addCommentsSQL);

    $conn->close();

  }




  public function updateUpAndDownVotes($messageId, $userId, $conn, $upAndDownVotes)
  {

      //$ratingCount = getRatingCount($messageId);
      $likeCount = explode('/', $upAndDownVotes);

     

     $sql_service = new LoginSqlService();

     $updateUpAndDownVotesSql = $sql_service->updateUpAndDownVotesSql($messageId, $likeCount[0], $likeCount[1]);

     $result = $conn->query($updateUpAndDownVotesSql);
     $conn->close();

  }

  public function decrementLike($messageId, $userId, $conn)
  {

    $sql_service = new LoginSqlService();

    $decrementLikeSql = $sql_service->decrementLikeSql($messageId);

    $result = $conn->query($decrementLikeSql);

    $conn ->close();

  }

  public function incrementDislike($messageId, $userId, $conn)
  {

    $sql_service = new LoginSqlService();

    $incrementDislikeSql = $sql_service->incrementDislikeSql($messageId);

    $result = $conn->query($incrementDislikeSql);

    $conn ->close();
  
  }


  public function decrementDislike($messageId, $userId, $conn)
  {

        $sql_service = new LoginSqlService();

        $decrementDislikeSql = $sql_service->decrementDislikeSql($messageId);

        $result = $conn->query($decrementDislikeSql);

        $conn ->close();

  }




  public function getUserGroups($userId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $sql_service = new LoginSqlService();
    $userGroupsSql = $sql_service->getGroupsForUser($userId);
    $result = $conn->query($userGroupsSql);
    
    if ($result->num_rows > 0) {

           while($row = $result->fetch_assoc()){

            // $_SESSION['GroupId'] = $row['groupId']; 
             $array[] = $row['groupId'];
           }
             $conn->close();
             return $array;

    }
 

  }


  public function buildProfilePage($userId){

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();

    $userInformationSql = $sql_service->getUserById($userId);
    $result = $conn->query($userInformationSql);

     if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
             
             if(!isset($_SESSION)){

                session_start();
              }
              
              $_SESSION['ProfilePfirstName']=$row['FirstName'];
              $_SESSION['ProfilePlName'] = $row['LastName'];
              $_SESSION['ProfilePemail'] = $row['Email'];
              $_SESSION['ProfilePpicture'] = $row['ProfilePicture'];
              $_SESSION['ProfileUserName'] = $row['UserName'];
              $array[]= $_SESSION; 

        }

        $conn->close();
        return $array;
     }

  }


  public function getGroupName($groupId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $groupNameSql = $sql_service->getGroupNamesSQL($groupId);

    $result = $conn->query($groupNameSql);

    if($result->num_rows > 0)
    {
          while($row = $result->fetch_assoc()){

            $groupName = $row['groupName'];

          }
          
          $conn->close();
          return $groupName;

    }




  }


  public function paginationData($startFrom, $postPerPage, $groupId)
  {

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $paginationSql = $sql_service->paginationSql($startFrom, $postPerPage, $groupId);

    $result = $conn->query($paginationSql);

     if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

          $data['messages'][] = $row;
        }


        return json_encode($data);

     }




  }


  public function getGroupByGroupId($groupId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $groupNameSql = $sql_service->getGroupNamesSQL($groupId);

    $result = $conn->query($groupNameSql);

    while($row = $result->fetch_assoc()){

        $_SESSION['ProfilePGroupName'] = $row['groupName'];
        $_SESSION['ProfilePGroupType'] = $row['type'];
        
        $array[]= $_SESSION; 
    
    }
    
    $conn->close();
    return $array;


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

  public function writeGroupPostToDB($userId, $message, $groupId)
  {

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $writeGroupPostToDB = $sql_service->groupPostToDbSQL($userId, $message, $groupId);

    $result = $conn->query($writeGroupPostToDB);

    $conn->close();

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
              
              $data['commenter'][] = $row; 
              // $_SESSION['PostFirstName']=$row['FirstName'];
              // $_SESSION['PostLastName'] = $row['LastName'];
              // $_SESSION['EachMessageUserId'] = $row['ID'];
              // $_SESSION['ProfilePicture'] = $row['ProfilePicture'];
              
             

              //$array[]= $_SESSION; 


        }

        $conn->close();
        return json_encode($data);


     }


  }

  public function deleteGroupInvitation($userId, $groupId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();

    $deleteGroupInvitationSql = $sql_service->deleteGroupInvitationSql($groupId, $userId);

    $result = $conn->query($deleteGroupInvitationSql);

  }



  public function getLikeCountFromUserLikesTable($messageId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $getLikeCountFrmLikeTable = $sql_service->getLikeCountFrmLikeTableSql($messageId); 

    $result = $conn->query($getLikeCountFrmLikeTable);

    if($result->num_rows > 0)
    {
      $likes = $result->num_rows;
      return $likes;
    }
    else
    {
      return '0';
    }

    $conn->close();
    return $likes;


  }

  public function addUserToGroup($groupId, $userId)
  {

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $addUserToGroupSql = $sql_service->addUserToGroupSql($groupId, $userId);

    $result = $conn->query($addUserToGroupSql);

    $conn->close();



  }

  public function getAllUsers()
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $getAllUserIdsSql = $sql_service->getAllUserIdSqls();
    
    $result = $conn->query($getAllUserIdsSql);
    
    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
             
             if(!isset($_SESSION)){

                session_start();
              }
              
              $_SESSION['userIdAvail']=$row['ID'];
              $_SESSION['EmailAvail']=$row['Email'];
              $_SESSION['UserTypeAvail'] = $row['type'];
              $array[]= $_SESSION; 


      }

        $conn->close();
        return $array;


     }


  }


  public function getAllGroups()
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    
    $sql_service = new LoginSqlService();
    $getAllGroupsSql = $sql_service->getAllExistingGroupsSql();

    $result = $conn->query($getAllGroupsSql);

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc()) {
             
             if(!isset($_SESSION)){

                session_start();
              }
              
              $_SESSION['ownedGroupName']=$row['groupName'];
              $_SESSION['ownedGroupId'] = $row['groupId'];
              $_SESSION['ownedCreatedAt'] = $row['created_at'];
              $_SESSION['ownedStatus'] = $row['status'];
              $_SESSION['ownedType'] = $row['type'];

              $array[]= $_SESSION; 


      }

        $conn->close();
        return $array;


    }
    else 
    {
      echo "noGroupsOwned";
    }

  }

  public function getOwnedGroups($userId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $getOwnedGroupsSql = $sql_service->getOwnedGroupsSql($userId);

    $result = $conn->query($getOwnedGroupsSql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
             
             if(!isset($_SESSION)){

                session_start();
              }
              
              $_SESSION['ownedGroupName']=$row['groupName'];
              $_SESSION['ownedGroupId'] = $row['groupId'];
              $_SESSION['ownedCreatedAt'] = $row['created_at'];
              $_SESSION['ownedType'] = $row['type'];

              $array[]= $_SESSION; 


      }

        $conn->close();
        return $array;


     }
      else
      {
        return "noGroupsOwned";
      }

  }


  public function removeUserFromGroup($groupId, $userId)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $getLikeCountForMesSql = $sql_service->removeUserFromGroupSql($groupId, $userId);

    $result = $conn ->query($getLikeCountForMesSql);

    $conn->close();


  }


  public function getLikeCountFromMes($messageId){

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $getLikeCountForMesSql = $sql_service->getLikeCountForMes($messageId);
   
    $result = $conn->query($getLikeCountForMesSql)->fetch_object()->likeCount;

    
    $conn->close();
    return $result;

  }

  public function getNumberOfPosts($groupId)
  {   

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $sql_service = new LoginSqlService();
    $getAllPosts = $sql_service->getPostCount($groupId);

    $result = $conn->query($getAllPosts);

    return $result->num_rows;

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

              $data['messages'][]=$row;
              /*$data['message'] = $row['message'];
              $data['MessageUserId'] = $row['UserId'];
              $data['TimeOfPost'] = $row['TimeOfPost'];
              $data['likeCount'] = $row['likeCount'];*/
              

        }

        $conn->close();
        return json_encode($data);

    }

  }

}






?>