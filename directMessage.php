<?php
if(isset($_POST['userIdTosendTo']))
{
	  ini_set('display_startup_errors', 1);
	  ini_set('display_errors', 1);
	  error_reporting(-1);
	  
	  include_once "./server/loginService.php";
	  
	  $userIdSendTo = $_POST['userIdTosendTo'];
	  
	  if(!session_start())
	  {
	  	session_start();
	  }
	  $userIdFrom = $_SESSION['UserId'];


	  $loginWebService = new LoginWebService();
	  
	  $posterInfo = json_decode($loginWebService->getUserInfo($userIdFrom), true);
	  $recieverInfo = json_decode($loginWebService->getUserInfo($userIdSendTo), true);
	  // echo "<h1>send message to " . $recieverInfo['userInfo'][0]['FirstName'] . "</h1>";
	  echo "<div class='topnav'>";
 	  echo "<a class='active' href='mainpage.php'>Back</a>";
 	  echo "<h2 style = 'color: white; margin-top: auto; margin-bottom: auto;'><center> " . $recieverInfo['userInfo'][0]['FirstName'] . " " . $recieverInfo['userInfo'][0]['LastName'] . "</center></h2>";
	  echo "</div>";


	  $directMessages = $loginWebService->getDirectMessages($userIdFrom, $userIdSendTo);

	  $directMessages = json_decode($directMessages, true);
	  
	   if(!empty($directMessages))
       {
       	echo "<div class = 'allDirectMessages DivWithScroll DivToScroll'>";

          foreach($directMessages as $i => $item) {
          	$posterDetails = json_decode($loginWebService->getPosterDetails($directMessages[$i]['fromUserId']), true);
        	
        	if($posterDetails['commenter'][0]['ID'] == $userIdFrom)
        	{
        		echo "<div class='container' style = ' color: white; background-color: rgb(8, 127, 254); float: right; width: 50%; margin-left: 25%;'>";
        	}  	
        	else
        	{
        		echo "<div class='container' style = ' float: left; width: 50%; margin-left: 0%;'>";
        	}

          	
          	if($posterDetails['commenter'][0]['displayPic'] == '0')
          	{
          		if($posterDetails['commenter'][0]['ProfilePicture'] == "")
          		{
          			echo "	<img src='avatar.jpg' alt='Avatar' style='width:90px'>";
          		}
          		else
          		{
          			echo "	<img src='" . $posterDetails['commenter'][0]['ProfilePicture'] . "' alt='Avatar' style='width:90px'>";
          		}
          		
          	}
          	else if($posterDetails['commenter'][0]['displayPic'] == '1')
          	{
          		$url = $loginWebService->get_gravatar($posterDetails['commenter'][0]['Email']);
          		echo "	<img src='" . $url . "' alt='Avatar' style='width:90px'>";
          	}
          	else
          	{
          		echo "	<img src='avatar.jpg' alt='Avatar' style='width:90px'>";
          	}
  			
  			echo "	<p><span>" . $posterDetails['commenter'][0]['FirstName'] . " " . $posterDetails['commenter'][0]['LastName'] . "</span></p>";
  			echo "	<p>" . $directMessages[$i]['message'] . "</p>";
			echo "</div>";

          }
            echo "</div>";
          	echo "<form>";
    		echo "<input type = 'hidden' value = '" . $userIdFrom . "' id = 'directMessageFrom'/>"; 
    		echo "<input type = 'hidden' value = '" . $userIdSendTo . "' id = 'directMessageSentTo'/>"; 
    		echo "<input type = 'hidden' value = '" . $posterInfo['userInfo'][0]['FirstName'] . "' id = 'senderFirstName'/>";
    		echo "<input type = 'hidden' value = '" . $posterInfo['userInfo'][0]['LastName'] . "' id = 'senderLastName'/>"; 
    		echo "<input type = 'hidden' value = '" . $posterInfo['userInfo'][0]['ProfilePicture'] . "' id = 'senderProfilePicture'/>";
    		echo "<input type = 'hidden' value = '" . $posterInfo['userInfo'][0]['displayPic'] . "' id = 'senderDisplayPic'/>"; 
    		echo "<input type = 'hidden' value = '" . $posterInfo['userInfo'][0]['Email'] . "' id = 'senderEmail'/>"; 
    		echo "<input style='width: 52%; margin-left: 25%;' type='text' id='directMessageSent' name='directMessageSent' placeholder='Send Direct Message'>";
    		echo "<input class = 'sendDirectMessageButton' style='width: 52%; margin-left: 25%;' type='submit' value='Send'>";
  			echo "</form>";

  			

       }
       else
       {
       		echo "<div class = 'allDirectMessages DivWithScroll DivToScroll'>";

            echo "</div>";
          	echo "<form>";
    		echo "<input type = 'hidden' value = '" . $userIdFrom . "' id = 'directMessageFrom'/>"; 
    		echo "<input type = 'hidden' value = '" . $userIdSendTo . "' id = 'directMessageSentTo'/>"; 
    		echo "<input type = 'hidden' value = '" . $posterInfo['userInfo'][0]['FirstName'] . "' id = 'senderFirstName'/>";
    		echo "<input type = 'hidden' value = '" . $posterInfo['userInfo'][0]['LastName'] . "' id = 'senderLastName'/>"; 
    		echo "<input type = 'hidden' value = '" . $posterInfo['userInfo'][0]['ProfilePicture'] . "' id = 'senderProfilePicture'/>";
    		echo "<input type = 'hidden' value = '" . $posterInfo['userInfo'][0]['displayPic'] . "' id = 'senderDisplayPic'/>"; 
    		echo "<input type = 'hidden' value = '" . $posterInfo['userInfo'][0]['Email'] . "' id = 'senderEmail'/>"; 
    		echo "<input style='width: 52%; margin-left: 25%;' type='text' id='directMessageSent' name='directMessageSent' placeholder='Send Direct Message'>";
    		echo "<input class = 'sendDirectMessageButton' style='width: 52%; margin-left: 25%;' type='submit' value='Send'>";
  			echo "</form>";

  			













       }


}
else
{
	header("location: mainpage.php");
}


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>

input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 10px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.DivToScroll{   
    background-color: mintcream;
    border-radius: 4px 0 4px 0;
    
}

.DivWithScroll{
    height:797px;
    overflow:scroll;
    overflow-x:hidden;
    margin-left: 476px;
    margin-right: 437px;
}

.topnav {
  overflow: hidden;
  background-color: #333;
  margin-left: 25%;
  margin-right: 23%;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}


.container {
  border: 2px solid #ccc;
  background-color: #eee;
  border-radius: 5px;
  padding: 16px;
  margin: 16px 0
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  margin-right: 20px;
  border-radius: 50%;
}

.container span {
  font-size: 20px;
  margin-right: 15px;
}

@media (max-width: 500px) {
  .container {
      text-align: center;
  }
  .container img {
      margin: auto;
      float: none;
      display: block;
  }
}
</style>

<script type="text/javascript">

var entityMap = {
  '&': '&amp;',
  '<': '&lt;',
  '>': '&gt;',
  '"': '&quot;',
  "'": '&#39;',
  '/': '&#x2F;',
  '`': '&#x60;',
  '=': '&#x3D;'
};


function escapeHtml (string) {
  return String(string).replace(/[&<>"'`=\/]/g, function (s) {
    return entityMap[s];
  });
}

$(document).on('click', '.sendDirectMessageButton', function(e) {
	 
	 e.preventDefault();
	 var directMessageFrom = document.getElementById("directMessageFrom").value;
 	 var directMessageTo = escapeHtml(document.getElementById("directMessageSentTo").value);
 	 var directMessage = escapeHtml(document.getElementById("directMessageSent").value);
 	 var senderFirstName = escapeHtml(document.getElementById("senderFirstName").value);
 	 var senderLastName = escapeHtml(document.getElementById("senderLastName").value);   
 	 var senderProfilePicture = escapeHtml(document.getElementById("senderProfilePicture").value);
 	 var senderDisplayPic = escapeHtml(document.getElementById("senderDisplayPic").value);
 	 var senderEmail = escapeHtml(document.getElementById("senderEmail").value);

	 $.ajax({

	  url : 'server/controller.php',
	  type : 'POST',
	  async: false,
	  data : {
	  	'directMessageFrom' : directMessageFrom,
	  	'directMessageTo' : directMessageTo,
	  	'directMessage' : directMessage,
	  	'sendDirectMessage': 'sendDirectMessage'
	  },  
	  success : function(data) {   
	  	

        		var str = "<div class='container' style = ' color: white; background-color: rgb(8, 127, 254); float: right; width: 50%; margin-left: 25%;'>";
        	  	
          	if(senderDisplayPic == '0')
          	{
          		if(senderProfilePicture == "")
          		{
          			str += "	<img src='avatar.jpg' alt='Avatar' style='width:90px'>";
          		}
          		else
          		{
          			str += "	<img src='" + senderProfilePicture + "' alt='Avatar' style='width:90px'>";
          		}
          		
          	}
          	else if(senderDisplayPic == '1')
          	{
  		        $.ajax({

                    url : 'server/controller.php',
                    type : 'POST',
                    async: false,
                    data : {
                       'getGravatar' : 'getGravatar',
                       'userEmail' :senderEmail
                    },  
                    success : function(data) {   
                      str += "	<img src='" + data + "' alt='Avatar' style='width:90px'>";
                    }
                }); 

          	}
          	else
          	{
          		str += "<img src='avatar.jpg' alt='Avatar' style='width:90px'>";
          	}
  			
  			str += "	<p><span>" + senderFirstName + " " + senderLastName + "</span></p>";
  			str += "	<p>" + directMessage + "</p>";
			str += "</div>";
			console.log(str);
			$('.allDirectMessages').append(str);
	    
	  }
	}); 


});



</script>




</head>
<body style = "background: lightblue;">
	

</body>

</html>