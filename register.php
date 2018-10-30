<!DOCTYPE html>
<html lang="en">
	<head>
<style type="text/css">
  
  .inputfield{
    color: black;
  }

</style>

		<meta charset="UTF-8">
		<title>Gatherly</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!--    <script src="script.js"></script> -->
	</head>
<!-- <link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/> -->
<link rel="stylesheet" href="forms.css" type="text/css">
<div class="body-content">
  <div class="module">
    <h1>Create an account</h1>
    <form method = "post" id = "regForm" class="form" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"></div>
      
      <label><b>First Name</b></label><span id ='firstNameRequired' style='color:red'>*</span>
      <input style="color: black;" id = "firstName" type="text" placeholder="First Name" name="firstName" required />

      <label><b>Last Name</b></label><span id ='lastNameRequired' style='color:red'>*</span>
      <input style="color: black;" id = "lastName" type="text" placeholder="Last Name" name="lastName" required />

       <label><b>Username</b></label><span id ='usernameRequired' style='color:red'>*</span>
      <input style="color: black;" id = "uname" type="text" placeholder="User Name" name="username" required />
       <label><b>Email</b></label><span id ='emailRequired' style='color:red'>*</span>
      <input style="color: black;"  id = "email" type="email" placeholder="Email" name="email" required />
       <label><b>Password</b></label><span id ='passwordRequired' style='color:red'>*</span>
      <input style="color: black;" type="password" id="pass" placeholder="Password" name="password" autocomplete="new-password" required />
       <label><b>Confirm Password</b></label><span id ='confirmPasswordRequired' style='color:red'>*</span>
      <input style="color: black;" type="password" id="confirmPass" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required />

     <!--  <div class="avatar"><label><b>Select your avatar</b></label><span id ='confirmPasswordRequired' style='color:red'>*</span><input type="file" name="avatar" accept="image/*" required /></div> -->
      <button type="submit" value="Register" name="register" class="btn btn-block btn-primary">Register</button>
    </form>
  </div>
</div>
		<div class="footer row">
			<small >&copy;fordFanatics</small>
		</div>





<script type="text/javascript">
  
function hasWhiteSpace(s) {
  return s.indexOf(' ') >= 0;
}

$("#regForm").submit(function(e) {
alert("submit button clicked");
      e.preventDefault();  
      var formIsValid = true;
      alert("it is here");
      var username = document.getElementById("uname").value;
      var email = document.getElementById("email").value;
      var password = document.getElementById("pass").value;
      var confirmPass = document.getElementById("confirmPass").value;
      var firstName = document.getElementById("firstName").value;
      var lastName = document.getElementById("lastName").value;

      alert(firstName);
      alert(lastName);

       if(password == "" || confirmPass == "")
       {
        $('#passwordRequired').html(" *Password and Confirm Password do not match.");
        $('#usernameRequired').html(" *");
        $('#confirmPasswordRequired').html(" *");
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
                url: "validateUser.php",
                type: 'post',
                data: {'username': username, 'email': email, 'password': password, 'firstName': firstName, 'lastName': lastName },
            
                success: function (data) {
                  
                  var dataInt = parseInt(data);
                  alert(data);
                if(dataInt == 1)
                 {
                  alert("You have successfully registered for Gatherly!");
                   location.reload();
                   // $('#emailRequired').html(" *A User with this email already exists.");
                 }
                 else if (dataInt == 2)
                 {

                  $('#usernameRequired').html(" *A User with this username already exists.");
                  $('#emailRequired').html(" *");
                  $('#passwordRequired').html(" *");
                  $('#confirmPasswordRequired').html(" *");

                 }
                 else if (dataInt == 3)
                 {
                    $('#emailRequired').html(" *A User with this email already exists.");
                    $('#usernameRequired').html(" *");
                    $('#passwordRequired').html(" *");
                    $('#confirmPasswordRequired').html(" *");
                 // $('#usernameRequired').html(" *A User with this username already exists.");
                 }
                 else if (dataInt == 4){
                    
                    $('#usernameRequired').html(" *A User with this username already exists.");
                    $('#emailRequired').html(" *A User with this email already exists.");
                    $('#passwordRequired').html(" *");
                    $('#confirmPasswordRequired').html(" *");
                 }

           
                }
            });


      }


     

});
</script>

  </body>

</html>