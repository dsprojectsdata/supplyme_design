<style>
    
    .chat-mid-user img{
        border-radius: 50px;
    }
    
    .chat-mid-user h2{
        margin-bottom: 0;
    }
    .chat-view-mid-l.chat-view-mid-r p{
        margin-bottom: 0;
    }
    
    /*.chat-view-mid-r .chat-mid-user .chat-mid-text p{*/
    /*    width: fit-content;*/
    /*    margin-left: auto;*/
    /*}*/
    
    /*.chat-mid-user span b{*/
    /*    position: absolute;*/
    /*    left: 71.42%;*/
    /*    transform: translate(-50%, 0px);*/
    /*}*/
    
    /*.chat-view-mid-r .chat-mid-user span b{*/
    /*    position: absolute;*/
    /*    left: unset;*/
    /*    right: 71.42%;*/
    /*    transform: translate(50%, 0px);*/
    /*}*/
    
</style>

@forelse($conversations as $conversation)
<?php
    $external_link = url()->asset($conversation->user->img_path);
    if (file_exists($external_link)) {
        $profileImg6 = $external_link;
    } else {
        $profileImg6 = asset('Admin/assets/dist/images/profile.png');
    }

?>
<div class="chat-view-mid-l @if(!$toOthers && auth()->id() == $conversation->user_id) chat-view-mid-r @endif" data-id="{{$conversation->id}}" data-group-id="{{$conversation->group_id}}">
    <div class="chat-mid-user">
        <img src="{{ $profileImg6 }}">
        <h2>{{$conversation->user->firstname}}</h2>
        <span>Buyer</span>
    </div>
    <div class="chat-mid-text" data-id="{{$conversation->id}}">
        <p class="chat-text">
            @if($conversation->deleted_at)
                <i>This message is deleted</i>
            @else
                {{$conversation->message}}
            @endif
        </p>
        <span class="chat-time">{{date('H:i A', strtotime($conversation->created_at))}}</span>
        <span class="chat-delete">
            @if($delete && $conversation->user_id == auth()->id() && is_null($conversation->deleted_at))
                <a href="{{route('conversation.delete', $conversation->id)}}">
                    <i class="bi bi-trash"></i>
                </a>
            @endif
        </span>
        <div class="row">
            @if($conversation->images)
                @forelse(json_decode($conversation->images, true) as $image)
                    <div class="col-12">
                        <img src="{{asset($image)}}" alt="" height="50px" width="50px">
                    </div>
                @empty
                @endforelse
            @endif
            @if($conversation->attachments)
                @forelse(json_decode($conversation->attachments, true) as $attachment)
                    <div class="col-12">
                        <a href="{{asset($attachment['path'])}}" download="{{$attachment['original_filename']}}"><i class="bi bi-download"></i> {{$attachment['original_filename']}} </a>
                    </div>
                @empty
                @endforelse
            @endif
        </div>
    </div>
</div>
@empty
<p class="text-center" id="no-count">No Message Here</p>
@endforelse