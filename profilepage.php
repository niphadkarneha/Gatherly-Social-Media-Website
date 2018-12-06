<?php

if(isset($_GET['Id']))
{
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  session_start();
  include_once "./server/loginService.php";

  $userId = $_GET['Id'];

  $loginWebService = new LoginWebService();
 
  $profileInformation = $loginWebService->buildProfilePage($userId);

  if (empty($profileInformation))
  {
  	echo "<h1>User does not exist </h1>";
  }
  else
  {

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
		$loginWebService = new LoginWebService();
		$url = $loginWebService -> get_gravatar($profileInformation[0]['ProfilePemail']);
	    
	    if($profileInformation[0]['profileDisplayPic'] == "1")
		{

			echo "<h2 style='margin-top: -3%;'>Welcome" . " " . $profileInformation[0]['ProfilePfirstName'] . " " . "<img src='" . $url . "' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>" . "</h2>";

		}
		else if($profileInformation[0]['profileDisplayPic'] == "2")
		{

			echo "<h2 style='margin-top: -3%;'>Welcome" . " " . $profileInformation[0]['ProfilePfirstName'] . " " . "<img src='avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>" . "</h2>";

		}
		else
		{
			if( $profileInformation[0]['ProfilePpicture'] == ""){

              echo "<h2 style='margin-top: -3%;'>Welcome" . " " . $profileInformation[0]['ProfilePfirstName'] . " " . "<img src='avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>" . "</h2>";
            }
            else{
           	 
           	 echo "<h2 style='margin-top: -3%;'>Welcome" . " " . $profileInformation[0]['ProfilePfirstName'] . " " . "<img src='" . $profileInformation[0]['ProfilePpicture'] . "' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>" . "</h2>";

            }

		}
	  
	echo "</div>";
		echo "<div class='container' style = 'height:100%; width:95%;'>";
		echo "<div class = 'leftside' style='float:left;width: 70%;'>";
			//echo "<label><p>Email id:" . $profileInformation[0]['ProfilePemail'] . "</p><br>";
			echo "<label><p>First Name: " . $profileInformation[0]['ProfilePfirstName']  . "</p><br>";
			echo "<label><p>Last Name : " . $profileInformation[0]['ProfilePlName'] . " </p><br>";
			echo "<label><p>Username  : " . $profileInformation[0]['UserName'] . "</p><br>";
			echo "<label><p>Email id  : " . $profileInformation[0]['ProfilePemail'] . "</p><br>";
			echo "<label><p>Public Channel membership:</p><br>";

            
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
 			echo "<div style='margin-top: -18px;' id = 'userRatings'>";
 			//echo "<h1> User Ratings</h1>";
 			
 			$reactionCount = $loginWebService->getAllLikesByUser($userId);
 			$reactionScore = (($reactionCount/20)*100);
 			
 			if($reactionScore > 100)
 			{
 				$reactionScore = 100;
 			}
			
			$postCount = $loginWebService->getPostCountByUser($userId);
 			$postScore = (($postCount/25)*100);
 			
 			if($postScore > 100)
 			{
 				$postScore = 100;
 			}
 			
 		    $groupCount = $loginWebService->getGroupCountbyUser($userId);
 			$groupScore = (($groupCount/10)*100);
 			
 			if($groupScore > 100)
 			{
 				$groupScore = 100;
 			}

 			$overallScore = round((($reactionScore + $postScore + $groupScore)/3));
 			echo "<h3><b>" .  $profileInformation[0]['ProfilePfirstName'] . "'s Stats</b></h3>";
 			
 			echo "<h4>Overall Rating</h4>";

			echo "<span><div class='ratings'>";
			echo "<div class='empty-stars'></div>";
			echo "<div class='full-stars' style='width:$overallScore%'></div>";
			echo "</div>&nbsp $overallScore%</span></br>";

 			echo "<h4>Reactions Rating</h4>";

			echo "<span><div class='ratings'>";
			echo "<div class='empty-stars'></div>";
			echo "<div class='full-stars' style='width:$reactionScore%'></div>";
			echo "</div>&nbsp $reactionScore%</span></br>";
 			

 			echo "<h4>Posts Rating</h4>";

			echo "<span><div class='ratings'>";
			echo "<div class='empty-stars'></div>";
			echo "<div class='full-stars' style='width:$postScore%'></div>";
			echo "</div>&nbsp $postScore%</span></br>";



 			echo "<h4>Groups Rating</h4>";

			echo "<span><div class='ratings'>";
			echo "<div class='empty-stars'></div>";
			echo "<div class='full-stars' style='width:$groupScore%'></div>";
			echo "</div>&nbsp $groupScore%</span></br>";



 			
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

<!DOCTYPE html>
<html>
<head>
	<title></title>
<style type="text/css">
.ratings {
  position: relative;
  vertical-align: middle;
  display: inline-block;
  color: #b1b1b1;
  overflow: hidden;
}

.full-stars{
  position: absolute;
  left: 0;
  top: 0;
  white-space: nowrap;
  overflow: hidden;
  color: #fde16d;
}

.empty-stars:before,
.full-stars:before {
  content: "\2605\2605\2605\2605\2605";
  font-size: 14pt;
}

.empty-stars:before {
  -webkit-text-stroke: 1px #848484;
}

.full-stars:before {
  -webkit-text-stroke: 1px orange;
}
</style>
</head>
<body>

</body>
</html>