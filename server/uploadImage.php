<?php
 include_once "loginService.php";
 session_start();


if(isset($_POST['uploadDisk']))

{

		if($_FILES["file"]["name"] != '')
		{
				$test = explode(".", $_FILES["file"]["name"]);
				$extension = end($test);
				$name = rand(100,999) . time() . '.' . $extension;
				$location = '../upload/' . $name;
				move_uploaded_file($_FILES["file"]["tmp_name"], $location);
				//echo "<img src='" . $location . "' height='150' width='225' class='img-thubnail'/>";

				$groupId = $_POST['groupId'];
				$userId = $_SESSION['UserId'];

				$loginWebService = new LoginWebService();

				$loginWebService -> writeUploadToDB($userId, $groupId, "picture", $name);
				$latestPost = $loginWebService ->  getLatestPost($userId, $groupId);

				echo $latestPost;

		}


}



?>