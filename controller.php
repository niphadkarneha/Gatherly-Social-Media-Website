<?php
 
 include_once "loginService.php";
 include_once "loginSQL.php";
    
 function clean_input($data) {
    
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  
 }

 if(isset($_POST['displayMessages']))
 {
 	 if(!isset($_SESSION))
       {
           session_start();
       }

      $userId = $_SESSION['UserId'];

      $loginWebService = new LoginWebService();

      $login = $loginWebService -> getAllGlobalPosts();

      echo $login;

 }



 if(isset($_POST['lockGroup']))
 {
    $groupId = $_POST['groupId'];
    $loginWebService = new LoginWebService();
    
    $loginWebService -> lockGroup($groupId);



 }

 if(isset($_POST['unlockGroup']))
 {
    $groupId = $_POST['groupId'];
    $loginWebService = new LoginWebService();

    $loginWebService -> unlockGroup($groupId);

 }

 if(isset($_POST['deleteMessage']))
 {

    if(!isset($_SESSION))
    {
      session_start();
    }

    $messageId = $_POST['messageId'];
    $loginWebService = new LoginWebService();

    $loginWebService -> deleteMessage($messageId);
    
  }


if(isset($_POST['getAllGroups']))
{
     $loginWebService = new LoginWebService();

     $allGroups = $loginWebService ->getAllExistingGroups();

     echo $allGroups;

}



 if(isset($_POST['getUserType']))
 {

    if(!isset($_SESSION))
    {
      session_start();
    }

    echo $_SESSION['userType'];

 }

 if(isset($_POST['addGroupMessage']))
 {
    if(!isset($_SESSION))
    {
       session_start();
    }

    $userId = $_SESSION['UserId'];


    $loginWebService = new LoginWebService();
    
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();

    $message = clean_input($_POST['groupMessagePost']);
    $message = mysqli_real_escape_string($conn, $message);

    $groupId = $_POST['groupId'];


    $loginWebService -> writeGroupPostToDB($userId, $message, $groupId);

    $latestPost = $loginWebService -> getLatestPost($userId, $groupId);

    $conn->close();
    
    echo $latestPost;




 }


 if(isset($_POST['pagination_data']))
 {

    $recordPerPage = 5;
    $page = "";
    $output = "";

    if(isset($_POST['page']))
    {
      $page = $_POST['page'];
    }
    else
    {
      $page = 1;
    }

    $groupId = $_POST['groupId'];

    $page = $page + 1;
    $startFrom = ($page - 1) * $recordPerPage;
   
    $loginWebService = new LoginWebService();
    
    $pageData = $loginWebService -> paginationData($startFrom, $recordPerPage, $groupId);

    //$totalRecords = $loginWebService -> getNumberOfPosts(3);

    //$totalPages = ceil($totalRecords/$recordPerPage);
    echo $pageData;

    //echo "page : " . $page . "data: " . $pageData;

 }



 if(isset($_POST['getPosterDetails']))
 {
 	  if(!isset($_SESSION))
       {
           session_start();
       }
 	 
 	 //$userId = $_SESSION['UserId'];
 	 $posterUserId = $_POST['posterUserId'];
 	 $loginWebService = new LoginWebService();

      $posterDetails = $loginWebService -> getPosterDetails($posterUserId);

      echo $posterDetails;

 }


 if(isset($_POST['getNumGlobalPosts']))
 {

     $loginWebService = new LoginWebService();
    
     $totalRecords = $loginWebService -> getNumberOfPosts(3);

     $totalPages = ceil($totalRecords/5);

     echo $totalPages;
 }


 if(isset($_POST['checkIfUserLiked']))
 {
       	$loginWebService = new LoginWebService();

       	$messageId = $_POST['messageId'];

      	if(!isset($_SESSION))
       	{
       		session_start();
       	}

       	$userId = $_SESSION['UserId'];

      	$userLiked = $loginWebService->checkUserLiked($messageId, $userId);
      	$userDisliked = $loginWebService->checkUserDisliked($messageId, $userId);


      	echo $userLiked . "/" . $userDisliked;


 }

   if(isset($_POST['getComments']))
   {
   
      $loginWebService = new LoginWebService();

      $messageId = $_POST['messageId'];

      $comments = $loginWebService->getComments($messageId);

      echo $comments;


   }


 if(isset($_POST['getLikeDislike']))
{
    	$messageId = $_POST['messageId'];

    	echo $messageId;
}


if(isset($_POST['getCommenterDetails']))
 {

       $loginWebService = new LoginWebService();

       $commenterUserId = $_POST['commenterUserId'];

       $getCommenterDetails = $loginWebService -> getPosterDetails($commenterUserId);

       echo $getCommenterDetails;

}



if(isset($_POST['postMessage']))
{ 

      if(!session_start())
      {
        session_start();
      }

      if(isset($_SESSION['UserId']))
      {
          $loginWebService = new LoginWebService();
          $database_connection = new DatabaseConnection();
          $conn = $database_connection->getConnection();
          $userId = $_SESSION['UserId'];
          $groupId = '3';    
          $uncleanedMessage = clean_input($_POST['postMessage']);           
          $uncleanedMessage =  mysqli_real_escape_string($conn, $uncleanedMessage);
          $login = $loginWebService -> writePostToDB($userId, $uncleanedMessage);
          
          $latestPost = $loginWebService -> getLatestPost($userId, $groupId);

          echo $latestPost; 
      }

 }
  

if(isset($_POST['displayGroupMessages']))
{

   $loginWebService = new LoginWebService();
   $database_connection = new DatabaseConnection();
   $conn = $database_connection->getConnection();

   $groupId = $_POST['groupId'];

   $groupMessages = $loginWebService -> getGroupPosts($groupId);

   echo $groupMessages;


}

if(isset($_POST['getGroupInfo']))
{
   $loginWebService = new LoginWebService();

   $groupId = $_POST['groupId'];

   $groupInfo = $loginWebService -> getGroupInfo($groupId);

   echo $groupInfo;
}


if(isset($_POST['getGroupName']))
{

  $loginWebService = new LoginWebService();
  $database_connection = new DatabaseConnection();

  $groupId = $_POST['groupId'];

  $groupInfo = $loginWebService -> getGroupName($groupId);

  echo $groupInfo;




}   





	
?>