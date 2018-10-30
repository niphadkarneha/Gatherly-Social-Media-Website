<?php

if(isset($_GET['Id']))
{
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  session_start();
  include_once "./server/loginService.php";
  //include_once "./server/loginSQL.php";
  //include_once "./server/connect.php";
  $userId = $_GET['Id'];

  $loginWebService = new LoginWebService();
  
  $profileInformation = $loginWebService->buildProfilePage($userId);

  if (empty($profileInformation))
  {
  	echo "<h1>User does not exist </h1>";
  }
  else
  {
  	//var_dump($profileInformation);
  	

  	echo "<html>";
	echo "<head>";
	echo "<title>Profile Page</title>";
	echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
	echo "<meta charset='utf-8'>";
	echo "<link rel='stylesheet' type='text/css' href='profilepage.css'>";
	echo "<link rel='stylesheet' type='text/css' href='avatar.css'>";
	echo "<script src='profilepage.js'></script>";
	echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>";
	echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
	echo "</head>";
echo "<body>";

	echo "<div class = 'formDiv'>";
		echo "<div class =''>";
		echo "<a href='mainpage.php'><i class='fa fa-arrow-left arrowLeft' aria-hidden='true' style = 'margin-top: 3%;'></i></a>";
		
	     if($profileInformation[0]['ProfilePpicture'] == "")
		{
			echo "<h2 style='margin-top: -3%;'>Welcome" . " " . $profileInformation[0]['ProfilePfirstName'] . " " . "<img src='avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>" . "</h2>";
		}
		else
		{
			echo "<h2 style='margin-top: -3%;'>Welcome" . " " . $profileInformation[0]['ProfilePfirstName'] . " " . "<img src='" . $profileInformation[0]['ProfilePpicture'] . " alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>" . "</h2>";
		}
	  
	  
	  
	  
	  //echo "<h2 style='margin-top: -3%;'>Welcome" . " " . $profileInformation[0]['ProfilePfirstName'] . " " . "<img src= " . $profileInformation[0]['ProfilePpicture'] . " alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>" . "</h2>";
		//echo "<img src= " . $profileInformation[0]['ProfilePpicture'] . " alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
		//echo "</h2>";
	echo "</div>";
		echo "<div class='container' style = 'height:100%; width:95%;'>";
		echo "<div class = 'leftside' style='float:left;width: 70%;'>";
			//echo "<label><p>Email id:" . $profileInformation[0]['ProfilePemail'] . "</p><br>";
			echo "<label><p>First Name: " . $profileInformation[0]['ProfilePfirstName']  . "</p><br>";
			echo "<label><p>Last Name : " . $profileInformation[0]['ProfilePlName'] . " </p><br>";
			echo "<label><p>Username  : " . $profileInformation[0]['UserName'] . "</p><br>";
			echo "<label><p>Email id  : " . $profileInformation[0]['ProfilePemail'] . "</p><br>";
			echo "<label><p>Public Channel membership:</p><br>";
			$loginWebService = new LoginWebService();

			$userGroupIds = $loginWebService->getUserGroups($userId);

			if(empty($userGroupIds))
			{
				echo "<h3>User is not part of any groups</h3>";
			}
			else
			{
				foreach($userGroupIds as $i => $item) {
					
					$getGroupInfo = $loginWebService->getGroupByGroupId($userGroupIds[$i]);
					if($getGroupInfo[0]['ProfilePGroupType'] == "public"){
						echo "<li>" . $getGroupInfo[0]['ProfilePGroupName'] . "</li>";
					}



				}
			}

			echo "</div>";
			echo "<div class = 'userRating'></div>";
 echo "</div>";

echo "<div class='clearfix'>";  
echo "</div>";
echo "</div>";

echo "</div>";
echo "</body>";
echo "</html>";












  }







}




?>

