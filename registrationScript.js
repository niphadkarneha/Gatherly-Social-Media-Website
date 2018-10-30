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

                  if(data >= 1)
                  {
                    $('#emailRequired').html(" *Email already Exists");
                  }
                  if(data == '0'){
                    alert("You have successfully registered!");
                    location.reload();

                  }
                  else {
                     alert("Error occured, please try again.");
                  }
                    
                }
            });


      }


     

});
