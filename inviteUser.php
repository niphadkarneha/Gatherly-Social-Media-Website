<?php

  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  session_start();
  include_once "./server/loginService.php";
  include_once "./server/loginSQL.php";
  include_once "./server/connect.php";

  function clean_input($data) {
    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  
  }

  $theUserId = $_SESSION['UserId'];

  if(isset($_POST['addUserToGroup']))
  {


  	$database_connection = new DatabaseConnection();
  	$conn = $database_connection->getConnection();
  	$loginWebService = new LoginWebService();

  	$groupId = clean_input($_POST['groupIdAccepted']);
  	$groupId = mysqli_real_escape_string($conn, $groupId);

  	$userId = $_SESSION['UserId'];

  	$loginWebService->addUserToGroup($groupId, $userId);

  	$loginWebService->deleteGroupInvitation($userId, $groupId);



  }


  if(isset($_POST['groupIdDeclined']))
  {

  	$database_connection = new DatabaseConnection();
  	$conn = $database_connection->getConnection();
  	$loginWebService = new LoginWebService();
	
	$groupId = clean_input($_POST['groupIdDeclined']);
  	$groupId = mysqli_real_escape_string($conn, $groupId);

  	

  	$loginWebService->deleteGroupInvitation($theUserId, $groupId);




  }


  if(isset($_POST['userEmailToBeInvited']))
  {
		
		
	$database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $loginWebService = new LoginWebService();
	

	$userEmailToBeInvited =  clean_input($_POST['userEmailToBeInvited']);
	$userEmailToBeInvited = mysqli_real_escape_string($conn, $userEmailToBeInvited);

	$groupIdTobeInvitedTo = clean_input($_POST['groupIdInvitedTo']);
	$groupIdTobeInvitedTo = mysqli_real_escape_string($conn, $groupIdTobeInvitedTo);



    $isValidUser = $loginWebService->checkIfUserExistsByEmail($userEmailToBeInvited);

    if($isValidUser == false)
    {
    	echo "InvalidEmailId";
    	die();
    }
    //check if user is already in the group
    else
    {
    	
  		
  		$userIdInvited = $loginWebService->getUserIdFromUserEmail($userEmailToBeInvited);
  		$checkIfUserIsInGroup = $loginWebService->checkIfUserIsInGroup($userIdInvited, $groupIdTobeInvitedTo);

  		$checkIfUserHasBeenInvited = $loginWebService->checkIfUserHasBeenInvited($userIdInvited, $groupIdTobeInvitedTo);

  		if (($checkIfUserIsInGroup == false) && ($checkIfUserHasBeenInvited == false) )
  		{
  		    $loginWebService->sendInvitationToUser($groupIdTobeInvitedTo, $userIdInvited);
  		    echo "success";
  		}
  		else 
  		{
  			echo "InvalidInput";
  			die();

  		}




    }


  }


?>







