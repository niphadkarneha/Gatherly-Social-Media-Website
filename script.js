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
                  if(data == 'userAlreadyExists')
                  {
                    $('#emailRequired').html(" *Email already Exists");
                  }
                  if(data == 'newUser'){
                    alert("You have successfully registered!");
                    location.reload();

                  }
                  else if (data=='duplicateUser'){
                     alert("Error: "+data);
                  }
                    
                }
            });


      }


     

});


$(document).ready(function(){
   
  

  $('.commentButton').on('click', function(e){
       e.preventDefault();  
    
    var userInput = $(this).closest("form").find("input").val();
    var messageIdCommentedAt = $(this).val();
    var userCommented = "usercommented";

    if (userInput == "")
    {
      alert("comments cannot be empty, please try again.");
    }
    else {
     
         $.ajax({

              url : 'likeDislike.php',
              type : 'POST',
              data : {
                'commentInput' : userInput, 
                'messIdComment' : messageIdCommentedAt, 
                'userCommented' : userCommented
              },
              
              success : function(data) {   
                var userInfo = data;
                userInfo = data.split('/');
              //  alert(userInfo[0] + userInfo[1]);

               // $( ".inner" ).append( "<p>Test</p>" );
                //var e = $('<p>' + userInput + '</p>');
                
                var e = "<right> <aside><img src='avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'></aside> <aside><h6> " + userInfo[0] + " " + userInfo[1] +"</h6></aside> <p>" + userInput + "</p>     </right>";
                $('#' + messageIdCommentedAt).append(e); 
               // $("#" + messageIdCommentedAt).remove();           
                //$('#' + messageIdCommentedAt).load("/divcontents");
               // $("#" + messageIdCommentedAt).load("#" + messageIdCommentedAt);
              }
        })  

    }


  });




   $('.likeOrDislike').on('click', function(){

     var post_id = $(this).data('id');
      
     //alert(post_id);
     var action = 'empty';

     $clicked_btn = $(this);

     if($clicked_btn.hasClass('fa-thumbs-o-up'))
     {
      action = 'like';

     }

     else if($clicked_btn.hasClass('fa-thumbs-up'))
     {
      action = 'unlike';
     }

     else if ($clicked_btn.hasClass('fa-thumbs-o-down')){
    
       action = 'dislike';
    
   } else if ($clicked_btn.hasClass('fa-thumbs-down'))
     
     {
       action = 'undislike';
     }

  $.ajax({

         url: 'likeDislike.php',
         type: 'post',
         data: {
           'action': action,
           'post_id': post_id
         },
         success: function(data){
          // res = JSON.parse(data);

           if(action == 'like')
           {
             $clicked_btn.removeClass('fa-thumbs-o-up');
             $clicked_btn.addClass('fa-thumbs-up');
           

           } else if (action == 'unlike')
           {
             $clicked_btn.removeClass('fa-thumbs-up');
             $clicked_btn.addClass('fa-thumbs-o-up');
           }
           
          else if(action == 'dislike')
           {

             $clicked_btn.removeClass('fa-thumbs-o-down');
             $clicked_btn.addClass('fa-thumbs-down');



           } else if (action == 'undislike')
           {
             $clicked_btn.removeClass('fa-thumbs-down');
             $clicked_btn.addClass('fa-thumbs-o-down');
           }
        else if (action == 'unlike')
           {
            $clicked_btn.removeClass('fa-thumbs-up');
            $clicked_btn.addClass('fa-thumbs-o-up');
           }

           var likesDislikes = data.split("/");

          // var parsedInt = parseInt(data);
          var likeCount = parseInt(likesDislikes[0]);
          var dislikeCount = parseInt(likesDislikes[1]);
 
           $clicked_btn.siblings('span.likes').text("Likes: " + likeCount);
           $clicked_btn.siblings('span.dislikes').text(" Dislikes: " + dislikeCount);
           $clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');

           $clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
         }
   })

   })

 });

