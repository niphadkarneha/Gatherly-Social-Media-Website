function hasWhiteSpace(s) {
  return s.indexOf(' ') >= 0;
}

$(document).ready(function(){




$('.loginButton').on('click', function(e){

   var userName = escapeHtml($(this).closest("form").find("input[id='email']").val());
   var password = escapeHtml($(this).closest("form").find("input[id='password']").val());

   var message = "<p>Email cannot be empty. Please try again.";

   if(userName == "")
   {
     alert("Username cannot be empty. Please try again.");
   }

   if(password == "")
   {
    alert("Password cannot be empty. Please try again.");
   }


   if(userName != "" && password != "")
   {

                                      $.ajax({

                                    url : './server/login.php',
                                    type : 'POST',
                                    data : {
                                      'email'   : userName, 
                                      'password'   : password 
                                    },
                                    
                                    success : function(data) {   
                                      
                                      if(data == 'fail')
                                      {
                                           alert("Wrong Credentials, Please try again.");
                                      }
                                      else
                                      {
                                          var obj = JSON.parse(data);

                                          if(parseInt(obj[0]['userType']) == 0)
                                          {
                                            $( ".deleteMessageBtn" ).remove();
                                          }


                                          window.location.href = "mainpage.php"; 
                                      }


                                    }
                              }) 




   }







});






  var entityMap = {
  '&': '&amp;',
  '<': '&lt;',
  '>': '&gt;',
  '"': '&quot;',
  "'": '&#39;',
  '/': '&#x2F;',
  '`': '&#x60;',
  '=': '&#x3D;'
};


function escapeHtml (string) {
  return String(string).replace(/[&<>"'`=\/]/g, function (s) {
    return entityMap[s];
  });
}
   


$('.acceptButton').on('click', function(e){

  e.preventDefault();

  var groupIdAccepted = $(this).closest("form").find("input[id='groupIdInvitation']").val();
  var action = 'addUserToGroup';

   $.ajax({

              url : 'inviteUser.php',
              type : 'POST',
              data : {
                'groupIdAccepted' : groupIdAccepted, 
                'addUserToGroup'  : action
              },
              
              success : function(data) {   
                  alert("You have been successfully added to the group!");
                  location.reload();
              }
        })  
  

});






$('.declineButton').on('click', function(e){

  e.preventDefault();

  var groupIdDeclined = $(this).closest("form").find("input[id='groupIdInvitation']").val();

     $.ajax({

              url : 'inviteUser.php',
              type : 'POST',
              data : {
                'groupIdDeclined'   : groupIdDeclined
              },
              
              success : function(data) 
              { 

                  alert("You have  successfully declined the invitation.");
                  //location.reload();
              }
        })  
  

});









  $('.createChannelBtn').on('click', function(e){

    var groupName = $("#groupNameToBeCreated").val();
    var groupType = $("input[type='radio']:checked").val();
    var actionType = "createGroup";
    var checkGroup = "checkGroup";
    if (groupName == "")
    {
      // $('#groupNameRequired').html(" *Group Name cannot be empty, please try again.");
      alert("Group Name cannot be empty, please try again.");

    }
    else
    {   

         $.ajax({

              url : 'likeDislike.php',
              type : 'POST',
              data : {
                'groupName'   : groupName,
                'checkGroup'  : checkGroup
              },
              
              success : function(data) {   
              
                if (data >= 1)
                {
                  alert("Group name is taken. Please choose a new group name.");
                }
                else{

                               $.ajax({

                                    url : 'likeDislike.php',
                                    type : 'POST',
                                    data : {
                                      'groupName'   : groupName, 
                                      'groupType'   : groupType,
                                      'createGroup' : actionType 
                                    },
                                    
                                    success : function(data) {   
                                     
                                      alert("successfully created group.");
                                      e = "<li><a id = 'groupNameDisplay' href='#'>" + groupName + "</a></li>";
                                      
                                      if(groupType == "public")
                                      {
                                         $("#myUL").append(e); 
                                      }

                                    }
                              }) 
                }

              }
        }) 

    }

  });



  $('.removeUserAdminButton').on('click', function(e){

    e.preventDefault();

     var userEmailToRemove = escapeHtml($(this).closest("form").find("input[id='removeUserAdmin']").val());
     var groupIdToRemoveFrom = escapeHtml($(this).closest("form").find("input[id='groupIdAdminRemove']").val());

     if (userEmailToRemove == "")
     {
         alert("user email cannot be empty. Please try again.");
     }
     else
     {

       $.ajax({

              url : 'inviteUser.php',
              type : 'POST',
              data : {
                'removeUserAdmin' : 'removeUserAdmin',
                'emailIdToRemove' : userEmailToRemove,
                'groupIdRemoveFrom' : groupIdToRemoveFrom
              },
              
              success : function(data) {   
              
               if (data == "InvalidEmailId")
               {
                alert("Invalid user id. Please choose one from the list below.");
               }
               else if (data == "InvalidInput")
               {
                alert("The user entered is not a member of this group or does not exist. Please try again.");
               }
               else
               {
                  alert("User has been successfully removed from group.");
                 
                 
               }

              }
        })

     }
     

  });






  $('.addUserAdminButton').on('click', function(e){

    // var userEmailToBeInvited = $(this).closest("form").find("input[id='userIdToAdd']").val();
    e.preventDefault();

     var userEmailToAdd = escapeHtml($(this).closest("form").find("input[id='addUserAdmin']").val());
     var groupIdToBeAddedTo = escapeHtml($(this).closest("form").find("input[id='groupIdAdminAdd']").val());

     
    if (userEmailToAdd == "")
    {
      alert("user email cannot be empty. Please try again.");
    }
     else
     {
            $.ajax({

              url : 'inviteUser.php',
              type : 'POST',
              data : {
                'addUserAdmin' : 'addUserAdmin',
                'userEmailAddAdmin' : userEmailToAdd,
                'groupIdAdminAdd' : groupIdToBeAddedTo
              },
              
              success : function(data) {   
              
               if (data == "InvalidEmailId")
               {
                alert("Invalid user id. Please choose one from the list below.");
               }
               else if (data == "InvalidInput")
               {
                alert("The user entered already exists in the group or does not exist. Please choose a new user.");
               }
               else
               {
                  alert("User has been successfully added to group.");
                 
               }

              }
        })
    }
     

  });



  $('.inviteUserButton').on('click', function(e){
    e.preventDefault();
    
    var userEmailToBeInvited = escapeHtml($(this).closest("form").find("input[id='myInputTwo']").val());
    var ownerInvitingUser = $(this).closest("form").find("input[id='ownerUserId']").val();
    var groupIdInvitedTo = $(this).closest("form").find("input[id='groupIdInvitedTo']").val();

    var userEmailToBeInvited = escapeHtml(userEmailToBeInvited);
    
    if (userEmailToBeInvited == "")
    {
      alert("user email cannot be empty. Please try again.");
    }
    else
    {

         $.ajax({

              url : 'inviteUser.php',
              type : 'POST',
              data : {
                'userEmailToBeInvited'   : userEmailToBeInvited,
                'ownerInvitingUser'      : ownerInvitingUser,
                'groupIdInvitedTo'       : groupIdInvitedTo
              },
              
              success : function(data) {   
                
               if (data == "InvalidEmailId")
               {
                alert("Invalid user id. Please choose one from the list below.");
               }
               else if (data == "InvalidInput")
               {
                alert("The user entered already exists in the group or does not exist. Please choose a new user.");
               }
               else
               {
                alert("Invitation successfully sent.");
               }

              }
        })





    }




  });

  $('.joinGroupBtn').on('click', function(e){

    e.preventDefault();

    var checkGroup = "checkUserGroup";
    var joinGroup = "joinGroup";
    var groupNameChosen = $(this).closest("form").find("input").val();
    var actionType = "joinGroup";

    if (groupNameChosen == "")
    {
      // $('#groupNameRequired').html(" *Group Name cannot be empty, please try again.");
      alert("Group Name cannot be empty, please try again.");

    }
    else
    {   

         $.ajax({

              url : 'likeDislike.php',
              type : 'POST',
              data : {
                'groupName'   : groupNameChosen,
                'joinGroup'  : checkGroup
              },
              
              success : function(data) {   
                
                var returnData = parseInt(data);
               if(returnData == 0)
               {
                alert("Group name chosen does not exist. Please check your input.");
               }
               else if (returnData == 3)
               {
                alert("You are already a member of this group. Please choose a new group to join.");
               }
               else
               {
                alert("You have successfully joined the group.");
               }

              }
        }) 

    }

  });




  // $('.commentButton').on('click', function(e){
  //      e.preventDefault();  
    
  //   var userInput = $(this).closest("form").find("input").val();
  //   var messageIdCommentedAt = $(this).val();
  //   var userCommented = "usercommented";

  //   if (userInput == "")
  //   {
  //     alert("comments cannot be empty, please try again.");
  //   }
  //   else {
     
  //        $.ajax({

  //             url : 'likeDislike.php',
  //             type : 'POST',
  //             data : {
  //               'commentInput' : userInput, 
  //               'messIdComment' : messageIdCommentedAt, 
  //               'userCommented' : userCommented
  //             },
              
  //             success : function(data) {   
  //               var userInfo = data;
  //               userInfo = data.split('|');
  //                location.reload();
               
  //             }
  //       })  

  //   }


  // });




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

