<?php
$id = "";
if($comment->parent_id) {
    $id = "parent-comment-$comment->parent_id";
}

$external_link = URL::asset($comment->user->img_path) ?? asset('Admin/assets/dist/images/table-iconOne.png');
if (@getimagesize($external_link)) {
    $profileImg2 = URL::asset($comment->user->img_path);
} else {
    $profileImg2 = asset('Admin/assets/dist/images/table-iconOne.png');
}

?>

<style>
    .comment-profile-image{
        max-width: 50px;
    }
    .font-16{
        font-size: 16px;
    }
    .feed-created-at{
        font-size: 13px;
        color: #787878;
        margin-top: 4px;
        display: block;
    }
</style>

@if(!$comment->parent_id)
<div class="feed-comment" data-parent="{{$comment->id}}" data-id="{{ $comment->id }}" id="parent-comment-{{$comment->id}}">
    <div class="d-flex align-items-center gap-1">
        <span><img class="comment-profile-image" src="{{ $profileImg2 }}"></span>    
        <h4>
            {{$comment->user->firstname.' '.$comment->user->lastname}}
        </h4>
    </div>
    <p class="mt-2 font-16">
        {{$comment->comment}}
    </p>
    <span class="feed-created-at">{{ $comment->created_at->diffForHumans() }}</span>

    <div class="like-comment-news like-comment-newsicon">
        <!--<a href="javascript:void(0);" class="like-count" data-id="{{ $comment->id }}" data-type="comment"><img src="{{asset('Admin/assets/dist/images/like-icon.svg')}}"><span>{{convertCount($comment->like_count)}}</span> Likes</a>-->
        <!--<a href="javascript:void(0);" class="reply-comment" data-parent="{{$comment->id}}"><img src="{{asset('Admin/assets/dist/images/comment-icon.svg')}}">Reply</a>-->
        <a href="javascript:void(0);" class="like-count @if($comment->likes()->where('user_id', auth()->id())->count()) text-primary @endif" data-id="{{ $comment->id }}" data-type="comment">
            <!-- <img src="{{asset('Admin/assets/dist/images/like-icon.svg')}}"> -->
            <i class="bi bi-hand-thumbs-up"></i>
            <span>{{convertCount($comment->like_count)}}</span> Likes</a>
        <a href="javascript:void(0);" class="reply-comment" data-parent="{{$comment->id}}">
            <i class="bi bi-chat-left-text"></i>    
        <!-- <img src="{{asset('Admin/assets/dist/images/comment-icon.svg')}}"> -->
            Reply</a>
        @if($comment->user_id == auth()->id())
        <a href="{{route('admin.comment.delete', $comment->id)}}" class="delete-comment" data-id="{{$comment->id}}">
            <i class="bi bi-trash"></i>    
        <!-- <img src="{{asset('Admin/assets/dist/images/comment-icon.svg')}}"> -->
            Delete</a>
        @endif
    </div>
</div>
@else
    <div class="feed-comment {{$id}}" style="margin-left: 50px!important;" data-parent="{{$comment->id}}" data-id="{{ $comment->id }}">
    <div class="d-flex align-items-center gap-1">
        <span><img src="{{ $profileImg2 }}"></span>    
        <h4>
            {{$comment->user->firstname.' '.$comment->user->lastname}}
        </h4>
    </div>   
    <p class="mt-2 font-16">
            {{$comment->comment}}
        </p>
        <span class="feed-created-at">{{ $comment->created_at->diffForHumans() }}</span>

        <div class="like-comment-news like-comment-newsicon">
            <!--<a href="javascript:void(0);" class="like-count" data-id="{{ $comment->id }}" data-type="comment"><img src="assets/dist/images/like-icon.svg"><span>{{convertCount($comment->like_count)}}</span> Likes</a>-->
            <a href="javascript:void(0);" class="like-count @if($comment->likes()->where('user_id', auth()->id())->count()) text-primary @endif" data-id="{{ $comment->id }}" data-type="comment">
                <!-- <img src="assets/dist/images/like-icon.svg"> -->
                <i class="bi bi-hand-thumbs-up"></i>
                <span>{{convertCount($comment->like_count)}}</span> Likes</a>
                @if($comment->user_id == auth()->id())
                    <a href="{{route('admin.comment.delete', $comment->id)}}" class="delete-comment" data-id="{{$comment->id}}">
                    <i class="bi bi-trash"></i>    
                    <!-- <img src="{{asset('Admin/assets/dist/images/comment-icon.svg')}}"> -->
                    Delete</a>
                @endif
        </div>
    </div>
@endif
@forelse($comment->childComments as $childComment)

<?php

$external_link1 = URL::asset($childComment->user->img_path) ?? asset('Admin/assets/dist/images/table-iconOne.png');
if (@getimagesize($external_link1)) {
    $profileImg4 = URL::asset($childComment->user->img_path);
} else {
    $profileImg4 = asset('Admin/assets/dist/images/table-iconOne.png');
}

?>
    <div class="feed-comment parent-comment-{{ $comment->id }}" style="margin-left: 50px!important;" data-parent="{{$comment->id}}" data-id="{{ $childComment->id }}">
    <div class="d-flex align-items-center gap-1">
        <span><img src="{{ $profileImg4 }}"></span>    
        <h4>
            {{$childComment->user->firstname.' '.$childComment->user->lastname}}
        </h4>
    </div>
        <p class="mt-2 font-16">
            {{$childComment->comment}}
        </p>
        <span class="feed-created-at">{{ $childComment->created_at->diffForHumans() }}</span>
        <div class="like-comment-news like-comment-newsicon">
            <!--<a href="javascript:void(0);" class="like-count" data-id="{{ $childComment->id }}" data-type="comment"><img src="assets/dist/images/like-icon.svg"><span>{{convertCount($childComment->like_count)}}</span> Likes</a>-->
            <a href="javascript:void(0);" class="like-count @if($childComment->likes()->where('user_id', auth()->id())->count()) text-primary @endif" data-id="{{ $childComment->id }}" data-type="comment">
                <!-- <img src="assets/dist/images/like-icon.svg"> -->
                <i class="bi bi-hand-thumbs-up"></i>
                <span>{{convertCount($childComment->like_count)}}</span> Likes</a>
                @if($childComment->user_id == auth()->id())
                    <a href="{{route('admin.comment.delete', $childComment->id)}}" class="delete-comment" data-id="{{$comment->id}}">
                    <i class="bi bi-trash"></i>    
                    <!-- <img src="{{asset('Admin/assets/dist/images/comment-icon.svg')}}"> -->
                    Delete</a>
                @endif
        </div>
    </div>
@empty
@endforelse