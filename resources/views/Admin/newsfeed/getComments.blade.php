<style>
    .comments-comment-social-bar__vertical-divider {
    height: 16px;
    border-left: 1px solid black;
}

</style>
@foreach($comments as $comment)
  @php
     $user = App\Models\user::where('id',$comment->comment_id)->first();

     $Jobrole = App\Models\Jobrole::where('id',$user->Jobrole_id)->first();
     $user_id = Auth::user()->id;
     $Authuser = App\Models\user::where('id',$user_id)->first();

     $likes = App\Models\FeedComment::where('id', $comment->id)->first();
        if ($likes) {
            $likedata = json_decode($likes->likes, true);
        }

        $replys = json_decode($comment->parent_id);
        $replysparentCount = is_array($replys) ? count($replys) : 0;
        $reply_text = json_decode($comment->reply_text);
        $replyCount = is_array($reply_text) ? count($reply_text) : 0;
  @endphp
<div class="row comments-list">
    <div class="col-sm-1 my-2">
        <img class="img-fluid img-responsive rounded-circle mr-2"  src="{{asset($user->img_path)}}" onerror="this.src='https://cdn-icons-png.flaticon.com/512/149/149071.png'"  alt="User 2">
    </div>
    <div class="col-sm-11" style=" background-color: #f2f2f2;">
        <div class="my-2 col-sm-6">
            <h3><strong>{{$user->firstname}} {{$user->lastname}}</strong> </h3>
            <p>{{$Jobrole == null ? ' '  : $Jobrole->role_name }}</p>
            <h6>{{$comment->text}} </h6>    
        </div>
        <div class ="col-sm-2">
            <p>{{ $comment->created_at->diffForHumans(null, true) }}</p>
        </div>
    </div>
    <div class="like-comment-news  col-sm-4" style="padding-left: 45px;padding-right:101px;position: relative;top: -11px;right: -38px;">
        @if($likedata)
            @if (is_array($likedata) && in_array($user_id, $likedata))   
                <a data-comment_id="{{$comment->id}}" class="comment-like likecomm-{{$comment->id}} " style="cursor: pointer;color: #289ed7;" ><i class="fa-solid fa-thumbs-up"></i>Like {{$replysparentCount}}</a>
            @else
            <a data-comment_id="{{$comment->id}}" class="comment-like likecomm-{{$comment->id}} " style="cursor: pointer;"><i class="fa-solid fa-thumbs-up"></i>Like {{$replysparentCount}}</a>
            @endif  
        @else
            <a data-comment_id="{{$comment->id}}" class="comment-like likecomm-{{$comment->id}}" style="cursor: pointer;"><i class="fa-solid fa-thumbs-up"></i>Like  {{$replysparentCount}}</a>
        @endif  
        <div class="comments-comment-social-bar__vertical-divider"></div>
         <a  class="comments-box-reply" style="cursor: pointer;" data-comment_id="{{$comment->id}}" id="show-comments-reply-{{$comment->id}}">Reply  {{$replyCount}}</a>  
    </div>
            <div class="coment-bottom " id="comment-section-reply-{{$comment->id}}" style=" width: 70%; position: relative; left: 11%;display: none;">
                <div class="d-flex flex-row add-comment-section-reply ">
                    <img class="img-fluid img-responsive rounded-circle mr-2" src="{{asset($Authuser->img_path)}}" onerror="this.src='https://i.imgur.com/t9toMAQ.jpg'" width="38" style="margin-right: 5px;">
                    <input type="text" class="form-control mr-3" id="comment-reply-input-{{$comment->id}}" placeholder="Add comment" style="margin-right: 5px;">
                    <button class="btn btn-primary" id="submit-reply-comment-{{$comment->id}}"  type="button" >Reply</button>
                </div>
                <div class="post-comments-reply">
                    <div id="get-comments-reply-{{$comment->id}}">

                    </div>
                </div>
            </div>
</div>
<br>
@endforeach
<a id="load-more-comments" style="cursor: pointer;">Load More</a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
    $(".comment-like").click(function() {
        var comment_id = $(this).data('comment_id');
        var url = "{{ route('newsfeed.commentLike') }}";
        if (comment_id) {
            $.ajax({
                type: "GET",
                url: url,
                data: { comment_id: comment_id },
                success: function(response) {
                    if (response.status === "liked") {
                        $('.likecomm-' + comment_id).css('color', '#289ed7');
                    } else {
                        $('.likecomm-' + comment_id).css('color', ''); 
                    } 
                    console.log('response', response);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    });
  
});
</script>
<script>
$(document).ready(function() {
    $(".comments-box-reply").click(function() {
        var comment_id = $(this).data('comment_id');
        $("#comment-section-reply-" + comment_id).toggle();
    });
});
</script>
<script>
    $(document).ready(function() {
      $(".comments-box-reply").click(function() {   
           var comment_id = $(this).data('comment_id');  
           loadReply(comment_id);
          $("#submit-reply-comment-"+comment_id).on("click", function() {
              var commentText = $("#comment-reply-input-"+comment_id).val();
              console.log('commentText',commentText,'comment_id',comment_id);
              var url = "{{Route('newsfeed.CommentReplySubmit')}}"; 
              if (commentText) {
                  $.ajax({
                      type: "GET",
                      url: url, 
                      data: { comment_id: comment_id ,commentText:commentText },
                      success: function(response) {
                        loadReply(comment_id);
                          $("#comment-reply-input-"+comment_id).val("");
                      }
                  });
              }
          });  
      });

  function loadReply(comment_id) {
    var url = "{{Route('newsfeed.CommentReplyGet')}}"
        $.ajax({
            type: "GET",
            url: url, 
            data: { comment_id: comment_id},
            success: function(response) {
                $("#get-comments-reply-"+comment_id).html(response);
            }
        });
    }
});

</script>
    

