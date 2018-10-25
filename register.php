<?php 

  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  session_start();
  include_once "./server/loginService.php";
  include_once "./server/loginSQL.php";
  include_once "./server/connect.php";

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $username = "empty";
    $password = "empty";
    $email = "empty";

    function clean_input($data) {
    
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   





    $username = clean_input($_POST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    
    $password = clean_input($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    $email = clean_input($_POST['email']);
    $email = mysqli_real_escape_string($conn, $email);
    $conn->close();

    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    $byemail = "byEmail";
    $byusername = "byusername";
    $duplicateCheck = "empty";

    $sql_service = new LoginSqlService();
    $MyloginWebService = new LoginWebService();
    $recordLikesSql = "SELECT * FROM fordFanatics.user WHERE Email = '$email'";


    $result = $conn->query($recordLikesSql);

    $resultCount = $result->num_rows;

    echo $resultCount;

    if($resultCount == 0)
    {
      $MyloginWebService->insertNewUser($username, $email, $password);
    }



}
    

?>







<style type="text/css">
  
  .inputfield{
    color: black;
  }

</style>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Gatherly</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
	</head>
<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="forms.css" type="text/css">
<div class="body-content">
  <div class="module">
    <h1>Create an account</h1>
    <form method = "post" id = "regForm" class="form" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"></div>
       <label><b>Username</b></label><span id ='usernameRequired' style='color:red'>*</span>
      <input style="color: black;" id = "uname" type="text" placeholder="User Name" name="username" required />
       <label><b>Email</b></label><span id ='emailRequired' style='color:red'>*</span>
      <input style="color: black;"  id = "email" type="email" placeholder="Email" name="email" required />
       <label><b>Password</b></label><span id ='passwordRequired' style='color:red'>*</span>
      <input style="color: black;" type="password" id="pass" placeholder="Password" name="password" autocomplete="new-password" required />
       <label><b>Confirm Password</b></label><span id ='confirmPasswordRequired' style='color:red'>*</span>
      <input style="color: black;" type="password" id="confirmPass" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required />

      <div class="avatar"><label><b>Select your avatar</b></label><span id ='confirmPasswordRequired' style='color:red'>*</span><input type="file" name="avatar" accept="image/*" required /></div>
      <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>
		<div class="footer row">
			<small >&copy;fordFanatics</small>
		</div>


  </body>

</html>


<script type="text/javascript">
  
function hasWhiteSpace(s) {
  return s.indexOf(' ') >= 0;
}

$("#regForm").submit(function(e) {

      e.preventDefault();  
      var formIsValid = true;
     
      var username = document.getElementById("uname").value;
      var email = document.getElementById("email").value;
      var password = document.getElementById("pass").value;
      var confirmPass = document.getElementById("confirmPass").value;



      if(password == "" || confirmPass == "")
      {
       $('#passwordRequired').html(" *Password and Confirm Password do not match.");
      }

      if(password != confirmPass){

         $('#passwordRequired').html(" *Password and Confirm Password do not match.");
         $('#confirmPasswordRequired').html(" *Password and Confirm Password do not match.");
        formIsValid = false;
      }
      else
      {

        if(username == "")
        {
          alert("username cannot be empty.");
           formIsValid = false;
        }

        if(email == "")
        {
          alert("Email cannot be empty.");
           formIsValid = false;
        }

      }

  
      if(formIsValid == true)
      {

            $.ajax({
                url: "register.php",
                type: 'post',
                data: {'username': username, 'email': email, 'password': password },
            
                success: function (data) {
                  
                  var dataInt = parseInt(data);

                  if(dataInt >= 1)
                  {
                    $('#emailRequired').html(" *A User with this email already exists.");
                  }
                  else if(dataInt == '0'){
                    alert("You have successfully registered!");
                    location.reload();

                  }
           
                }
            });


      }


     

});



</script>