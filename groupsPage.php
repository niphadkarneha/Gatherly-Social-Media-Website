<?php 
  
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  session_start();
  include_once "./server/loginService.php";
  include_once "./server/loginSQL.php";
  //echo "it is here";
  $loginWebService = new LoginWebService();

              //start of group post request
     
    function clean_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
    
     return $data;
  
   }

    if(!isset($_SESSION))
    {
           session_start();
    }

    $userId = $_SESSION['UserId'];


     if(isset($_POST['groupName']))
      {
        $_SESSION['groupIdInSession'] = $_POST['groupName'];
        $groupId = $_SESSION['groupIdInSession'];
        $loginWebService = new LoginWebService();

        $userIsInGroup = $loginWebService->checkIfUserIsInGroup($userId, $groupId);

        if($userIsInGroup == false)
        {
          header("Location: mainpage.php");
          die();
        }




     }
      else if (isset($_GET['groupId']))
      {
         //echo "it is in groupid get request";
       $groupId = my_simple_crypt($_GET['groupId'], 'd');

        $loginWebService = new LoginWebService();

        $userIsInGroup = $loginWebService->checkIfUserIsInGroup($userId, $groupId);

        if($userIsInGroup == false)
        {
          header("Location: mainpage.php");
          die();
        }


      }





  if(isset($_POST['groupPost']))
  {

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $loginWebService = new LoginWebService();
        
      if($_POST['groupPost'] == "")
        {
       $groupId = $_POST['groupId'];
             //echo "user id: " . $userId;
       $encryptedGroupId = my_simple_crypt($groupId, 'e');
            echo " <script>
                  var txt;
                  var r = confirm('Posts cannot be empty, Please try again.');
                  if(r==true || r==false)
                  {
                    window.location.href = '../groupsPage.php?groupId=$encryptedGroupId'; 
                  }
                 </script>


              ";

          }
        else 
        {

            if(isset($_SESSION['UserId']))
        {
             $userId = $_SESSION['UserId'];
             $groupId = mysqli_real_escape_string($conn, $_POST['groupId']);
             
             $encryptedGroupId = my_simple_crypt($groupId, 'e');
             
             $cleanedMessage = clean_input($_POST['groupPost']);
            //   // echo $userId;
             $cleanedMessage = mysqli_real_escape_string($conn, $cleanedMessage);

               $login = $loginWebService -> writeGroupPostToDB($userId, $cleanedMessage, $groupId);

            echo "
            <script> window.location.href ='groupsPage.php?groupId=$encryptedGroupId'; 


            </script>";

        }


        }


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
<style type="text/css">
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

.material-icons {vertical-align:-14%}

.fa {
    font-size: 30px;
    cursor: pointer;
    user-select: none;
}

.fa:hover {
  color: darkblue;
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
</style>
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="script.js"></script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif, background-color:#e6ffff}

</style>
<body class="w3-theme-15", background-color="#e6ffff">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Gatherly</a>
 
<?php 

  $loginWebService = new LoginWebService();

  $groupNameHeader = $loginWebService->getGroupName($groupId);
?>


  <a href="profilepage.php" button class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" onclick="openForm()" title="My Account"><i class="fa fa-user"></i> Welcome<?php  if(!isset($_SESSION)){session_start(); } echo " " . $_SESSION['FirstName'] . " to " . $groupNameHeader . "!";?></a>
  <div class="pull-right">
  <form method="post" action="server/logout.php">
    <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4" type="submit" class="btn navbar-btn btn-danger" name="logout" id="logout"  value="Log Out"><i class="fa fa-sign-out w3-margin-right"></i>Log Out</a>
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
            
            if (!isset($_SESSION['UserId']))
              {
                 header("Location: index.php");
                 die();
              }
              
              $userID  = $_SESSION['UserId'];

              $MyloginWebService = new LoginWebService();
              $userGroupIds = $MyloginWebService -> getUserGroups($userID);
              
              if(empty($userGroupIds))
              {
                header("Location: mainpage.php");
                 die();
              }

              $count = count($userGroupIds);



              $i = 0;
              
              echo "<button onclick='globalClicked()' class='w3-button w3-block w3-theme-l1 w3-left-align'>Global</button> </br>";
              
              while($i != $count)
              {
                
                $groupName = $MyloginWebService ->getGroupName($userGroupIds[$i]);
                $_SESSION['groupIdClicked' . $i] = $userGroupIds[$i];
                
                echo "<form method='post' action='groupsPage.php'>";
                echo "<input type='hidden' id='groupName' name='groupName' value='$userGroupIds[$i]'>";
                echo "<button type='submit'  name='action' class='w3-button w3-block w3-theme-l1 w3-left-align'>" . $groupName . "</button> </br>";
                echo "</form>";
              // echo $userGroupIds[$i];
                $i = $i + 1;
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

          ?>

          </div>
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
 

<div id='GroupPosts'>
     
  <?php
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);

  include_once "./server/loginService.php";
  include_once "./server/loginSQL.php";
  include_once "./server/connect.php";

  /***************************************************************************************
*    Title: A simple two-way function to encrypt or decrypt a string
*    Author: Nazmul Ahsan
*    Date: 10/15/2018
*    Code version: N/A
*    Availability: https://nazmulahsan.me/simple-two-way-function-encrypt-decrypt-string/
*
***************************************************************************************/
   function my_simple_crypt( $string, $action = 'e' ) {
        // you may change these values to your own
        $secret_key = 'my_simple_secret_key';
        $secret_iv = 'my_simple_secret_iv';

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }

        return $output;
    }
  //***********************end of citation*******************************************



    if(!isset($_SESSION))
    {
           session_start();
    }

    $userId = $_SESSION['UserId'];


     if(isset($_POST['groupName']))
      {
        $_SESSION['groupIdInSession'] = $_POST['groupName'];
        $groupId = $_SESSION['groupIdInSession'];
        $loginWebService = new LoginWebService();

        $userIsInGroup = $loginWebService->checkIfUserIsInGroup($userId, $groupId);

        if($userIsInGroup == false)
        {
          header("Location: mainpage.php");
          die();
        }




     }
      else if (isset($_GET['groupId']))
      {
         //echo "it is in groupid get request";
       $groupId = my_simple_crypt($_GET['groupId'], 'd');

        $loginWebService = new LoginWebService();

        $userIsInGroup = $loginWebService->checkIfUserIsInGroup($userId, $groupId);

        if($userIsInGroup == false)
        {
          header("Location: mainpage.php");
          die();
        }


      }


     echo  "<div class='w3-col m7'>";
  
     echo  "<div class='w3-row-padding'>";
     echo  "<div class='w3-col m12'>";
     echo  "<div class='w3-card w3-round w3-white'>";
     echo  "<div class='w3-container w3-padding'>";
     echo  "<h6 class='w3-opacity'>Share something with the " . $groupNameHeader . " group</h6>";
              
                echo "<form method='POST' action='http://qav2.cs.odu.edu/fordFanatics/groupsPage.php'>";
                echo "<input type='hidden' id='groupId' name='groupId' value='$groupId'>";
                echo "<input type='text' id='postMessage' name='groupPost' placeholder='Whats on your mind' contenteditable='true' class='w3-border w3-padding'>";
                echo "<button name='postTheMessage' type='submit' class='w3-button w3-theme'><i class='fa fa-pencil'></i>Post</button> ";
                echo "</form>";

            echo "</div>";
         echo "</div>";
       echo  "</div>";
     echo  "</div>";
  

      include_once "./server/loginService.php";
      include_once "./server/loginSQL.php";

    
      if(!isset($_SESSION))
       {
           session_start();
       }

      $userId = $_SESSION['UserId'];

      $loginWebService = new LoginWebService();
     // echo "group id : " . $groupId;
      $login = $loginWebService -> getGroupPosts($groupId);
      $var = 1;
      
      

       //var_dump($login);
      if(!empty($login))
      {
       

         foreach($login as $i => $item) {
           
              $getPosterDetails = $loginWebService -> getPosterDetails($login[$i]['groupMessageUserId']);
              $getLikeInformation = $loginWebService-> getLikes($login[$i]['groupMessageId'], $userId);
              $likeCount = $loginWebService->getRatingCount($login[$i]['groupMessageId']);
              $userLiked = $loginWebService->checkUserLiked($login[$i]['groupMessageId'], $userId);
              $userDisliked = $loginWebService->checkUserDisliked($login[$i]['groupMessageId'], $userId);
              $comments = $loginWebService->getComments($login[$i]['groupMessageId']);
              $reactions = explode("/", $likeCount);
 

             echo "<div id = 'globalPosts' class='w3-container w3-card w3-white w3-round w3-margin'><br>";
            
                     if($getPosterDetails[0]['ProfilePicture'] == "")
                     {
                       echo "<img src='avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
                     }
                     else
                     {
                      echo "<img src=" . $getPosterDetails[0]['ProfilePicture'] . " alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
                     }
                    
                     
                     echo "<span class='w3-right w3-opacity'>" . $login[$i]['groupTimeOfPost'] . "</span>";
                     echo "<h4>" . $getPosterDetails[0]['PostFirstName'] . " " . $getPosterDetails[0]['PostLastName'] . "</h4><br>";
                     echo "<p>" . $login[$i]['groupMessage'] ."</p>";

             
                    if($userLiked == true)
                    {
                       echo "<i class='fa fa-thumbs-up like-btn likeOrDislike' data-id=" . $login[$i]['groupMessageId'] ."></i>";
                       echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                       echo "<i class='fa fa-thumbs-o-down dislike-btn likeOrDislike' data-id=" . $login[$i]['groupMessageId'] ."></i>";
                    }

                   else if($userDisliked == true)
                   {

                      if($reactions[0] == '0')
                      {
                          
                          echo "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id=" . $login[$i]['groupMessageId'] ."></i>";
                          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                          echo "<i class='fa fa-thumbs-down dislike-btn likeOrDislike' data-id=" . $login[$i]['groupMessageId'] ."></i>";
                      }
                      else
                      {
                          echo "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id=" . $login[$i]['groupMessageId'] ."></i>"; 
                          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                          echo "<i class='fa fa-thumbs-down dislike-btn likeOrDislike' data-id=" . $login[$i]['groupMessageId'] ."></i>";
                      }


                 }
                else
                {
                        echo "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id=" . $login[$i]['groupMessageId'] ."></i>";  
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo "<i class='fa fa-thumbs-o-down dislike-btn likeOrDislike' data-id=" . $login[$i]['groupMessageId'] ."></i>";


                }
                  
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "<span class='likes'>" . "Likes: " . $reactions[0] . "</span>";
                echo "<span class='dislikes'>" . " Dislikes: " . $reactions[1] . "</span>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
                
                echo "<button onclick= myFunction('". $login[$i]['groupMessageId'] ."') class='w3-button w3-white w3-border w3-border-white'><i class='material-icons'>filter_list</i></button>";
               
                if(!empty($comments)){  

                                 echo "<div  id='" . $login[$i]['groupMessageId'] . "' class='w3-hide w3-container'>";
                      
                                  foreach($comments as $j => $items) {

                                     $getCommenterDetails = $loginWebService -> getPosterDetails($comments[$j]['commentUserId']);
                       
                                     //echo "<br/>";
                                     echo "<div class='a'>";
                                           
                                           echo "<aside>";
                                               
                                               if($getCommenterDetails[0]['ProfilePicture'] == "")
                                               {
                                                echo "<aside><img src='avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'></aside>";
                                               }
                                               else{
                                                echo "<aside><img src=" . $getCommenterDetails[0]['ProfilePicture'] . " alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'></aside>";
                                               }
                                               
                                               
                                               echo "<h6>" . $getCommenterDetails[0]['PostFirstName'] . " " . $getCommenterDetails[0]['PostLastName'] . "</h6>";
                                               echo "<p>" . $comments[$j]['comment'] . "</p>";
                                           echo "</aside>";

                                     echo "</div>";
                        
                                  }
                              
                                echo "</div>";
                       

                       // echo "</div>";
                        
                        
                                 echo "<form id " . $login[$i]['groupMessageId'] . "  > ";
                                     
                         //   echo "<div id = 'commentInputs'>";
                                     //echo "<span value = '" . $login[$i]['FirstName'] . "' />";
                                     echo "<aside><input name =" . $login[$i]['MessageUserId'] . " placeholder='Type your comment'> </input>" ;
                                     //echo  " " . "<button class='commentButton data-id = '" .  $login[$i]['messageId'] . "' type = 'submit'>Comment</button> </aside>";
                                     echo  " " . "<button class='commentButton' value = '" .  $login[$i]['groupMessageId'] . "' type = 'submit'>Comment</button> </aside>";
                                 echo "</form>";
                        
                        //  echo "</div>";
                         //echo "</div>";
                         echo "</div>";

                 }
                 else
                 {
                        echo "<div id='" . $login[$i]['groupMessageId'] . "' class='w3-hide w3-container'>";
                            echo "<div class='a'>";
                       
                            echo "<p>no comments</p>";
                            
                            echo "<form id =  '" . $login[$i]['groupMessageId'] . "'  > ";
                      
                         //   echo "<div id = 'commentInputs'>";
                      
                                     echo "<aside><input name =" . $login[$i]['MessageUserId'] . " placeholder='Type your comment'> </input>" ;
                                     //echo  " " . "<button class='commentButton data-id = '" .  $login[$i]['messageId'] . "' type = 'submit'>Comment</button> </aside>";
                                     echo  " " . "<button class='commentButton' value = '" .  $login[$i]['groupMessageId'] . "' type = 'submit'>Comment</button> </aside>";
                                 echo "</form>";
                        
                             //  echo "<form id " . $login[$i]['messageId'] . "  > ";
                             // // echo "<form id = 'commentFrom'>";
                       
                             //  //     echo "<div id = 'commentInputs'>";
                      
                             //          echo "<aside><input placeholder='Type your comment'> </input>" . " " . "<button class='commentButton data-id = '" .  $login[$i]['messageId'] . "'' type = 'submit'>Comment</button> </aside>";
                             //    //   echo " </div>";
                       
                             //  echo "</form>";
                     
                
                          echo "</div>";
                          echo "</div>";
                          echo "</div>";
                         
              
                 }

                // echo "</div>"; // ending global posts

              

         }
       
      } //if not empty login end bracket
 
  else{
        echo "<h1>no posts to be displayed.</h1>";
     }
     echo "<br/>";
     echo "<br/>";
     echo "<br/>";
      // echo "</div>";

      

   //echo  "</div>";












  ?>



</div>
<br>

<!-- Footer -->
<div class="footer">
  <p>&copy;fordFanatics</p>
</div>

<script>

   document.getElementById("logout").onclick = function(){

     location.href = "./server/logout.php";
 };

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

    location.href = "./mainpage.php";
    //   alert("global clicked.");

    // var x = document.getElementById("AllGlobalPosts");
    // if (x.style.display === "none") {
    //     x.style.display = "block";
    // } else {
    //     x.style.display = "none";
    // }



    }



</script>

</body>
</html> 
