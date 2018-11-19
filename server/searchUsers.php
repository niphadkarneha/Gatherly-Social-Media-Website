<?php
 
 include_once "loginService.php";
 include_once "loginSQL.php";


 if(isset($_POST['query']))
 {

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $loginWebService = new LoginWebService();
    
    $search = mysqli_real_escape_string($conn, $_POST['query']);

    $searchResults =  $loginWebService -> searchResults($search);

    echo $searchResults;
   
 }
 else
 {
 	$loginWebService = new LoginWebService();

 	$allUsers = $loginWebService -> getAllUserForSearch();
 	echo $allUsers;
 }


?>