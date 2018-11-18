$(document).ready(function(){


   window.pageTarget = 1;

  $(document).on('click','.loadMore',function(e){
  
   var groupId = document.getElementById('groupIdForPagination').value;
  
  
    var start = pageTarget;

      var groupStatus = 0;
  
      $.ajax({

              url : 'server/controller.php',
              type : 'POST',
              async: false,
              data : {
                  'getGroupInfo' : 'getGroupInfo',
                  'groupId' : groupId
              },
              
              success : function(data) {   
               data = JSON.parse(data);   
               groupStatus = data['groupInfo'][0]['status'];
                    
              }
      });

     





      $.ajax({

           url : 'server/controller.php',
            type : 'POST',
              data : {
              
               'pagination_data' : "displayMessages",
               'groupId' : groupId,
               'page' : pageTarget 
 
             },
                                 
             success : function(data) {   
                pageTarget++;
                      
                      if (data == "")
                      {
                      
                          str = "<h1 id = 'nopostsClass'>You have reached the beginning of the group.</h1>";
                 
                        $('#allPosts').append(str);
                        //$('.loadMore').attr('disabled', 'disabled');

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

                     str+= "<div id = '" + e['messageId'] + "globalMessage" + "' class='w3-container w3-card w3-white w3-round w3-margin'>";
                
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
                                          if(groupStatus == 0)
                                          {
                                           str += "<i class='fa fa-thumbs-up like-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                           str += "<i class='fa fa-thumbs-o-down dislike-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";

                                          }

                                          
                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                          
                                           str += "<span class='likes'> Likes:" + e['upVotes'] + " </span>";
                                           str += "<span class='dislikes'>Dislikes: " + e['downVotes'] + " </span>";

                                       }
                                       if(userDislikedCount == '1')
                                       {

                                          if(groupStatus == 0)
                                          {
                                           str += "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                           str += "<i class='fa fa-thumbs-down dislike-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                          }

                                          

                                           str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                           str += "<span class='likes'> Likes:" + e['upVotes'] + " </span>";
                                           str += "<span class='dislikes'>Dislikes: " + e['downVotes'] + " </span>";

                                       }
                                       if(UserLikedCount == '' && userDislikedCount == '')
                                       {
                                          if(groupStatus == 0)
                                          {
                                             str += "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                             str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                             str += "<i class='fa fa-thumbs-o-down dislike-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
                                          }

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
                                  
                           
                               if(groupStatus == 0)
                               {
                                  str +=  "<button class='commentButton' value = '"  + e['messageId'] + "' type = 'submit'>Comment</button> </aside>";
                               }
                               
                            
                              
                              str += "</form>";
                                

                            str += "</div>";
                            

                            str += "</div>";
                            str += "</div>";
                                           
                           
                          
                           


                      }); $('#allPosts').append(str); 
                         }
        }

  });



  }); // end of on click

window.pageStartGroup = 1;


// $(document).on('click','.loadMoreGroup',function(e){


//    var groupId = parseInt($('#groupIdLoad').val());


//     var start = pageStartGroup;

//       $.ajax({

//            url : 'server/controller.php',
//             type : 'POST',
//             async: false,
//               data : {
              
//                'pagination_data' : "displayMessages",
//                'groupId' : groupId,
//                'page' : pageStartGroup 
 
//              },
                                 
//              success : function(data) {   
//                 pageStartGroup++;
                
                      
//                       if (data == "")
//                       {
                      
//                           str = "<h1 id = 'nopostsClass'>You have reached the beginning of the group.</h1>";
                 
//                         $('#groupPosts').append(str);
//                         $('.loadMoreGroup').attr('disabled', 'disabled');

//                       }
//                       else
//                       {
//                         var UserType = 0;

//                         $.ajax({

//                                 url : 'server/controller.php',
//                                 type : 'POST',
//                                 async: false,
//                                 data : {
//                                     'getUserType' : 'getUserType'
//                                 },
                                
//                                 success : function(data) {   
//                                      UserType = parseInt(data);
                                 

//                                 }
//                         }); 

//                       var obj = JSON.parse(data);
//                       var messageLength = obj.length;
//                       var str ="";
//                       var result = null;


//                       obj['messages'].forEach(function(e){

//                     str+= "<div id = '" + e['messageId'] + "globalMessage" + "' class='w3-container w3-card w3-white w3-round w3-margin'>";
                
//                         str+= "<div  >";

//                         if (e['ProfilePicture'] == ""){
                                
//                              str += "<img src = 'avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
//                          }
//                         else{
//                                  str += "<img src = '" + e['ProfilePicture'] + "' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
//                         }
                        
//                        str+= "<span class='w3-right w3-opacity'>" + e['TimeOfPost'] + "</span>";
//                        str+= "<h4>" + e['FirstName'] + " " + e['LastName'] + "</h4>";
                       
//                        if(UserType == 1)
//                         {
//                             str += "<form id = '" + e['messageId'] + "dButton" + "'>";
//                                 str += "<button style ='float: right;' type='button' class='btn btn-default btn-sm deleteMessageBtn'>";
//                                 str += "<input type = 'hidden' value = '" + e['messageId'] + "'>";
//                                 str += "<span class='glyphicon glyphicon-trash'></span> Trash"; 
//                                 str += "</button><br>";
//                             str += "</form>";
//                         }


//                        str+= "<p>" + e['message'] + "</p>";

//                            $.ajax({

//                                    url : 'server/controller.php',
//                                    type : 'POST',
//                                    async: false,
//                                    data : {
//                                      'checkIfUserLiked' : 'checkIfUserLiked', 
//                                      'messageId' : e['messageId']
//                                    },
                                    
//                                    success : function(data) {   
//                                       result = data;
//                                        var UserLiked = data.split('/');
//                                        UserLikedCount = UserLiked[0];
//                                        userDislikedCount = UserLiked[1];

//                                        if(UserLikedCount == '1')
//                                        {
//                                            //console.log(result);
//                                            str += "<i class='fa fa-thumbs-up like-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
//                                            str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//                                            str += "<i class='fa fa-thumbs-o-down dislike-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
//                                            str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//                                            str += "<span class='likes'> Likes:" + e['upVotes'] + " </span>";
//                                            str += "<span class='dislikes'>Dislikes: " + e['downVotes'] + " </span>";

//                                        }
//                                        if(userDislikedCount == '1')
//                                        {

//                                            str += "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
//                                            str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//                                            str += "<i class='fa fa-thumbs-down dislike-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
//                                            str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//                                            str += "<span class='likes'> Likes:" + e['upVotes'] + " </span>";
//                                            str += "<span class='dislikes'>Dislikes: " + e['downVotes'] + " </span>";

//                                        }
//                                        if(UserLikedCount == '' && userDislikedCount == '')
//                                        {
//                                            str += "<i class='fa fa-thumbs-o-up like-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
//                                            str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//                                            str += "<i class='fa fa-thumbs-o-down dislike-btn likeOrDislike' data-id= " + e['messageId'] + " ></i>";
//                                            str += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//                                            str += "<span class='likes'> Likes:" + e['upVotes'] + " </span>";
//                                            str += "<span class='dislikes'>Dislikes: " + e['downVotes'] + " </span>";

//                                        }

 
//                                    }
              
//                           }); 

//                            // console.log(e['messageId']);
//                             var messageId = e['messageId'];


//                              $.ajax({

//                                     url : 'server/controller.php',
//                                     type : 'POST',
//                                     async: false,
//                                     data : {

//                                       'getComments' : 'getComments',
//                                       'messageId'   : e['messageId']

//                                     },
                                    
//                                     success : function(data) {   
                                     
//                                      str += "<button onclick= myFunction('" + messageId + "') class='w3-button w3-white w3-border w3-border-white'><i class='material-icons'>filter_list</i></button>"; 

//                                      if(data.length == 0)
//                                      {
//                                        str += "<div id = '" + messageId + "' class = 'w3-hide w3-container'>";
//                                        str += "<div class='a nocommentclass'>";
//                                           str += "<p> no comments </p>";
//                                        str += "</div>";

//                                        str += "</div>";
//                                      }
//                                      else
//                                      {

//                                      // str += "<br/>";
//                                      // str += "<br/>";
//                                      str += "<div  id = '" + messageId + "' class = 'w3-hide w3-container'>";

//                                       var commentsObj = JSON.parse(data);
                                      
//                                        var numberOfComments = commentsObj['comments']['length'];
                                       
//                                         for (var i = 0; i < numberOfComments; i++)
//                                         {
                                        
//                                               $.ajax({

//                                                     url : 'server/controller.php',
//                                                     type : 'POST',
//                                                     async: false,
//                                                     data : {
                                                  
//                                                         'getCommenterDetails' : 'getCommenterDetails', 
//                                                         'commenterUserId'     : commentsObj['comments'][i]['commentUserId']
                                               
//                                                     },
                                          
//                                                      success : function(data) {   
                                                        
//                                                            var commenterObj = JSON.parse(data);

//                                                         //   console.log(commenterObj);



//                                                      if(commenterObj['commenter'][0]["FirstName"] == "")
//                                                      {
//                                                          str += "<img src='avatar.jpg' alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
                                                         
//                                                      }
//                                                      else
//                                                      {
//                                                          str += "<img src=" + commenterObj['commenter'][0]["ProfilePicture"] + " alt='avatar' class='w3-left w3-circle w3-margin-right' style='width:50px'>";
                                                          
//                                                      }

                                                          
                                                          
//                                                           str += "<h6>" + commenterObj['commenter'][0]['FirstName'] + " " + commenterObj['commenter'][0]['LastName'] + "</h6>";
//                                                           str += "<br/>";
                                                   
                                                            
//                                                      }
                    
//                                              }); 


                               
//                                               //str += "<br/>";
//                                                str += "<div class='a'>";
                                             
//                                                 str += "<p>" + commentsObj["comments"][i]['comment'] + "</p>";   
                                             
//                                               str += "</div>";

//                                         }
                                      

//                                      }


                                      
//                                     }
//                               });


                            
                                  

//                               str += "<form id =  '" + e['messageId'] + "'  > ";
//                                   str += "<aside><input name =" + e['MessageUserId'] +   " placeholder='Type your comment'> </input>" ;
//                                   str +=  "<button class='commentButton' value = '"  + e['messageId'] + "' type = 'submit'>Comment</button> </aside>";
//                               str += "</form>";
                                

//                             str += "</div>";
                            

//                             str += "</div>";
//                             str += "</div>";
                                           
                           
                          
                           


//                       }); $('#groupPosts').append(str); 
//                          }
//         }

//   });











































//});


























});       //end of document on ready