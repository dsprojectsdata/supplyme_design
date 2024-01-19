<div class="col-12 col-md-12 col-xl-12 mb-3 mb-md-0" id="post-id-{{ $ccg_feed->id }}">
    <div class="news-feed-list">
        <div class="feed-list-top">
            <div class="feed-list-topl">
                <div class="feed-list-lt">
                    <img src="{{URL::asset($ccg_feed->user->img_path) ?? asset('Admin/assets/dist/images/table-iconOne.png') }}" alt="icon"
                        class="w-auto img-fluid">
                    <div class="feed-list-ltext">
                        <h3>{{ $ccg_feed->user->firstname . ' ' . $ccg_feed->user->lastname }}</h3>
                        <p><img src="{{ asset('Admin/assets/dist/images/television-icon.svg') }}">
                            {{ $ccg_feed->user->Jobrole_id }}</p>
                        <b>{{ $ccg_feed->created_at->diffForHumans() }}</b>
                    </div>
                </div>
                <div class="feed-list-follow">
                    <a href="javascript::void(0)" class="fo-btn"><img
                            src="{{ asset('Admin/assets/dist/images/plus-icon.svg') }}"> Follow</a>
                    <a href="javascript::void(0)" class="dot-icon"><img
                            src="{{ asset('Admin/assets/dist/images/dot-icon.svg') }}"></a>
                </div>
            </div>
        </div>
        <div class="atg-text-news">
            <p class="atg-text-news-text feed-news-text"> 
                {{substr($ccg_feed->description, 0, 150)}}
                @if(strlen($ccg_feed->description) > 150) 
                    <span class="feed-news-text-dots">...</span>
                    <span class="feed-news-text-moretext">{{substr($ccg_feed->description, 150)}}</span>
                    <a class="feed-news-text-button" href="javascript:void(0)">Read More</a>
                @endif
            </p>
        </div>

        @if ($ccg_feed->primary_image)
            <div class="atg-img-news">
                <img src="{{ asset($ccg_feed->primary_image ?? '') }}" alt="">
            </div>
        @elseif($ccg_feed->video)
            <video width="100%" height="400" controls>
                <source src="{{ asset($ccg_feed->video) }}" type="video/mp4">
                Your browser does not support the video tag.    
            </video>
        @endif
        <div class="like-comment-news">
            <!--<a href="javascript:void(0);" class="like-count" data-type="feed" data-id="{{ $ccg_feed->id }}"><img-->
            <!--        src="{{ asset('Admin/assets/dist/images/like-icon.svg') }}"><span>{{ convertCount($ccg_feed->like_count) }}</span>-->
            <!--    Likes</a>-->
            <!--<a href="javascript:void(0);" class="comment-count"><img-->
            <!--        src="{{ asset('Admin/assets/dist/images/comment-icon.svg') }}"><span>{{ convertCount($ccg_feed->comment_count) }}</span>-->
            <!--    Comments</a>-->
            <a href="javascript:void(0);" class="like-count @if($ccg_feed->likes()->where('user_id', auth()->id())->count()) text-primary @endif" data-type="feed" data-id="{{ $ccg_feed->id }}">
                <!-- <img src="{{ asset('Admin/assets/dist/images/like-icon.svg') }}"> -->
                <i class="bi bi-hand-thumbs-up"></i>
                <span>{{ convertCount($ccg_feed->like_count) }}</span> Likes</a>
            <a href="javascript:void(0);" class="comment-count @if($ccg_feed->comments()->where('user_id', auth()->id())->count()) text-primary @endif">
                <!-- <img src="{{ asset('Admin/assets/dist/images/comment-icon.svg') }}"> -->
                <i class="bi bi-chat-left-text"></i>
                <span>{{ convertCount($ccg_feed->comment_count) }}</span>
                Comments</a>
            <a href="javascript:void(0);"><img src="{{ asset('Admin/assets/dist/images/share-icon.svg') }}">
                Share</a>
        </div>

        <!-- comment -->
        <div class="coal-sup-poll comment-box-top" data-id="{{ $ccg_feed->id }}">
            <p>Comments:</p>
            <div class="feed-comment-form">
                <form class="comment-form" action="{{ route('admin.comment.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ccg_feed_id" value="{{ $ccg_feed->id }}" class="form-control">
                    {{-- <textarea name="comment" class="form-control" placeholder="Enter Comment" rows="2"></textarea> --}}
                    {{-- <input type="text" name="comment" class="form-input" placeholder="Enter Comment"> --}}
                    <div class="form-group my-2 d-flex gap-2">
                        <input type="text" class="form-control" placeholder="Enter Comment" name="comment">
                        <button type="submit" class="btn btn-sm btn-primary m-0 ps-3 pe-3">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
            @if (count($ccg_feed->comments) > 0)
                <div class="feed-comment-box coal-sup-poll" id="comment-feed-{{ $ccg_feed->id }}">
                    @forelse($ccg_feed->comments as $comment)
                        <x-admin.comment.comment :comment=$comment />
                    @empty
                    @endforelse
                </div>
            @endif
        </div>
        <!-- endcomment -->

    </div>
</div>
