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



  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $loginWebService = new LoginWebService();


     // session_start();
  
    $userId =  $_SESSION['UserId'];


    if(isset($_POST['userCommented']))
       {
        
        $commentInput = clean_input($_POST['commentInput']);
        $commentInput = mysqli_real_escape_string($conn, $commentInput);

        $messIdComment = clean_input($_POST['messIdComment']);
        $messIdComment = mysqli_real_escape_string($conn, $messIdComment);

       // echo $commentInput . " " . $messIdComment;
        
        $loginWebService -> addCommentToDB($commentInput, $userId, $messIdComment, $conn);

        echo $_SESSION['FirstName'] . "/" .$_SESSION['LastName'];

       }



    if(isset($_POST['action']))
    {

      $post_id = $_POST['post_id'];
      $action = $_POST['action'];
      $userLikedMessage = $loginWebService->checkUserLiked($post_id, $userId);

      $likeCount = $loginWebService->getRatingCount($_POST['post_id']);
      $likeDislikeCount = $loginWebService->getLikeCountFromMes($_POST['post_id']);
     
      //$reactionsLike = explode("/", $likeCount);
      switch ($action) {
        case 'like':
        $loginWebService -> recordLikes($post_id, $userId);
        $loginWebService -> incrementLike($post_id, $userId, $conn);
        $likeCountFromUserLikes = $loginWebService->getLikeCountFromUserLikesTable($_POST['post_id']);
        //echo $likeCount . "/" . $userLikedMessage;
        //echo $likeCountFromUserLikes;
      $likeDislikeCountFromUserLike = $loginWebService->getRatingCount($_POST['post_id']);
        echo $likeDislikeCountFromUserLike;
        break;
        
        case 'dislike':
        $loginWebService -> recordDislike($post_id, $userId);
        $loginWebService -> decrementLike($post_id, $userId, $conn);
        $likeCountFromUserLikes = $loginWebService->getLikeCountFromUserLikesTable($_POST['post_id']);
        //echo $likeCount . "/" . $userLikedMessage;
       // echo $likeCountFromUserLikes;
        $likeDislikeCountFromUserLike = $loginWebService->getRatingCount($_POST['post_id']);
        echo $likeDislikeCountFromUserLike;
        break;

        case 'unlike':
        $loginWebService ->deleteLike($post_id, $userId);
        $loginWebService -> decrementLike($post_id, $userId, $conn);
        $likeCountFromUserLikes = $loginWebService->getLikeCountFromUserLikesTable($_POST['post_id']);
        $likeDislikeCountFromUserLike = $loginWebService->getRatingCount($_POST['post_id']);
        echo $likeDislikeCountFromUserLike;
        //echo $likeCountFromUserLikes;
        //echo $likeCount . "/" . $userLikedMessage;

        case 'undislike':
        $loginWebService ->deleteLike($post_id, $userId);
        $loginWebService -> incrementLike($post_id, $userId, $conn);
        $likeCountFromUserLikes = $loginWebService->getLikeCountFromUserLikesTable($_POST['post_id']);
        //echo $likeCountFromUserLikes;
        $likeDislikeCountFromUserLike = $loginWebService->getRatingCount($_POST['post_id']);
        echo $likeDislikeCountFromUserLike;
        default:
          # code...
          break;
      }

    }




    $likedByUserId = "empty";
    $messageIdLiked = "empty";

    $dislikedByUserId = "empty";
    $messageIdDisliked = "empty";
    
      // if(isset($_POST['likedByUserId']))
      // {
      //       $likedByUserId =  mysqli_real_escape_string($conn, $_POST['likedByUserId']);
      //       $likedByUserId = clean_input($likedByUserId);
      //       //echo "<script>  alert(" . $_POST['likedByUserId'] . ") </script>";
      //       $messageIdLiked = mysqli_real_escape_string($conn, $_POST['messageIdLiked']);
      //       $messageIdLiked = clean_input($messageIdLiked);
      //      // echo "<script>  alert(" . $messageIdLiked . ") </script>";

      //       //$loginWebService -> incrementLike($messageIdLiked, $likedByUserId, $conn);




      // }

      // if(isset($_POST['messageIdDisliked']))
      // {
      //     $dislikedByUserId = mysqli_real_escape_string($conn, $_POST['dislikedByUserId']);
      //     $dislikedByUserId = clean_input($dislikedByUserId);

      //     $messageIdDisliked = mysqli_real_escape_string($conn, $_POST['messageIdDisliked']);
      //     $messageIdDisliked = clean_input($messageIdDisliked);

      //    // $loginWebService -> decrementLike($messageIdDisliked, $dislikedByUserId, $conn);
      //      //echo "<script>  alert(" . $_POST['messageIdDisliked'] . ") </script>";
      //      //echo "<script>  alert(" . $_POST['dislikedByUserId'] . ") </script>";
          
      // }

  }

 // $conn->close();

?>


