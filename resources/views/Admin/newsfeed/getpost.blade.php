<style>
  .more-text {
    display: none;
}

.read-more-button {
    cursor: pointer;
    color: blue;
}
.post {
    background: #fff;
    border: 1px solid #e0e0e0;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.post-content p {
    font-size: 18px;
    line-height: 1.5;
    margin: 0;
}

.post-comments h2 {
    margin: 20px 0;
    font-size: 24px;
}

.comments-list {
    list-style: none;
    padding: 0;
}

.comment {
    display: flex;
    margin: 20px 0;
}

.comment-avatar img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
}

.comment-content p {
    font-size: 16px;
    margin: 0;
}

.comment-content strong {
    font-weight: bold;
}
</style>
<style>
  span.tag.label.label-info {
    color: black;
    background-color: #5bc0de;
    margin-right: 2px;
    color: white;
    display: inline;
    padding: 0.2em 0.6em 0.3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25em;  
}


.searchResults {
    /* height: 300px; */
    overflow-y: auto;
    overflow-x: auto;
    background-color: #fff;
    border: 1px solid #dfe6ec;
    box-shadow: 0 0.125rem 0.375rem rgb(0 0 0 / 10%);
    z-index: 10;
}
.searchResults__list {
    margin: 0;
    padding: 0;
    list-style: none;
}
.cyc-searchResultsCTA {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
    box-shadow: 0 -0.25rem 0.25rem rgb(0 0 0 / 5%);
    border-top: 1px solid #dfe6ec;
    border-bottom: 1px solid #dfe6ec;
}

.searchResults__list {
    margin: 0;
    padding: 0;
    list-style: none;
}
 
.cyc-searchResultsItem {
    align-items: center;
    background-color: #fff;
    display: flex;
    flex-wrap: nowrap;
    list-style-type: none;
    padding: 0.75rem;
    position: relative;
}
.cyc-searchResultsItem__logo {
    border-radius: 50%;
    height: 100%;
    margin-right: 0.5rem;
    max-height: 3.125rem;
    max-width: 3.125rem;
    width: 100%;
}
.cyc-searchResultsItem__titleWrapper {
    flex-grow: 1;
}
.cyc-searchResultsItem__title {
    margin-top: 0;
    margin-bottom: 0;
}
.cyc-searchResultsItem__subTitle {
    color: #616668;
    margin-top: 0;
    margin-bottom: 0;
}
.btn-sm {
    padding: 0.5rem;
    font-size: .875rem;
    line-height: 1;
    border-radius: 0.2rem;
}
.cyc-searchResultsItem__claimed {
    color: #a4acb3;
}
.icon {
    display: inline-block;
    width: 1em;
    height: 1em;
    vertical-align: -0.125em;
    fill: currentColor;
}
.cyc-searchResultsCTA {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
    box-shadow: 0 -0.25rem 0.25rem rgb(0 0 0 / 5%);
    border-top: 1px solid #dfe6ec;
    border-bottom: 1px solid #dfe6ec;
}
.login-page {
  max-width: 450px;
  width: 95%;
  background: #fff;
  padding: 50px;
  border-radius: 10px;
  max-height: calc(100vh - 50px);
}
input.choices__input.choices__input--cloned {
    height: 0;
    width: 0;
    padding: 0;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    background: transparent;
    bottom: 0;
    color: transparent;
    cursor: pointer;
    height: auto;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: auto;
}
  .input-wrapper {
      margin: 10px 0;
  }
  .hue-web__artdeco-migration-scope--revert, :root {
    --artdeco-typography-mono: SF Mono,Consolas,Roboto Mono,Noto Mono,Droid Mono,Fira Mono,Ubuntu Mono,Oxygen Mono,Lucida Console,Menlo,Monaco,monospace;
    --artdeco-typography-sans: -apple-system,system-ui,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Fira Sans,Ubuntu,Oxygen,Oxygen Sans,Cantarell,Droid Sans,Apple Color Emoji,Segoe UI Emoji,Segoe UI Emoji,Segoe UI Symbol,Lucida Grande,Helvetica,Arial,sans-serif;
    --artdeco-typography-serif: Noto Serif,Droid Serif,Georgia,serif;
    --artdeco-typography-ar: Arabic UI Display,Geeza Pro,Simplified Arabic,var(--artdeco-typography-sans);
    --artdeco-typography-ja: Meiryo,Yu Gothic,Hiragino Kaku Gothic Pro,Hiragino Sans,var(--artdeco-typography-sans);
    --artdeco-typography-ko: Malgun Gothic,Apple SD Gothic Neo,var(--artdeco-typography-sans);
    --artdeco-typography-th: Leelawadee,Thonburi,var(--artdeco-typography-sans);
    --artdeco-typography-zh: Microsoft Yahei,PingFang SC,PingFang TC,Hiragino Sans,Hiragino Kaku Gothic Pro,var(--artdeco-typography-sans);
    --artdeco-typography-hi: Kohinoor Devanagari,Mangal,var(--artdeco-typography-sans);
}
.container-post {
  position: relative;
  text-align: center;
}
.centered {

  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.text-block {
  background-color: black;
  color: white;
  padding: 40px;
  opacity: 0.8;
  font-size: 40px
}
*,
*::before,
*::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.gallery {
  column-count: 4;
  --webkit-column-count: 4;
  --moz-column-count: 4;
  gap: 1rem;
  padding: 4rem;
}

.image img {
  height: auto;
  width: 100%;
}

/* Responsive-ness for different screen-sizes */
@media screen and (max-width: 810px) {
  .gallery {
    column-count: 3;
    --webkit-column-count: 3;
    --moz-column-count: 3;
  }
}

@media screen and (max-width: 500px) {
  .gallery {
    column-count: 2;
    --webkit-column-count: 2;
    --moz-column-count: 2;
  }
}

@media screen and (max-width: 400px) {
  .gallery {
    column-count: 1;
    --webkit-column-count: 1;
    --moz-column-count: 1;
  }
}


</style>

@foreach($sorted_posts as $key=> $post)
                             @php
                               if($post){
                                  $company =  App\Models\Company::with('user')->where('id',$post->company_id)->where('user_id',$post->user_id)->first();
                                  $user_id = Auth::user()->id;
                                  $user = Auth::user();
                                  $authCampany = App\Models\Company::with('user')->where('id',$user->company_id)->first();
                                  $follows= App\Models\Follows::where('user_id',$user_id)->where('company_id',$authCampany->id)->where('follow_id',$post->company_id)->first();
                                  $likesAuth = App\Models\FeedLike::where('news_feed_id',$post->id)->where('company_id',$post->company_id)->where('like_id',$user_id)->where('status','1')->first();
                                  $likes = App\Models\FeedLike::where('news_feed_id',$post->id)->where('company_id',$post->company_id)->where('user_id',$post->user_id)->where('status','1')->pluck('like_id')->toArray();
                                  $userLikes = App\Models\user::whereIn('id',$likes)->get(); 
                                  $companyprofile = App\Models\CompanyProfile::where('company_id',$post->company_id)->first();
                               }
                             @endphp
                          <div class="col-12 col-md-12 col-xl-12 mb-3 mb-md-0">
                            <div class="news-feed-list">
                              <div class="feed-list-top">
                                <div class="feed-list-topl">
                                  <div class="feed-list-lt">
                                      <img src="{{$companyprofile ? asset($companyprofile->company_logo) : asset('Admin/assets/dist/images/sun.png')}}" alt="icon" class="w-auto img-fluid" style=" position: relative;  width:69px !important; height: 69px; border-radius: 100% !important;">
                                    <div class="feed-list-ltext">
                                      <a style=" color: black;" href="{{ route('company.profile.show', $post->company_id) }}"> {{$company ? $company->company_name : ' '}}</a>
                                      <p><i class="fa-solid fa-user"></i> {{$company ? ($user ? $user->firstname .' '.$user->lastname : ' ') : ' '}}</p>
                                      <b>{{ $post->created_at->format('F j, Y, g:i a') }}</b>
                                    </div>
                                  </div>
                                  <div class="feed-list-follow">
                                    @if($post->company_id != $authCampany->id)
                                        @if($follows)
                                            @if($follows->status == '1') 
                                                <a href="{{Route('newsfeed.following',['follow_id' => $company->id ])}}" class="btn btn-outline-dark m-1 p-1 mt-2" style="height: 40px;">+UnFollow</a></span>
                                              @else
                                                <a href="{{Route('newsfeed.following',['follow_id' => $company->id ])}}" class="btn btn-outline-dark m-1 p-1 mt-2" style="height: 40px;">+Follow</a></span>
                                            @endif 
                                        @else
                                            <a href="{{Route('newsfeed.following',['follow_id' => $company->id ])}}" class="btn btn-outline-dark m-1 p-1 mt-2" style="height: 40px;">+Follow</a></span>
                                        @endif
                                    @endif
                                      <a href="" class="dot-icon text-dark"><i class="bi bi-three-dots-vertical" id="icon"></i></a>
                                  </div>
                                </div>
                                <div class="atg-text-news">
                                  <p>{!! preg_replace('/#(\w+)/', '<span style="color: blue;">#$1</span>', preg_replace('/@(\w+)/', '<span style="color: blue;">@$1</span>', Str::limit($post->description, 200))) !!}</p>

                                  <div class="more-text" >
                                  {!! preg_replace('/#(\w+)/', '<span style="color: blue;">#$1</span>', preg_replace('/@(\w+)/', '<span style="color: blue;">@$1</span>', $post->description)) !!}
                                </div>
                                  <a class="read-more-button">Read More</a>
                                </div>
                                
                                <section class="gallery">
                                    @if (!empty($post->images))
                                        @php
                                            $images = json_decode($post->images);
                                            $imageCount = count($images);
                                        @endphp
                                        @foreach (json_decode($post->images) as $key=>$image)
                                            @if($imageCount == '1')
                                                <div class="row">
                                                    <div class="media-container col-sm-12">
                                                        <img class="media" src="{{ asset($image) }}" style="height: 150px; width:250px;" alt="image" />
                                                    </div>
                                                </div>  
                                            @endif  
                                            @if($imageCount == '2')
                                            <div class="image col-sm-6" > 
                                              <img src="{{ asset($image) }}" style="height: 150px; width:250px;" alt="image" />
                                            </div>
                                          @endif 
                                          @if($imageCount == '3' )
                                            <div class="image col-sm-6">
                                              <img src="{{ asset($image) }}" style="height: 150px; width:250px;" alt="image" />
                                            </div>
                                          @endif 
                                          @if($imageCount == '4' )
                                            <div class="image col-sm-6">
                                              <img src="{{ asset($image) }}" style="height: 150px; width:250px;" alt="image" />
                                            </div>
                                          @endif
                                
                                            @if($imageCount > '5')
                                                @if($key  < '6')
                                                    <div class="media-container container-post">
                                                        <img class="media" src="{{ asset($image) }}" alt="image" />
                                                        @if($key == '5')
                                                            <div class="centered">
                                                                <div class="text-block">+{{$imageCount-6}}</div>
                                                            </div>
                                                        @endif 
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach  
                                    @endif
                                    
                                    @if (!empty($post->videos))
                                        @php
                                            $videos = json_decode($post->videos);
                                            $videoCount = count($videos);
                                        @endphp
                                        @foreach (json_decode($post->videos) as $key=>$video)
                                            @if($videoCount == '1')
                                                <div class="row">
                                                    <div class="media-container col-sm-12">
                                                        <video class="media" autoplay muted playsinline style="height: 150px; width:250px;">
                                                            <source src="{{ asset($video) }}" type="video/mp4">
                                                        </video>
                                                    </div>
                                                </div>  
                                            @endif  
                                            @if($videoCount == '2')
                                            <div class="image col-sm-6">
                                              <video autoplay muted playsinline style="height: 150px; width:250px;">
                                                    <source src="{{ asset($video) }}" type="video/mp4">
                                                </video>
                                            </div>
                                          @endif 
                                          @if($videoCount == '3' )
                                            <div class="image col-sm-6">
                                             <video autoplay muted playsinline style="height: 150px; width: 250px;">
                                                    <source src="{{ asset($video) }}" type="video/mp4">
                                                </video>
                                            </div>
                                          @endif 
                                          @if($videoCount == '4' )
                                            <div class="image col-sm-6">
                                              <video autoplay muted playsinline style="height: 150px; width: 250px;">
                                                    <source src="{{ asset($video) }}" type="video/mp4">
                                                </video>
                                            </div>
                                          @endif
                                
                                            @if($videoCount > '5')
                                                @if($key  < '6')
                                                    <div class="media-container container-post">
                                                        <video class="media" autoplay muted playsinline style="height: 150px; width: 250px;">
                                                            <source src="{{ asset($video) }}" type="video/mp4">
                                                        </video>
                                                        @if($key == '5')
                                                            <div class="centered">
                                                                <div class="text-block">+{{$imageCount-6}}</div>
                                                            </div>
                                                        @endif 
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach  
                                    @endif
                                </section>
                                
                                <div class="like-comment-news">
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#like-list-{{$post->id}}"><i class="fa-solid fa-thumbs-up" ></i>  <span class=" postLineCount-{{$post->id}}" >{{ (is_numeric($post->likes) && $post->likes > 0) ? $post->likes : ' '  }}</span> Likes</a>
                                        <div class="modal fade like-list2" id="like-list-{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="position: fixed;width: 50%;/* position: relative; */left: 25%;top: 20%;">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h2 class="modal-title" id="exampleModalLabel">Reactions</h2>
                                                <button type="button" class="close like-close" data-dismiss="modal" aria-label="Close">X</button>
                                              </div>
                                              <div class="modal-body">
                                                  <div class="company-add-card" style="cursor: pointer;" >
                                                    <ul class="list-group mt-3">
                                                     @foreach($userLikes as $userLike)
                                                        @if($userLike)
                                                             @php
                                                                if($userLike){
                                                                  $Jobrole = App\Models\Jobrole::where('id',$userLike->Jobrole_id)->first();
                                                                }
                                                             @endphp
                                                            <li class="list-group-item">
                                                              <img class="cyc-searchResultsItem__logo" src="{{asset($userLike ? $userLike->img_path : ' ')}}"  onerror="this.src='https://cdn-icons-png.flaticon.com/512/149/149071.png'" alt="company logo">
                                                              <div style="position: relative; left: 11%;margin-top: -8%;">
                                                                <h3 style="font-family: var(--artdeco-typography-sans); font-size: 17px;"><b> 
                                                                  {{$userLike ? $userLike->firstname .' '. $userLike->lastname : ' '}}    
                                                                  </b></h3>     
                                                                <p>                                                     
                                                                    {{$Jobrole ? $Jobrole->role_name  : ' '}}
                                                                </p>
                                                              </div>  
                                                            </li>
                                                          @endif
                                                      @endforeach  
                                                    </ul>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                     <!-- end like list -->
                                  <a href="javascript:void(0);"><i class="fa-solid fa-message"></i> {{$post->comment_count}} Comments</a>
                                </div>
                                <div class="like-comment-news like-comment-newsicon">
                                  @if($likesAuth)
                                    <a  style="cursor: pointer;" class="like " data-like_id="{{$post->id}}"><i class="fa-solid fa-thumbs-up likepost-{{$post->id}}" style="color: #289ed7;"></i>  Likes</a>
                                  @else
                                    <a style="cursor: pointer;"  class="like  " data-like_id="{{$post->id}}"><i class="fa-solid fa-thumbs-up  likepost-{{$post->id}}" ></i> Likes</a>
                                  @endif  
                                  <a href="javascript:void(0);" class="comments-box" data-post_id="{{$post->id}}" id="show-comments-{{$post->id}}"><i class="fa-solid fa-message"></i> Comments</a>
                                  <a href="javascript:void(0);"><i class="fa-solid fa-share-nodes"></i> Share</a>
                                </div>
                                <div class="coment-bottom bg-white p-2 px-4" id="comment-section-{{$post->id}}" style="display: none;">
                                    <div class="d-flex flex-row add-comment-section mt-4 mb-4">
                                        <img class="img-fluid img-responsive rounded-circle mr-2" src="{{asset($user->img_path)}}" onerror="this.src='https://i.imgur.com/t9toMAQ.jpg'" width="38" style="margin-right: 5px;">
                                        <input type="text" class="form-control mr-3" id="comment-input-{{$post->id}}" placeholder="Add comment" style="margin-right: 5px;">
                                        <button class="btn btn-primary" id="submit-comment-{{$post->id}}"  type="button" >Comment</button>
                                    </div>
                                    <div class="post-comments">
                                        <h2>Comments</h2>
                                        <div id="get-comments-{{$post->id}}">

                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
  <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/dist/js/jquery.js"></script>
  <script src="assets/dist/js/custom.js"></script>
  <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<script>
function selectFile() {
    document.getElementById("post-file").click();
}
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
    $(".like").click(function() {
        var like_id = $(this).data('like_id');
        var postLineCount = $('.postLineCount-'+like_id).html();
        console.log('postLineCount',postLineCount);
        var url = "{{ route('newsfeed.feedLike') }}";
        if (like_id) {
            $.ajax({
                type: "GET",
                url: url,
                data: { like_id: like_id },
                success: function(response) {
                    if (response.status === "liked") {
                        $('.likepost-' + like_id).css('color', '#289ed7');
                        $('.postLineCount-'+like_id).html(++postLineCount);
                    } else {
                        $('.likepost-' + like_id).css('color', ''); 
                        $('.postLineCount-'+like_id).html(postLineCount-1);
                    } 
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
$(document).ready(function () {
    $('.read-more-button').click(function () {
        $('.more-text').slideToggle();
        var text = $('.read-more-button').html();
        if(text == 'Read More'){
          $('.read-more-button').html('Show Less');
        }
        else{
          $('.read-more-button').html('Read More');
        }
        
    });
});
</script>
<script>
$(document).ready(function() {
    $(".comments-box").click(function() {
        var post_id = $(this).data('post_id');
        $("#comment-section-" + post_id).toggle();
    });
});
</script>
<script>
    $(document).ready(function() {
      $(".comments-box").click(function() {   
           var post_id = $(this).data('post_id');  
           loadComments(post_id);
          $("#submit-comment-"+post_id).on("click", function() {
              var commentText = $("#comment-input-"+post_id).val();
              console.log('commentText',commentText,'post_id',post_id);
              var url = "{{Route('newsfeed.foodCommentSubmit')}}"; 
              if (commentText) {
                  $.ajax({
                      type: "GET",
                      url: url, 
                      data: { post_id: post_id ,commentText:commentText },
                      success: function(response) {
                          loadComments(post_id);
                          $("#comment-input-"+post_id).val("");
                      }
                  });
              }
          });  
      });

  function loadComments(post_id) {
    var url = "{{Route('newsfeed.foodCommentGet')}}"
      $.ajax({
          type: "GET",
          url: url, 
          data: { post_id: post_id},
          success: function(response) {
              $("#get-comments-"+post_id).html(response);
          }
      });
  }

});
</script>

<script>
    $(document).ready(function () {
        $(".like-close").click(function () {
            $(".like-list2").modal("hide");
        });
    });
</script>

@push('custom-style')
<style>
    .supplier-results,
    #team-member-results {
        max-height: 200px;
        overflow-y: scroll;
    }

    .team-select-one p {
        cursor: pointer;
    }
    
    .media {
        width: 100%;
        height: 100%;
    }
</style>
@endpush