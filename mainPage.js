
$(document).ready(function(){


  	var displayMessages = "displayMessages";
    var welcomeMessage = "<h1><center> Welcome to the Global Group!</center> </h1>";

    $('#welcomeMessage').html(welcomeMessage);
    loadMessages(0, 3);



function loadMessages(page, groupId){
  
  $(".allPostsClass").empty();
  $(".loadMoreGroup").hide();
  $(".loadMore").show();
     $.ajax({

           url : 'server/controller.php',
            type : 'POST',
              data : {
           		
           		 'pagination_data' : displayMessages,
               'groupId' : groupId,
               'page' : page 
 
             },
                                 
             success : function(data) {   
                
                      
                      if (data == "")
                      {
                      
                          str = "<h1 id = 'nopostsClass'> no posts to be displayed. </h1>";
                 
                        $('#allPosts').html(str);

                      }
                      else
                      {
                        var UserType = 0;

                              $.ajax({

                                      url : 'server/controller.php',
                                      type : 'POST',
                                      async: false,
                                      data : {
                                          'getUserType' : 'getUserType'
                                      },
                                      
                                      success : function(data) {   
                                           UserType = parseInt(data);
                                       

                                      }
                              }); 


                      var obj = JSON.parse(data);
                      var messageLength = obj.length;
                      var str ="";
                      var result = null;
                    
                      

                      obj['messages'].forEach(function(e){

                    str+= "<div id = " + e['messageId'] + "globalMessage" + " class='w3-container w3-card w3-white w3-round w3-margin'>";
                
				            	  str+= "<div  >";

                        if (e['ProfilePicture'] == ""){
                                
                             str += "<img src = 'avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
                         }
                        else{
                                 str += "<img src = '" + e['ProfilePicture'] + "' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
                        }
                      	
							         str+= "<span class='w3-right w3-opacity'>" + e['TimeOfPost'] + "</span>";
	                     str+= "<h4>" + e['FirstName'] + " " + e['LastName'] + "</h4>";

                      if(UserType == 1)
                      {
                            str += "<form id = '" + e['messageId'] + "dButton" + "'>";
                                str += "<button style ='float: right;' type='button' class='btn btn-default btn-sm deleteMessageBtn'>";
                                str += "<input type = 'hidden' value = '" + e['messageId'] + "'>";
                                str += "<span class='glyphicon glyphicon-trash'></span> Trash"; 
                                str += "</button><br>";
                            str += "</form>";
                      }

	                    

                       str+= "<p>" + e['message'] + "</p>";

                           $.ajax({

                                   url : 'server/controller.php',
                                   type : 'POST',
                                   async: false,
                                   data : {
                                     'checkIfUserLiked' : 'checkIfUserLiked', 
                                     'messageId' : e['messageId']
                                   },
                                    
                                   success : function(data) {   
                                      result = data;
                                       var UserLiked = data.split('/');
                                       UserLikedCount = UserLiked[0];
                                       userDislikedCount = UserLiked[1];

                                       if(UserLikedCount == '1')
                                       {
                                           //console.log(result);
                                           str += "<i class='fa fa-thumbs-up like-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                           str += "<i class='fa fa-thumbs-o-down dislike-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                           str += "<span class='likes'> Likes:" + e['upVotes'] + " </span>";
                                           str += "<span class='dislikes'>Dislikes: " + e['downVotes'] + " </span>";

                                       }
                                       if(userDislikedCount == '1')
                                       {

                                           str += "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                           str += "<i class='fa fa-thumbs-down dislike-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                           str += "<span class='likes'> Likes:" + e['upVotes'] + " </span>";
                                           str += "<span class='dislikes'>Dislikes: " + e['downVotes'] + " </span>";

                                       }
                                       if(UserLikedCount == '' && userDislikedCount == '')
                                       {
                                           str += "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                           str += "<i class='fa fa-thumbs-o-down dislike-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                           str += "<span class='likes'> Likes:" + e['upVotes'] + " </span>";
                                           str += "<span class='dislikes'>Dislikes: " + e['downVotes'] + " </span>";

                                       }

 
                                   }
              
                          }); 

                           // console.log(e['messageId']);
                            var messageId = e['messageId'];


                             $.ajax({

                                    url : 'server/controller.php',
                                    type : 'POST',
                                    async: false,
                                    data : {

                                      'getComments' : 'getComments',
                                      'messageId'   : e['messageId']

                                    },
                                    
                                    success : function(data) {   
                                     
                                     str += "<button onclick= myFunction('" + messageId + "') class='w3-button w3-white w3-border w3-border-white'><i class='material-icons'>filter_list</i></button>"; 

                                     if(data.length == 0)
                                     {
                                       str += "<div id = '" + messageId + "' class = 'w3-hide w3-container'>";
                                       str += "<div class='a nocommentclass'>";
                                          str += "<p> no comments </p>";
                                       str += "</div>";

                                       str += "</div>";
                                     }
                                     else
                                     {

                                     // str += "<br/>";
                                     // str += "<br/>";
                                     str += "<div  id = '" + messageId + "' class = 'w3-hide w3-container'>";

                                      var commentsObj = JSON.parse(data);
                                      
                                       var numberOfComments = commentsObj['comments']['length'];
                                       
                                        for (var i = 0; i < numberOfComments; i++)
                                        {
                                        
                                              $.ajax({

                                                    url : 'server/controller.php',
                                                    type : 'POST',
                                                    async: false,
                                                    data : {
                                                  
                                                        'getCommenterDetails' : 'getCommenterDetails', 
                                                        'commenterUserId'     : commentsObj['comments'][i]['commentUserId']
                                               
                                                    },
                                          
                                                     success : function(data) {   
                                                        
                                                           var commenterObj = JSON.parse(data);

                                                        //   console.log(commenterObj);



                                                     if(commenterObj['commenter'][0]["FirstName"] == "")
                                                     {
                                                         str += "<img src='avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
                                                         
                                                     }
                                                     else
                                                     {
                                                         str += "<img src=" + commenterObj['commenter'][0]["ProfilePicture"] + " alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
                                                          
                                                     }

                                                          
                                                          
                                                          str += "<h6>" + commenterObj['commenter'][0]['FirstName'] + " " + commenterObj['commenter'][0]['LastName'] + "</h6>";
                                                          str += "<br/>";
                                                   
                                                            
                                                     }
                    
                                             }); 


                               
                                              //str += "<br/>";
                                               str += "<div class='a'>";
                                             
                                                str += "<p>" + commentsObj["comments"][i]['comment'] + "</p>";   
                                             
                                              str += "</div>";

                                        }
                                      

                                     }


                                      
                                    }
                              });


                            
                              str += "<form id =  '" + e['messageId'] + "'  > ";
                                  str += "<aside><input name =" + e['MessageUserId'] +   " placeholder='Type your comment'> </input>" ;
                                  str +=  "<button class='commentButton' value = '"  + e['messageId'] + "' type = 'submit'>Comment</button> </aside>";
                              str += "</form>";
                              

                            str += "</div>";
                            

                            str += "</div>";
                            str += "</div>";
                                           
                            $('#allPosts').html(str);
                          



                      });
                         }
        }

	});

}

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


$(document).on('click', '.deleteMessageBtn', function(e) {
  
  var messageId = $(this).closest("form").find("input").val();
  
  alert('deleteMessageBtn clicked' + messageId);
  

      $.ajax({

        url : 'server/controller.php',
        type : 'POST',
        data : {
            'deleteMessage'  : 'deleteMessage',
            'messageId' : messageId

        },
        
        success : function(data) {   
         
          $('#' + messageId + 'globalMessage').remove();

        }

  });  
 

});


$(document).on('click', '.commentButton', function(e) {

//  $('.commentButton').on('click', function(e){
       e.preventDefault();  
    
    var userInput = $(this).closest("form").find("input").val();
    var messageIdCommentedAt = $(this).val();
    
    

    var userCommented = "usercommented";

    if (userInput == "")
    {
      alert("comments cannot be empty, please try again.");
    }
    else {
       $(this).closest('form').remove();
     
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
                userInfo = data.split('|');
                
                if (userInfo[2] == "")
                {
                    $(".nocommentclass").remove();
                    userInput = escapeHtml(userInput);
                    var e = "<img src='avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'></aside><h6>  " + userInfo[0] + " " + userInfo[1] +"</h6> </br> <div class='a'> <p>" + userInput + "</p></div>";
                
                    $('#' + messageIdCommentedAt).append(e); 

                
                }
                else
                {
                    $(".nocommentclass").remove();
                    userInput = escapeHtml(userInput);
                     var e = "<img src='" + userInfo[2] + "' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'><h6> " + userInfo[0] + " " + userInfo[1] +"</h6> </br> <div class='a'> <p>" + userInput + "</p></div>";
                     e += "<form id =  '" + messageIdCommentedAt + "'  > ";
                         e += "<aside><input placeholder='Type your comment'> </input>" ;
                         e +=  "<button class='commentButton' value = '"  + messageIdCommentedAt + "' type = 'submit'>Comment</button> </aside>";
                     e += "</form>";

                    $('#' + messageIdCommentedAt).append(e); 
                } 

               
              }
        });  

    }


  });



$(document).on('click', '.postMessage', function(e) {
      e.preventDefault();

      var postMessage = escapeHtml(document.getElementById('postMessage').value);
      
      $('#postMessage').val('');
      $('h1#nopostsClass').remove();

      if(postMessage == "")
      {
          alert("Posts cannot be empty. Please try again.");
      }
      else
      {
           $.ajax({

              url : 'server/controller.php',
              type : 'POST',
              async: false,
              data : {                         
                 
                 'postMessage' : postMessage, 
              
              },                           
            
             success : function(data) {   
              
              var latestPost = JSON.parse(data);

              //console.log(latestPost);                                                                                                                 
              
              var str = "";
              str+= "<div id = 'globalPosts' class='w3-container w3-card w3-white w3-round w3-margin'>";        
              str+= "<div  >";
              
              if (latestPost['latestPost'][0]['ProfilePicture'] == ""){
                 
                  str += "<img src = 'avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
              }
              else{

                  str += "<img src = '" + latestPost['latestPost'][0]['ProfilePicture'] + "' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
              }
                        
                       str+= "<span class='w3-right w3-opacity'>" + latestPost['latestPost'][0]['TimeOfPost'] + "</span>";
                       str+= "<h4>" + latestPost['latestPost'][0]['FirstName'] + " " + latestPost['latestPost'][0]['LastName'] + "</h4><br>";
                       str+= "<p>" + latestPost['latestPost'][0]['message'] + "</p>";

                       str += "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id= " + latestPost['latestPost'][0]['messageId'] + " ></i>";
                       str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                       str += "<i class='fa fa-thumbs-o-down dislike-btn likeOrDislike' data-id= " + latestPost['latestPost'][0]['messageId'] + " ></i>";
                       str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                       str += "<span class='likes'> Likes:" + latestPost['latestPost'][0]['upVotes'] + " </span>";
                       str += "<span class='dislikes'>Dislikes: " + latestPost['latestPost'][0]['downVotes'] + " </span>";

                       str += "<button onclick= myFunction('" + latestPost['latestPost'][0]['messageId'] + "') class='w3-button w3-white w3-border w3-border-white'><i class='material-icons'>filter_list</i></button>"; 

                        str += "<div id = '" + latestPost['latestPost'][0]['messageId'] + "' class = 'w3-hide w3-container'>";
                             str += "<div class='a nocommentclass'>";
                                str += "<p> no comments </p>";
                             str += "</div>";
                        str += "</div>";

                        str += "<form id =  '" + latestPost['latestPost'][0]['messageId'] + "'  > ";
                            str += "<aside><input name =" + latestPost['latestPost'][0]['ID'] + " placeholder='Type your comment'> </input>" ;
                            str +=  "<button class='commentButton' value = '"  + latestPost['latestPost'][0]['messageId'] + "' type = 'submit'>Comment</button> </aside>";
                        str += "</form>";


                        $( ".allPostsClass" ).prepend(str);



             }
                    
           }); 

      }




});



$(document).on('click', '.postGroupMessage', function(e) {
     
     e.preventDefault();
   
     var groupId = escapeHtml(document.getElementById('groupIdPostedTo').value);
     var groupMessage = escapeHtml(document.getElementById('groupPostMessage').value);

     $('#groupPostMessage').val('');

     if(groupMessage == "")
     {
      alert("Posts cannot be empty. Please try again.");
     }
     else
     {
          $('h1#nopostsClass').remove();
          $.ajax({

            url : 'server/controller.php',
            type : 'POST',
            async: false,
            data : {
           
              'groupId' : groupId,
              'groupMessagePost' : groupMessage,
              'addGroupMessage' : 'addGroupMessage'
           
            },
            
             success : function(data) {   
               
               var latestPost = JSON.parse(data);

                var str = "";
              str+= "<div id = 'groupPosts' class='w3-container w3-card w3-white w3-round w3-margin'>";        
              str+= "<div  >";
              
              if (latestPost['latestPost'][0]['ProfilePicture'] == ""){
                 
                  str += "<img src = 'avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
              }
              else{

                  str += "<img src = '" + latestPost['latestPost'][0]['ProfilePicture'] + "' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
              }
                        
                       str+= "<span class='w3-right w3-opacity'>" + latestPost['latestPost'][0]['TimeOfPost'] + "</span>";
                       str+= "<h4>" + latestPost['latestPost'][0]['FirstName'] + " " + latestPost['latestPost'][0]['LastName'] + "</h4><br>";
                       str+= "<p>" + latestPost['latestPost'][0]['message'] + "</p>";

                       str += "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id= " + latestPost['latestPost'][0]['messageId'] + " ></i>";
                       str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                       str += "<i class='fa fa-thumbs-o-down dislike-btn likeOrDislike' data-id= " + latestPost['latestPost'][0]['messageId'] + " ></i>";
                       str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                       str += "<span class='likes'> Likes:" + latestPost['latestPost'][0]['upVotes'] + " </span>";
                       str += "<span class='dislikes'>Dislikes: " + latestPost['latestPost'][0]['downVotes'] + " </span>";

                       str += "<button onclick= myFunction('" + latestPost['latestPost'][0]['messageId'] + "') class='w3-button w3-white w3-border w3-border-white'><i class='material-icons'>filter_list</i></button>"; 

                        str += "<div id = '" + latestPost['latestPost'][0]['messageId'] + "' class = 'w3-hide w3-container'>";
                             str += "<div class='a nocommentclass'>";
                                str += "<p> no comments </p>";
                             str += "</div>";
                        str += "</div>";

                        str += "<form id =  '" + latestPost['latestPost'][0]['messageId'] + "'  > ";
                            str += "<aside><input name =" + latestPost['latestPost'][0]['ID'] + " placeholder='Type your comment'> </input>" ;
                            str +=  "<button class='commentButton' value = '"  + latestPost['latestPost'][0]['messageId'] + "' type = 'submit'>Comment</button> </aside>";
                        str += "</form>";


                        $( ".groupPostsClass" ).prepend(str);


              }
              
          });




     }

});




$(document).on('click', '.groupsPage', function (e) {

        e.preventDefault();
        pageStartGroup = 1;
        $('.loadMoreGroup').attr('disabled', false);
      // alert("display group messages called");
        
        $('.loadMore').hide();
        $(".loadMoreGroup").show();
        $( ".allPostsClass" ).empty();
        $("#groupPosts").empty();
        $("#globalPostForum").empty();
        $("#welcomeMessage").empty();

        
        var groupId = escapeHtml($(this).closest("form").find("input[id='groupName']").val());
        $("#groupIdLoad").attr('value', groupId);
         
       

          $.ajax({

              url : 'server/controller.php',
              type : 'POST',
              data : {
                  'getGroupName'  : 'getGroupName',
                  'groupId' : groupId

              },
              
              success : function(data) {   
                  
                var welcomeMessage = "<h1><center> Welcome to " + data + " group! </center> </h1>";

                $('#welcomeMessage').html(welcomeMessage);

              }

        });  

          var str ="";
         
          str += "<div class='w3-row-padding'>";
          str += "<div class='w3-col m12'>";
          str += "<div class='w3-card w3-round w3-white'>";
          str += " <div class='w3-container w3-padding'>";
          str += "<h6 class='w3-opacity'>Share something with the world</h6>";         
    

          str += "<form >";
             str += "<input type='text' id='groupPostMessage' name='groupPostMessage' placeholder='Whats on your mind' contenteditable='true' class='w3-border w3-padding'>";
             str += "<input type = 'hidden' id='groupIdPostedTo' class'groupIdPosted' value = '" + groupId + "'>";
             str += "<button id = 'postButton' name='postTheMessage' type='submit' class='w3-button w3-theme postGroupMessage'><i class='fa fa-pencil'></i>Post</button>";
          str += "</form>";
          str += "</div>";  

          str += "</div>";
          str +=  "</div>";
          str += "</div>";


          $('#groupPostForum').html(str);
          //loadMessages(1, groupId);
          str = "";

          $.ajax({

               url : 'server/controller.php',
               type : 'POST',
               async: false,
               data : {
             
                'pagination_data' : displayMessages,
                'groupId' : groupId,
                'page' : 0 
             
             },
                                 
             success : function(data) {   


                      if (data == "")
                      {
                      
                          str = "<h1 id = 'nopostsClass'> no posts to be displayed. </h1>";
                 
                        $('#groupPosts').html(str);

                      }
                      else
                      {

                      var obj = JSON.parse(data);
                      var messageLength = obj.length;
                      
                      var result = null;

                      obj['messages'].forEach(function(e){

                    str+= "<div id = 'groupMessages' class='w3-container w3-card w3-white w3-round w3-margin'>";
                      
                        str+= "<div  >";

                        if (e['ProfilePicture'] == ""){
                                
                             str += "<img src = 'avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
                         }
                        else{
                                 str += "<img src = '" + e['ProfilePicture'] + "' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
                        }
                        
                       str+= "<span class='w3-right w3-opacity'>" + e['TimeOfPost'] + "</span>";
                       str+= "<h4>" + e['FirstName'] + " " + e['LastName'] + "</h4></br>";
                       str+= "<p>" + e['message'] + "</p>";

                           $.ajax({

                                   url : 'server/controller.php',
                                   type : 'POST',
                                   async: false,
                                   data : {
                                     'checkIfUserLiked' : 'checkIfUserLiked', 
                                     'messageId' : e['messageId']
                                   },
                                    
                                   success : function(data) {   
                                      result = data;
                                       var UserLiked = data.split('/');
                                       UserLikedCount = UserLiked[0];
                                       userDislikedCount = UserLiked[1];

                                       if(UserLikedCount == '1')
                                       {
                                           //console.log(result);
                                           str += "<i class='fa fa-thumbs-up like-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                           str += "<i class='fa fa-thumbs-o-down dislike-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                           str += "<span class='likes'> Likes:" + e['upVotes'] + " </span>";
                                           str += "<span class='dislikes'>Dislikes: " + e['downVotes'] + " </span>";

                                       }
                                       if(userDislikedCount == '1')
                                       {

                                           str += "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                           str += "<i class='fa fa-thumbs-down dislike-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                           str += "<span class='likes'> Likes:" + e['upVotes'] + " </span>";
                                           str += "<span class='dislikes'>Dislikes: " + e['downVotes'] + " </span>";

                                       }
                                       if(UserLikedCount == '' && userDislikedCount == '')
                                       {
                                           str += "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                           str += "<i class='fa fa-thumbs-o-down dislike-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                           str += "<span class='likes'> Likes:" + e['upVotes'] + " </span>";
                                           str += "<span class='dislikes'>Dislikes: " + e['downVotes'] + " </span>";

                                       }

 
                                   }
              
                          }); 

                           // console.log(e['messageId']);
                            var messageId = e['messageId'];


                             $.ajax({

                                    url : 'server/controller.php',
                                    type : 'POST',
                                    async: false,
                                    data : {

                                      'getComments' : 'getComments',
                                      'messageId'   : e['messageId']

                                    },
                                    
                                    success : function(data) {   
                                     
                                     str += "<button onclick= myFunction('" + messageId + "') class='w3-button w3-white w3-border w3-border-white'><i class='material-icons'>filter_list</i></button>"; 

                                     if(data.length == 0)
                                     {
                                       str += "<div id = '" + messageId + "' class = 'w3-hide w3-container'>";
                                       str += "<div class='a nocommentclass'>";
                                          str += "<p> no comments </p>";
                                       str += "</div>";

                                       str += "</div>";
                                     }
                                     else
                                     {

                                     str += "<div id = '" + messageId + "' class = 'w3-hide w3-container'>";

                                      var commentsObj = JSON.parse(data);
                                      
                                      commentsObj['comments'].forEach(function(e){
                                      //console.log(commentsObj);
                                        
                                              $.ajax({

                                                    url : 'server/controller.php',
                                                    type : 'POST',
                                                    async: false,
                                                    data : {
                                                  
                                                        'getCommenterDetails' : 'getCommenterDetails', 
                                                        'commenterUserId'     : commentsObj['comments'][0]['commentUserId']
                                               
                                                    },
                                          
                                                     success : function(data) {   
                                                        
                                                           var commenterObj = JSON.parse(data);

                                                          // console.log(commenterObj);

                                                     if(commenterObj['commenter'][0]["FirstName"] == "")
                                                     {
                                                         str += "<aside><img src='avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'></aside>";
                                                     }
                                                     else
                                                     {
                                                         str += "<aside><img src=" + commenterObj['commenter'][0]["ProfilePicture"] + " alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'></aside>";
                                                     }

                                                          str += "<h6>" + commenterObj['commenter'][0]['FirstName'] + " " + commenterObj['commenter'][0]['LastName'] + "</h6>";
                                                         
                                                            
                                                     }

                    
                                             }); 
                                        
                                        str += "</br>";

                                        str += "<div class='a'>";

                                            str += "<aside>";
                                                
                                                str += "<p>" + commentsObj["comments"][0]['comment'] + "</p>";
                                                
                                            str += "</aside>";
                                        
                                        str += "</div>";
                                        




                                      });
                                      

                                     }


                                      
                                    }
                              });


                            
                                  

                              str += "<form id =  '" + e['messageId'] + "'  > ";
                                  str += "<aside><input name =" + e['MessageUserId'] +   " placeholder='Type your comment'> </input>" ;
                                  str +=  "<button class='commentButton' value = '"  + e['messageId'] + "' type = 'submit'>Comment</button> </aside>";
                              str += "</form>";
                                

                            str += "</div>";
                            

                            str += "</div>";
                            str += "</div>";
                                           
                            $('#groupPosts').html(str);
                          



                      });
                      }
        }

  });


});



$(document).on('click', '.likeOrDislike', function () {
    
 var post_id = $(this).data('id');
      
    
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

				          var likeCount = parseInt(likesDislikes[0]);
				          var dislikeCount = parseInt(likesDislikes[1]);
				 
				           $clicked_btn.siblings('span.likes').text("Likes: " + likeCount);
				           $clicked_btn.siblings('span.dislikes').text(" Dislikes: " + dislikeCount);
				           $clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');

				           $clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
				         }
				   })

   });


});