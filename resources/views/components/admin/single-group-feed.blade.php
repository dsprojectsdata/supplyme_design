    <?php

$external_link = URL::asset(auth()->user()->img_path) ?? asset('Admin/assets/dist/images/table-iconOne.png');
if (@getimagesize($external_link)) {
    $profileImg1 = URL::asset(auth()->user()->img_path);
} else {
    $profileImg1 = asset('Admin/assets/dist/images/table-iconOne.png');
}

?>
<div class="col-12 col-xl-12 mb-0 mb-xl-3" id="post-id-{{ $ccg_feed->id }}">
    <div class="coal-suplier-post">
        <div class="coal-sup-post">
            <div class="coal-sup-comment">
                <div class="coal-sup-comment-top">
                    <span><img src="{{ $profileImg1 }}"> <b class="dot dot-green"></b></span>
                    <div class="coal-comment-head">
                        <h2>{{ $ccg_feed->user->firstname . ' ' . $ccg_feed->user->lastname }}</h2>
                        <p>{{ $ccg_feed->user->Jobrole_id }}</p>
                        <span>{{ $ccg_feed->created_at->diffForHumans() }}</span>
                    </div>
                    <!--<a href="" class="dot-menu"><img-->
                    <!--        src="{{ asset('Admin/assets/dist/images/dot-icon.svg') }}"></a>-->
                    @if($ccg_feed->user_id == auth()->id())
                    <a href="{{route('admin.group-feed.delete', $ccg_feed->id)}}" data-id="{{$ccg_feed->id}}" class="dot-menu delete-feed">
                        <!-- <img src="{{ asset('Admin/assets/dist/images/trash-icon.svg') }}"> -->
                        <i class="fa fa-trash"></i>
                    </a>
                    @endif
                </div>
                <div class="coal-sup-comment-content">
                    {{-- <p>{{substr($ccg_feed->description, 0, 50)}} @if(strlen($ccg_feed->description)>50) ... <a href="javascript::void(0)">See More</a> @endif</p> --}}
                    <p class="atg-text-news-text feed-news-text"> 
                        {{substr($ccg_feed->description, 0, 150)}}
                        @if(strlen($ccg_feed->description) > 150) 
                            <span class="feed-news-text-dots">...</span>
                            <span class="feed-news-text-moretext">{{substr($ccg_feed->description, 150)}}</span>
                            <a class="feed-news-text-button" href="javascript:void(0)">Read More</a>
                        @endif
                    </p>
                    <!-- show questionnaire link-->
                    @if ($ccg_feed->company_id != auth()->user()->company_id)
                        @forelse ($ccg_feed->questionnaires as $questionnaire)
                            <a href="{{route('feed.questionnaire.view', $questionnaire->id)}}" class="show-questionnaire" data-bs-toggle="modal" data-bs-target="#questionnaire-answer-Modal">Questionnaire</a>
                        @empty

                        @endforelse        
                    @else
                        @forelse ($ccg_feed->questionnaires as $questionnaire)
                            <a href="{{route('feed.questionnaire.view', $questionnaire->id)}}" class="show-questionnaire" data-bs-toggle="modal" data-bs-target="#questionnaire-answer-Modal">Questionnaire</a>
                        @empty

                        @endforelse
                    @endif
                    <!-- <div class="coal-sup-poll">
                        <h3>Which is more challenging for an e-commerce business?</h3>
                        <p>You can see how people vote. <a href="">Learn more</a></p>

                        <div class="coal-sup-poll-tx">
                            <p class="pro-zero">Acquiring new customers <b>0%</b></p>
                            <p class="pro-one">Retaining existing ones <b>38%</b></p>
                            <p class="pro-two">Both are equally same <b>65%</b></p>
                        </div>
                    </div> -->
                    @if ($ccg_feed->primary_image)
                        <div class="coal-sup-poll-tx">
                            <div class="coal-sup-pol-img">
                                <img src="{{ asset($ccg_feed->primary_image) }}">
                            </div>
                        </div>
                    @elseif($ccg_feed->video)
                        <video width="100%" height="400" controls>
                            <source src="{{ asset($ccg_feed->video) }}" type="video/mp4">
                            Your browser does not support the video tag.    
                        </video>
                    @endif
                </div>
                <div class="like-comment-news">
                    <!--<a href="javascript:void(0);" class="like-count" data-type="feed" data-id="{{ $ccg_feed->id }}"><img-->
                    <!--        src="{{ asset('Admin/assets/dist/images/like-icon.svg') }}"><span>{{ convertCount($ccg_feed->like_count) }}</span>-->
                    <!--    Likes</a>-->
                    <a href="javascript:void(0);" class="like-count @if($ccg_feed->likes()->where('user_id', auth()->id())->count()) text-primary @endif" data-type="feed" data-id="{{ $ccg_feed->id }}">
                        <!-- <img src="{{ asset('Admin/assets/dist/images/like-icon.svg') }}"> -->
                        <i class="bi bi-hand-thumbs-up"></i>
                        <span>{{ convertCount($ccg_feed->like_count) }}</span>
                        Likes</a>
                    <!--<a href="javascript:void(0);" class="comment-count"><img-->
                    <!--        src="{{ asset('Admin/assets/dist/images/comment-icon.svg') }}"><span>{{ convertCount($ccg_feed->comment_count) }}</span>-->
                    <!--    Comments</a>-->
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
                            <div class="form-group my-2 d-flex gap-2">
                                <input type="text" class="form-control" placeholder="Enter Comment" name="comment">
                                <button type="submit" class="btn btn-sm btn-primary m-0 ps-3 pe-3">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="feed-comment-box coal-sup-poll asd" id="comment-feed-{{ $ccg_feed->id }}">
                        
                            @forelse($ccg_feed->comments as $comment)
                                @if (auth()->user()->company_id == $ccg_feed->company_id ||
                                        $comment->company_id == $ccg_feed->company_id ||
                                        (in_array($comment->company_id, $ccg_feed->ccGroup->connectedSuppliers->pluck('id')->toArray()) &&
                                            auth()->user()->company_id == $comment->company_id))
                                    <x-admin.comment.comment :comment=$comment />
                                @endif
                            @empty
                            @endforelse
                        
                    </div>
                </div>
                <!-- endcomment -->
            </div>
        </div>
    </div>
</div>