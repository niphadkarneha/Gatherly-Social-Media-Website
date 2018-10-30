<?php
    
     ini_set('display_startup_errors', 1);
     ini_set('display_errors', 1);
     error_reporting(-1);
     include_once "./server/loginService.php";
     include_once "./server/loginSQL.php";

	 if(isset($_FILES['image'])){

      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      
      $tmp = explode('.', $_FILES['image']['name']);
      $file_ext = strtolower(end($tmp));
      //$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      if(!session_start())
      {
      	session_start();
      }
      
      $file_name = $_SESSION['UserId'] .  "." . $file_ext;
    
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="Extension not allowed. Please choose a JPEG or PNG file.";

      }
      
      if($file_size > 2097152){
         $errors[] = "File size must be excately 2 MB.";

      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);

         $profilePicture = 'images/' . $file_name;
         
         $loginWebService = new LoginWebService();
         $loginWebService->uploadProfilePicture($_SESSION['UserId'], $profilePicture);
         
         echo "File successfully uploaded.";
         header("Location: mainpage.php ");
     
      }else{
         print_r($errors);
      }
   }



?>
