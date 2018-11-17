<?php

// if(isset($_POST['groupNameAdmin']))
// {
// 	$groupId = $_POST['groupNameAdmin'];









// }

?>

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
<a href='mainpage.php'><i class='fa fa-arrow-left arrowLeft' aria-hidden='true' style = 'margin-top: 3%;'></i></a>
<div class = 'formDiv'>
		
		<?php

			ini_set('display_startup_errors', 1);
            ini_set('display_errors', 1);
            error_reporting(-1);
            include_once "./server/loginService.php";
            include_once "./server/loginSQL.php";
			
			 $groupId = "";
			if(isset($_POST['groupNameAdmin']))
			 {
				$groupId = $_POST['groupNameAdmin'];

			 }




			echo "<div style = 'float: left;' class =''>";
				
				echo "<h2 style='margin-top: -3%;'> Add Users</h2>";
				echo "<form id = 'adminAddUserForm'>";
				echo "<input id = 'groupIdAdminAdd' type = 'hidden' value = '" . $groupId . "'>";
			    echo "<input type='text' id='addUserAdmin' onkeyup='myFunctionTwo()' placeholder='Search for public group names..' title='Type in a name'><button class = 'addUserAdminButton' >Add User to group</button><br/>";

							echo "<h4> Invite non-member Users to group. </h4>";
							$loginWebService = new loginWebService();
							$listOfUsers = $loginWebService -> getAllUsers();

							if(!empty($listOfUsers))
				      		{
				      			 
				 				 
				 				
				       			echo  "<ul id='myUL'>";
				         		foreach($listOfUsers as $i => $item) {
				 						
				         			$userIsInGroup = $loginWebService->checkIfUserIsInGroup($listOfUsers[$i]['userIdAvail'], $groupId);
									
				         			if($userIsInGroup == false && $listOfUsers[$i]['UserTypeAvail'] != 1)
				         			{
											echo "<li><a id = 'adminAddUserDisplay' href='#'>" .  $listOfUsers[$i]['EmailAvail']  . "</a></li>";
											echo "<input id = 'userIdToAdd' type = 'hidden' value = '" . $listOfUsers[$i]['userIdAvail'] . "'>";								
				         			}
									
				         			
									
				       		    }
								echo "</ul>";
				     		}
							
				     		echo "</form>";

		    echo "</div>"; 


		    echo "<div style = 'float: left;' class =''>";
				
				echo "<h2 style='margin-top: -3%;'> Remove Users</h2>";
				echo "<form id = 'adminRemoveMemberForum'>";
				echo "<input id = 'groupIdAdminRemove' type = 'hidden' value = '" . $groupId . "'>";
			    echo "<input type='text' id='removeUserAdmin' onkeyup='myFunctionThree()' placeholder='Search for users' title='Type in a name'><button class = 'removeUserAdminButton' >Remove User from group</button><br/>";

							echo "<h4> Remove group member from group</h4>";
							$loginWebService = new loginWebService();
							$listOfUsers = $loginWebService -> getAllUsers();

							if(!empty($listOfUsers))
				      		{
				      			 
				 				 
				 				
				       			echo  "<ul id='myULTwo'>";
				         		foreach($listOfUsers as $i => $item) {
				 						
				         			$userIsInGroup = $loginWebService->checkIfUserIsInGroup($listOfUsers[$i]['userIdAvail'], $groupId);
									
				         			if($userIsInGroup == true && $listOfUsers[$i]['UserTypeAvail'] != 1)
				         			{
											echo "<li><a id = 'adminRemoveUserDisplay' href='#'>" .  $listOfUsers[$i]['EmailAvail']  . "</a></li>";
											echo "<input id = 'userIdToRemove' type = 'hidden' value = '" . $listOfUsers[$i]['userIdAvail'] . "'>";								
				         			}
									
				         			
									
				       		    }
								echo "</ul>";
				     		}
							
				     		echo "</form>";

		    echo "</div>"; 

















		  //   	echo "<div style = 'float: right;' class =''>";
			
				// echo "<h2 style='margin-top: -3%;'> Remove Users from group </h2>";
				// echo "<form id = 'removeGroupMember'>";

			 //    echo "<input type='text' id='' onkeyup='myFunctionTwo()' placeholder='Search for Users' title='Type in a name'><button class = 'removeGroupMemberButton' >Remove user from group</button><br/>";

				// 			echo "<h4> remove users from group. </h4>";
     
		  //   echo "</div>";

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
        input = document.getElementById("addUserAdmin");
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

      function myFunctionThree() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("removeUserAdmin");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myULTwo");
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
