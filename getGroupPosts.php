<?php

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

 	echo "it is here";

 	if(isset($_POST['action']))
	 {	

	 	echo "it is here" . $_POST['groupName'];
	 	header("Location: mainpage.php");
		die();
   	}


 }


?>