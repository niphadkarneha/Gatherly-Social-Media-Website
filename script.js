$(document).ready(function(){

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

