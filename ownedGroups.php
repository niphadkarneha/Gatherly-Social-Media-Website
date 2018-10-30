<!DOCTYPE html>
	<html>
	 <head>
		<title>Group Invitation</title>
			<meta name='viewport' content='width=device-width, initial-scale=1'>
			<meta charset='utf-8'>
			<link rel='stylesheet' type='text/css' href='profilepage.css'>
			<link rel='stylesheet' type='text/css' href='avatar.css'>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script src="profilepage.js"></script>
			<script src="script.js"></script>
			<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
			 <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>


			 <style type="text/css">
	
#myInputTwo {
  background-image: url('/css/searchicon.png');
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#myUL li a {
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color: black;
  display: block
}

#myUL li a:hover:not(.header) {
  background-color: #eee;
}


</style>
	</head>
<body>

<div class = 'formDiv'>
		
		<?php

			ini_set('display_startup_errors', 1);
            ini_set('display_errors', 1);
            error_reporting(-1);
            include_once "./server/loginService.php";
            include_once "./server/loginSQL.php";
			
           	if (isset($_POST['groupNameOwned']))
           	{

           		if(!session_start())
           		{
           			session_start();
           		}

           		$_SESSION['groupNameOwned'] = $_POST['groupNameOwned'];
           		$_SESSION['groupIdOwned'] = $_POST['groupIdOwned'];
           		$_SESSION['ownerOfGroup'] = $_POST['ownerOfGroup'];
				$_SESSION['groupTypeOwned'] = $_POST['groupTypeOwned'];




           	}


				$groupName = $_SESSION['groupNameOwned'];
				$groupId = $_SESSION['groupIdOwned'];
				$groupType = $_SESSION['groupTypeOwned'];
			
				$userId = $_SESSION['ownerOfGroup'];

           		$groupName = $_SESSION['groupNameOwned'];
     

			if ($groupType == 'private')
			{

				echo "<div class =''>";
				echo "<a href='mainpage.php'><i class='fa fa-arrow-left arrowLeft' aria-hidden='true' style = 'margin-top: 3%;'></i></a>";
				echo "<h2 style='margin-top: -3%;'> Private Group Invitation </h2>";
				echo "<form id = 'inviteUserForum'>";
				echo "<input type='hidden' id='ownerUserId' value = '" . $userId . "' </input>";
				echo "<input type='hidden' id='groupIdInvitedTo' value = '" . $groupId . "'</input>";
			    echo "<input type='text' id='myInputTwo' onkeyup='myFunctionTwo()' placeholder='Search for Users' title='Type in a name'><button class = 'inviteUserButton' >Invite User to Group</button><br/>";

							echo "<h4> Invite non-member Users to private " . " " . $groupName .  " " ." group. </h4>";

						    $loginWebService = new loginWebService();
							$listOfUsers = $loginWebService -> getAllUsers();
							
							

							if(!empty($listOfUsers))
				      		{
				      			 
				 				 
				 				
				       			echo  "<ul id='myUL'>";
				         		foreach($listOfUsers as $i => $item) {
				 						
				         			$userIsInGroup = $loginWebService->checkIfUserIsInGroup($listOfUsers[$i]['userIdAvail'], $groupId);
									
				         			if($userIsInGroup == false)
				         			{
				         				 
										echo "<li><a id = 'groupNameDisplay' href='#'>" .  $listOfUsers[$i]['EmailAvail']  . "</a></li>";

										
				         			}
									
				         			
									
				       		    }
								echo "</ul>";
				     		}
							
				     		echo "</form>";


			}
			else if ($groupType == 'public')
			{

				echo "<div class =''>";
				echo "<a href='mainpage.php'><i class='fa fa-arrow-left arrowLeft' aria-hidden='true' style = 'margin-top: 3%;'></i></a>";
				echo "<h2 style='margin-top: -3%;'> Public Group Invitation </h2>";
				       
						echo "<form id = 'inviteUserForum'>";
						echo "<input type='hidden' id='ownerUserId' value = '" . $userId . "' </input>";
						echo "<input type='hidden' id='groupIdInvitedTo' value = '" . $groupId . "'</input>";
				       echo "<input type='text' id='myInputTwo' onkeyup='myFunctionTwo()' placeholder='Search for public group names..' title='Type in a name'><button class = 'inviteUserButton' >Infive group</button><br/>";

							echo "<h4> Invite non-member Users to public " . " " . $groupName .  " " ." group. </h4>";

						    $loginWebService = new loginWebService();
							$listOfUsers = $loginWebService -> getAllUsers();
							
							
       
							if(!empty($listOfUsers))
				      		{
				      			
				 				 
				 				
				       			echo  "<ul id='myUL'>";
				         		foreach($listOfUsers as $i => $item) {
				 						
				         			$userIsInGroup = $loginWebService->checkIfUserIsInGroup($listOfUsers[$i]['userIdAvail'], $groupId);
									
				         			if($userIsInGroup == false)
				         			{
				         				 
										echo "<li><a id = 'groupNameDisplay' href='#'>" .  $listOfUsers[$i]['EmailAvail']  . "</a></li>";

										
				         			}
									
				         			
									
				       		    }
								echo "</ul>";
				     		}
							
				     		echo "</form>";



			}

		?>

	</div>
		<div class='container' style = 'height:100%; width:95%;'>
		<div class = 'leftside' style='float:left;width: 70%;'>
			
 		
<div class='clearfix'>  
</div>
</div>

</div>


<script type="text/javascript">
	
      function myFunctionTwo() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInputTwo");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}






</script>

</body>



</html>
