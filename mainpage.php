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
if(!isset($_SESSION['UserId']))
  {
    header('Location: ./index.php');
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $loginWebService = new LoginWebService();
    if(isset($_POST['postMessage']))
      { 
        if($_POST['postMessage'] == "")
        {
            echo " <script>
                  var txt;
                  var r = confirm('Posts cannot be empty, Please try again.');
                  if(r==true || r==false)
                  {
                    window.location.href = 'mainpage.php'; 
                  }
                 </script>
          ";
        }
        else
        {
          if(isset($_SESSION['UserId']))
        {
             $userId = $_SESSION['UserId'];
            
             $uncleanedMessage = clean_input($_POST['postMessage']);  
           
             $uncleanedMessage =  mysqli_real_escape_string($conn, $uncleanedMessage);
               $login = $loginWebService -> writePostToDB($userId, $uncleanedMessage);
               echo "<script> window.location.href ='mainpage.php'</script>";
        }
        }
      }
    $likedByUserId = "empty";
    $messageIdLiked = "empty";
    $dislikedByUserId = "empty";
    $messageIdDisliked = "empty";
    $conn->close();
    
  }
?>



<!DOCTYPE html>
<html>
<title>Gatherly</title>
<head>
  <link rel="shortcut icon" type="image/jpg" href="icons/g.jpg">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="script.js"></script>
  <script src="mainPage.js"></script>
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif, background-color:#e6ffff}
.material-icons {vertical-align:-14%}
.fa {
    font-size: 30px;
    cursor: pointer;
    user-select: none;
}
.fa:hover {
  color: darkblue;
}
div.a {
    text-indent: 70px;
    border-left: 6px solid red;
    background-color: lightgrey;
}
form, table {
     display:inline;
     margin:0px;
     padding:0px;
}
.footer
{
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #23b4ff;
    color: white;
    text-align: center;
}
*{
  box-sizing:border-box;
}
body{
  background-color:#dfeaef;
  font-family:Arial;
}
#container{
  width:750px;
  height:800px;
  background:#eff3f7;
  margin:0 auto;
  font-size:0;
  border-radius:5px;
  overflow:hidden;
}
main{
  width:490px;
  height:800px;
  display:inline-block;
  font-size:15px;
  vertical-align:top;
}
h2,h3{
  margin:0;
}
.status{
  width:8px;
  height:8px;
  border-radius:50%;
  display:inline-block;
  margin-right:7px;
}
.green{
  background-color:#58b666;
}
.orange{
  background-color:#ff725d;
}
.blue{
  background-color:#6fbced;
  margin-right:0;
  margin-left:7px;
}
main header{
  height:110px;
  padding:30px 20px 30px 40px;
}
main header > *{
  display:inline-block;
  vertical-align:top;
}
main header img:first-child{
  border-radius:50%;
}
main header img:last-child{
  width:24px;
  margin-top:8px;
}
main header div{
  margin-left:10px;
  margin-right:145px;
}
main header h2{
  font-size:16px;
  margin-bottom:5px;
}
main header h3{
  font-size:14px;
  font-weight:normal;
  color:#7e818a;
}
#chat{
  padding-left:0;
  margin:0;
  list-style-type:none;
  overflow-y:scroll;
  height:535px;
  border-top:2px solid #fff;
  border-bottom:2px solid #fff;
}
#chat li{
  padding:10px 30px;
}
#chat h2,#chat h3{
  display:inline-block;
  font-size:13px;
  font-weight:normal;
}
#chat h3{
  color:#bbb;
}
#chat .entete{
  margin-bottom:5px;
}
#chat .message{
  padding:20px;
  color:#fff;
  line-height:25px;
  max-width:90%;
  display:inline-block;
  text-align:left;
  border-radius:5px;
}
#chat .me{
  text-align:right;
}
#chat .you .message{
  background-color:#58b666;
}
#chat .me .message{
  background-color:#6fbced;
}
#chat .triangle{
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 0 10px 10px 10px;
}
#chat .you .triangle{
    border-color: transparent transparent #58b666 transparent;
    margin-left:15px;
}
#chat .me .triangle{
    border-color: transparent transparent #6fbced transparent;
    margin-left:375px;
}
main footer{
  height:155px;
  padding:20px 30px 10px 20px;
}
main footer textarea{
  resize:none;
  border:none;
  display:block;
  width:100%;
  height:80px;
  border-radius:3px;
  padding:20px;
  font-size:13px;
  margin-bottom:13px;
}
main footer textarea::placeholder{
  color:#ddd;
}
main footer img{
  height:30px;
  cursor:pointer;
}
main footer a{
  text-decoration:none;
  text-transform:uppercase;
  font-weight:bold;
  color:#6fbced;
  vertical-align:top;
  margin-left:333px;
  margin-top:5px;
  display:inline-block;
}
* {
  box-sizing: border-box;
}
#myInput {
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

#welcomeMessage {
    position: absolute;
    width: 700px;
    left: 30%;
    margin-top: -5px;
}


</style>
<body class="w3-theme-15", background-color="#e6ffff">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Gatherly</a>
  <a href= <?php  if(!isset($_SESSION)){session_start(); } echo "profilepage.php?Id=" . $_SESSION['UserId'];?> button class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" onclick="openForm()" title="My Account"><i class="fa fa-user"></i>Welcome<?php  if(!isset($_SESSION)){session_start(); } echo " " . $_SESSION['FirstName'] . "!";?></a>
  <div class="pull-right">

    <div id = "welcomeMessage">
      
    </div>



  <form method="POST" action="server/logout.php">
    <a  href="server/logout.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d3 pull-right" type="submit" class="btn navbar-btn btn-danger" name="logout" id="logout"  value="Log Out"><i class="fa fa-sign-out w3-margin-right"></i>Log Out</a> 

  </form>
</div>
  </div>
 </div>
</div>


<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1300px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-user fa-fw w3-margin-right"></i>Profile Picture</button>
          <div id="Demo1" class="w3-hide w3-container">
            <form action = "upload.php" method="POST" enctype="multipart/form-data">
              <label><input type='file' name="image" accept=".png, .jpg, .jpeg"/></label>
              <button name = "submit" type="submit">Upload your profile picture</button>
              </form>
           </div> 
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Groups</button>
          <div id="Demo2" class="w3-hide w3-container">
            <h3>Groups you belong</h3>
            <ul>

      <?php 
            ini_set('display_startup_errors', 1);
            ini_set('display_errors', 1);
            error_reporting(-1);
            include_once "./server/loginService.php";
            include_once "./server/loginSQL.php";
            if(!isset($_SESSION)){
                session_start();
              }
              
              $userID  = $_SESSION['UserId'];
              $MyloginWebService = new LoginWebService();
              $userGroupIds = $MyloginWebService -> getUserGroups($userID);
              
              //checks if the user is logged in, if the user is logged in then a user id exists, if not redirect to login page
              if (!isset($userID))
              {
                 header("Location: index.php");
                 die();
              }
              
              //displaying the groups the user is part of
             
              $count = count($userGroupIds);
              $i = 0;
               echo "<button onclick='globalClicked()' class='w3-button w3-block w3-theme-l1 w3-left-align'>Global</button> </br>";
           
              if(!empty($userGroupIds))
              {
                  while($i != $count)
                  {
                
                        $groupName = $MyloginWebService ->getGroupName($userGroupIds[$i]);
                        $_SESSION['groupIdClicked' . $i] = $userGroupIds[$i];
                
                        echo "<form >";
                        echo "<input type='hidden' id='groupName' name='groupName' value='$userGroupIds[$i]'>";
                        echo "<button type='submit'  name='action' class='w3-button w3-block w3-theme-l1 w3-left-align groupsPage'>" . $groupName . "</button> </br>";
                        echo "</form>";
              // echo $userGroupIds[$i];
                        $i = $i + 1;
              }
              }
              
              $allPublicGroups = $MyloginWebService -> getAllPublicGroups();
      ?>
            

            </ul>
          </div>
      <button onclick="myFunction('joinAgroup')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>Join public groups</button>
        <div id = "joinAgroup" class="w3-hide w3-container">
         
         <h3> Enter Group Name</h3>

         <form id = 'joinAgroupForum'>
                <?php      
              
              if(!empty($allPublicGroups))
              {
              echo "<input type='text' id='myInput' onkeyup='myFunctionTwo()' placeholder='Search for public group names..' title='Type in a name'><button class = 'joinGroupBtn' >Join Group</button><br/>";
              
              echo  "<ul id='myUL'>";
                
                foreach($allPublicGroups as $i => $item) {
                     echo "<li><a id = 'groupNameDisplay' href='#'>" .  $allPublicGroups[$i]['publicGroupName'] . "</a></li>";
               
                }
              echo "</ul>";
              }
              else {
              echo "<input type='text' id='myInput' onkeyup='myFunctionTwo()' placeholder='Search for public group names..' title='Type in a name'><button class = 'joinGroupBtn'>Join Group</button><br/>";
                echo  "<ul id='myUL'>";
                echo "<h6 id = 'therearenocomentsLabel' >There a no public groups available. Create one!</h6>";
                echo "</ul>";
              }
             
                 ?>

              

         </form>

        </div>

<button onclick="myFunction('ownedGroupsDiv')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-balance-scale fa-fw w3-margin-right"></i>Owned Groups</button>

          <div id = "ownedGroupsDiv" class="w3-hide w3-container">
                <?php
                if(!isset($_SESSION))
                {
                     session_start();
                }
                $userId = $_SESSION['UserId'];
                $groupsOwned = $MyloginWebService->getOwnedGroups($userId );
               // var_dump($groupsOwned);
                echo "<br/>";
                if($groupsOwned == "noGroupsOwned")
                {
                  echo "<h6> You do not own any groups. Please create your own groups to invite your friends.";
                }
                else
                {
                    $x = 0;
                    $y = 0;
                    $z = 0;
                    
                    foreach($groupsOwned as $i => $item) {
                     echo "<form method='post' action='ownedGroups.php'>";
                     echo "<input type = 'hidden' id='" . $z . "' name= 'ownerOfGroup' value = '" . $userId . "'</input>";
                     echo "<input type='hidden' id='" . $x . "' name='groupNameOwned' value='" . $groupsOwned[$i]['ownedGroupName'] . "'>";
                     echo "<input type='hidden' id='" . $y . "' name='groupTypeOwned' value='" . $groupsOwned[$i]['ownedType'] . "'>";
                echo "<input type='hidden' id='" . $groupsOwned[$i]['ownedGroupName'] . "' name='groupIdOwned' value='" . $groupsOwned[$i]['ownedGroupId'] . "'>";
                     echo "<button type='submit'  name='action' class='w3-button w3-block w3-theme-l1 w3-left-align'>" . $groupsOwned[$i]['ownedGroupName']. "</button> </br>";
                    echo "</form>";
                    $x = $x + 1;
                    $y = $y + 1;
                    $z = $z + 1;
                    }
                    
                }
                
                ?>


          </div>

          <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>Create a group</button>
          <div id="Demo3" class="w3-hide w3-container">
            <div class="modal fade" id="createChannel" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Create a new group</h4>
                <h6>Share a message, picture, story anything you like with your group.</h6>
              </div>
              <div class="modal-body newChannelDetails">
          <form role="form" id="createChannelForm">
              <div class="row">
                  <div class="form-group">
                    <div class="uniqueChannel"></div>
                    <form>
                    <input type="text" id="groupNameToBeCreated" name="Groupname" placeholder="Group Name"><br>
                    </form>
                  </div>
              </div>
              <div class="row">
                <span class="type">Group style</span>
                <div id = 'publicPrivateDiv' class="form-group">
                  <label class="radio-inline">
                      <input type="radio" id = 'privateGroup' name="type" value="private" checked>Private
                    </label>
                    <label class="radio-inline">
                      <input type="radio" id = 'publicGroup' name="type" value="public">Public
                    </label>
                </div>
            </div>
<!--               <div class="row">
                  <div class="form-group">
                    <span class='invites'>Invite your friends</span>
                     <input type="text" name="emailid/username" placeholder="emailid/username"><br>
                    <div class="channelInvites">
                    </div>
                  </div>
              </div> -->

               <div class="modal-footer">
               <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-default createChannelBtn" data-dismiss="modal">Create Group</button>
              </div>
        </form>
              </div>

            </div>
          </div>
      </div>

          </div>
          
           <button onclick="myFunction('Demo4')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>My Invitations</button>

          <div id="Demo4"class="w3-hide w3-container">

          <?php 
            //1.query for all the user invites the user has gotten
              $loginWebService = new LoginWebService();
              //$userGroupIds = $MyloginWebService -> getUserGroups($userID);
              $groupIdInvitations = $loginWebService -> getListOfInvitesbyUserId($userId);
              if(!empty($groupIdInvitations))
              {
              foreach($groupIdInvitations as $x => $item) {
            echo "<div style=' border: 1px solid; padding: 10px; box-shadow: 5px 10px #888888; ' class='w3-container'>";
    
        echo "<center><p>Group Invitation request</p></center>";
        echo "<center><b><p>Group Name: " . $loginWebService->getGroupName($groupIdInvitations[$x]['groupIdInvitation']) . "</p></b></center>";
     
        echo " <div class='w3-row w3-opacity'>";
               echo "<div class='w3-half'>";
                echo "<form id = '" . $groupIdInvitations[$x]['inviteId'] . "' >";
                    echo "<input id='groupIdInvitation' type='hidden' value = '" . $groupIdInvitations[$x]['groupIdInvitation'] . "' </input>";
                    echo "<button type = 'submit' class='w3-button w3-block w3-green w3-section acceptButton' title='Accept'><i class='fa fa-check'></i></button>";
                echo "</form>";
               echo "</div>";   
               echo "<div class='w3-half'>";
                  echo "<form id = '" . $groupIdInvitations[$x]['inviteId'] . "' <br/>";
                    echo "<input id = 'groupIdInvitation' type='hidden' value = '" . $groupIdInvitations[$x]['groupIdInvitation'] . "' </input>";
                    echo "<button type = 'submit' class='w3-button w3-block w3-red w3-section declineButton' title='Decline'><i class='fa fa-remove'></i></button>";
                  echo "</form>";
               echo "</div>";
        echo "</div>";
    echo "</div>";
              }
              }else
              {
                echo "<h6> You do not have any invitations. </h6>";
              }
                //var_dump($groupIdInvitations); 
            //2.get the group name invitation from the group id from the invites table
            //3.
          ?>


          <!-- <p>Sally Carrera invited you to be part of Group A</p>
          <button type="button">Accept</button>
          <button type="button">Reject</button> -->



          </div>
          <br>
          <button onclick="myFunction('Demo5')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-picture-o fa-fw w3-margin-right"></i>My Photos</button>
          <div id="Demo5" class="w3-hide w3-container">
            <img src="icons/g.jpg" alt="Trulli" width="250" height="250">
          </div>
        </div>      
      </div>
      <br>
      
    <!-- End Left Column -->
    </div>
  
    <!-- Middle Column -->
    <div class="w3-col m7">
    
     <div id = 'globalPostForum'> 
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
     <h6 class='w3-opacity'>Share something with the world</h6>         
    

     <form >
     <input type='text' id='postMessage' name='postMessage' placeholder='Whats on your mind' contenteditable='true' class='w3-border w3-padding'>
     <button id = 'postButton' name='postTheMessage' type='submit' class='w3-button w3-theme postMessage'><i class='fa fa-pencil'></i>Post</button>
     </form>
  </div>  

     </div>
     </div>
     </div>
     </div>


     <div id = 'groupPostForum'>




     </div>


     <div class="allPostsClass" id = "allPosts">


     </div>


     <div class = "groupPostsClass" id = "groupPosts">
     </div>

 <?php  
  //     include_once "./server/loginService.php";
  //     include_once "./server/loginSQL.php";
    
  //     if(!isset($_SESSION))
  //      {
  //          session_start();
  //      }
  //     $userId = $_SESSION['UserId'];
  //     $loginWebService = new LoginWebService();
  //     $login = $loginWebService -> getAllGlobalPosts();
  //     $var = 1;
      
      
  //     if(!empty($login))
  //     {
       
  //        foreach($login as $i => $item) {
       
  //        echo "<div id = 'globalPosts' class='w3-container w3-card w3-white w3-round w3-margin'><br>";
                         
  //                         $getPosterDetails = $loginWebService -> getPosterDetails($login[$i]['MessageUserId']);
  //                         $getLikeInformation = $loginWebService-> getLikes($login[$i]['messageId'], $userId);
  //                         $likeCount = $loginWebService->getRatingCount($login[$i]['messageId']);
  //                         $userLiked = $loginWebService->checkUserLiked($login[$i]['messageId'], $userId);
  //                         $userDisliked = $loginWebService->checkUserDisliked($login[$i]['messageId'], $userId);
  //                         $comments = $loginWebService->getComments($login[$i]['messageId']);
  //                         $reactions = explode("/", $likeCount);
  //                       // echo "<h1> reaction id: " . $getLikeInformation;
  //                       // var_dump($getPosterDetails);
                         
                            
  //                              if ($getPosterDetails[0]['ProfilePicture'] == ""){
                                
  //                               echo "<img src = 'avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
  //                              }
  //                              else{
  //                                echo "<img src = '" . $getPosterDetails[0]['ProfilePicture'] . "' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
  //                              }
                              
  //                              echo "<span class='w3-right w3-opacity'>" . $login[$i]['TimeOfPost'] . "</span>";
  //                              echo "<h4>" . $getPosterDetails[0]['PostFirstName'] . " " . $getPosterDetails[0]['PostLastName'] . "</h4><br>";
  //                              echo "<p>" . $login[$i]['message'] ."</p>";
                        
  //                              if($userLiked == true)
  //                               {
                   
  //                                  echo "<i class='fa fa-thumbs-up like-btn likeOrDislike' data-id=" . $login[$i]['messageId'] ."></i>";
  //                                  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  //                                  echo "<i class='fa fa-thumbs-o-down dislike-btn likeOrDislike' data-id=" . $login[$i]['messageId'] ."></i>";
  //                               }
                     
  //                               else if($userDisliked == true)
  //                              {
  //                                   if($reactions[0] == '0')
  //                                   {
  //                                     echo "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id=" . $login[$i]['messageId'] ."></i>";
                          
  //                                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                       
  //                                     echo "<i class='fa fa-thumbs-down dislike-btn likeOrDislike' data-id=" . $login[$i]['messageId'] ."></i>";
  //                                   }
  //                                 else
  //                                 {
             
  //                                     echo "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id=" . $login[$i]['messageId'] ."></i>";
                   
  //                                     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  //                                     echo "<i class='fa fa-thumbs-down dislike-btn likeOrDislike' data-id=" . $login[$i]['messageId'] ."></i>";
  //                                 }
  //                              }
  //                             else
  //                              {
  //                                echo "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id=" . $login[$i]['messageId'] ."></i>";
               
  //                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  //                                echo "<i class='fa fa-thumbs-o-down dislike-btn likeOrDislike' data-id=" . $login[$i]['messageId'] ."></i>";
  //                              }
                        
  //                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  //                                echo "<span class='likes'>" . "Likes: " . $reactions[0] . "</span>";
  //                                echo "<span class='dislikes'>" . " Dislikes: " . $reactions[1] . "</span>";
  //                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  //                               // echo "<button onclick= myFunction('Chat') class='w3-button w3-white w3-border w3-border-white'><i class='material-icons'>chat</i></button>";
  //                                echo "<button onclick= myFunction('". $login[$i]['messageId'] ."') class='w3-button w3-white w3-border w3-border-white'><i class='material-icons'>filter_list</i></button>";
                      
  //                                if(!empty($comments))
  //                                {  
  //                                echo "<div  id='" . $login[$i]['messageId'] . "' class='w3-hide w3-container'>";
                      
  //                                 foreach($comments as $j => $items) {
  //                                    $getCommenterDetails = $loginWebService -> getPosterDetails($comments[$j]['commentUserId']);
                       
  //                                    //echo "<br/>";
  //                                    echo "<div class='a'>";
                                           
  //                                          echo "<aside>";
                                              
  //                                             if($getCommenterDetails[0]['ProfilePicture'] == "")
  //                                             {
  //                                                 echo "<aside><img src='avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'></aside>";
  //                                             }
  //                                             else
  //                                             {
  //                                               echo "<aside><img src=". $getCommenterDetails[0]['ProfilePicture'] . " alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'></aside>";
  //                                             }
  //                                              echo "<h6>" . $getCommenterDetails[0]['PostFirstName'] . " " . $getCommenterDetails[0]['PostLastName'] . "</h6>";
  //                                              echo "<p>" . $comments[$j]['comment'] . "</p>";
  //                                          echo "</aside>";
  //                                    echo "</div>";
                        
  //                                 }
                              
  //                               echo "</div>";
                       
  //                      // echo "</div>";
                        
                        
  //                                echo "<form id " . $login[$i]['messageId'] . "  > ";
                                     
  //                        //   echo "<div id = 'commentInputs'>";
  //                                    //echo "<span value = '" . $login[$i]['FirstName'] . "' />";
  //                                    echo "<aside><input name =" . $login[$i]['MessageUserId'] . " placeholder='Type your comment'> </input>" ;
  //                                    //echo  " " . "<button class='commentButton data-id = '" .  $login[$i]['messageId'] . "' type = 'submit'>Comment</button> </aside>";
  //                                    echo  " " . "<button class='commentButton' value = '" .  $login[$i]['messageId'] . "' type = 'submit'>Comment</button> </aside>";
  //                                echo "</form>";
                        
  //                       //  echo "</div>";
  //                        //echo "</div>";
  //                        echo "</div>";
  //                }
  //                else
  //                {
  //                       echo "<div id='" . $login[$i]['messageId'] . "' class='w3-hide w3-container'>";
  //                           echo "<div class='b'>";
                       
  //                           echo "<p class = 'nocommentclass'>no comments</p>";
                            
  //                           echo "<form id =  '" . $login[$i]['messageId'] . "'  > ";
                      
  //                        //   echo "<div id = 'commentInputs'>";
                      
  //                                    echo "<aside><input name =" . $login[$i]['MessageUserId'] . " placeholder='Type your comment'> </input>" ;
  //                                    //echo  " " . "<button class='commentButton data-id = '" .  $login[$i]['messageId'] . "' type = 'submit'>Comment</button> </aside>";
  //                                    echo  " " . "<button class='commentButton' value = '" .  $login[$i]['messageId'] . "' type = 'submit'>Comment</button> </aside>";
  //                                echo "</form>";
                        
  //                            //  echo "<form id " . $login[$i]['messageId'] . "  > ";
  //                            // // echo "<form id = 'commentFrom'>";
                       
  //                            //  //     echo "<div id = 'commentInputs'>";
                      
  //                            //          echo "<aside><input placeholder='Type your comment'> </input>" . " " . "<button class='commentButton data-id = '" .  $login[$i]['messageId'] . "'' type = 'submit'>Comment</button> </aside>";
  //                            //    //   echo " </div>";
                       
  //                            //  echo "</form>";
                     
                
  //                         echo "</div>";
  //                         echo "</div>";
  //                         echo "</div>";
              
  //                }
  //                     //echo " </div>";
                       
  //                    }
                   
  //                  //  echo "</div";
  //                 }
 
  // else{
  //       echo "<h1>no posts to be displayed.<h1>";
  //    }
  //      //echo "</div>";
  //  //echo  "</div>";
  ?> 
<div class="w3-col m2">
  <div id="Chat" class="w3-hide w3-container">
  <main>
    <header>
      </header>
      
     <!--  </li> -->
    <!-- </ul> -->
    <footer>
      <textarea placeholder="Type your message"></textarea>
      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_picture.png" alt="">
      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_file.png" alt="">
      <a href="#">Send</a>
    </footer>
  </main>
</div>
</div>
</div>

<br>



<!-- Footer -->
<div class="footer">
 <!--  <p>&copy;fordFanatics</p> -->
</div>

<script>
      function myFunction(id) {
          var x = document.getElementById(id);
          if (x.className.indexOf("w3-show") == -1) {
              x.className += " w3-show";
              x.previousElementSibling.className += " w3-theme-d1";
          } else { 
              x.className = x.className.replace("w3-show", "");
              x.previousElementSibling.className = 
              x.previousElementSibling.className.replace(" w3-theme-d1", "");
          }
      }
      function myFunctionTwo() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
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
// Used to toggle the menu on smaller screens when clicking on the menu button
    function openNav() {
        var x = document.getElementById("navDemo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else { 
            x.className = x.className.replace(" w3-show", "");
        }
    }
    function otherGroupsClicked(){
    var x = document.getElementById("AllGlobalPosts");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
    }
    function globalClicked(){
    location.href = "mainpage.php";
    }
    function likeDislike(x) {
        
        x.classList.toggle("fa-thumbs-down");
    }
    function dislikeClicked(){
      var dislicekButtonClicked = document.getElementById("messageid").value;
      document.getElementById(dislicekButtonClicked).disabled = true;
    }
</script>
 
</body>
</html> 