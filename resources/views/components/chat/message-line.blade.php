<style>
    
    .chat-view-mid-r .chat-mid-user{
        flex-direction: row-reverse
    }
    .chat-mid-user img{
        border-radius: 50px;
    }
    
    .chat-mid-user h2{
        margin-bottom: 6px;
        padding: 0;
        color: #0d6efd;
        font-weight: 600;
    }
    .chat-mid-text p{
        color: #333333;
        margin: 0;
    }
    .chat-view-mid-r span.chat-time{
        left: 7px;
        right: unset;
    }
    span.chat-time{
        font-size: 9px !important;
        position: absolute;
        right: 7px;
        bottom: 4px;
    }
    .chat-mid-text{
        padding: 0;
    }
    .chat-view-mid-l{
        display: flex;
        align-items: flex-start;
        gap: 8px;
        min-width: 50%;
        max-width: 75%;
    }
    .chat-view-mid-l > div{
        width: 100%;
        padding: 6px 8px 16px 8px;
        background: #d8d8d8;
        border-radius: 6px;
        position: relative;
        color: #333333;
    }
    .chat-view-mid-l > div::before {
        content: "";
        /* width: 12px; */
        /* height: 12px; */
        /* background: red; */
        display: block;
        position: absolute;
        top: 0;
        left: -12px;
        border-color: transparent;
        border-top-color: #d8d8d8;
        border-width: 12px;
        border-style: solid;
    }
    .chat-view-mid-l.chat-view-mid-r p{
        margin-bottom: 0;
    }
    .chat-view-mid-l.chat-view-mid-r .chat-mid-user h2{
        padding: 0
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

    .chat-mid-user .dropdown i{
        cursor: pointer;
        font-size: 12px;
        vertical-align: text-top;
    }

    .chat-mid-user .dropdown .dropdown-menu{
        padding: 0;
    }

    .chat-mid-user .dropdown .dropdown-menu{
        padding: 0;
    }

    .chat-mid-user .dropdown .dropdown-menu .dropdown-item{
        font-size: 13px;
        padding-top: 4px;
        padding-bottom: 4px;
    }

    .chat-mid-text .chat-attachment{
        color: #f34646;
        display: block;
        font-size: 13px;
        padding: 6px 0;
        letter-spacing: 0.2px;
        font-weight: 500;
    }
    .chat-image{
        border-radius: 8px;
        margin-bottom: 3px;
    }
    
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
    <img src="{{ $profileImg6 }}">
    <div>
        <div class="chat-mid-user d-flex justify-content-between">
            <h2>{{$conversation->user->firstname}}</h2>
            @if($delete && $conversation->user_id == auth()->id() && is_null($conversation->deleted_at))
                <div class="dropdown">
                    {{-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown button
                    </button> --}}
                    <i class="fa-solid fa-chevron-down" data-bs-toggle="dropdown"></i>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{route('conversation.delete', $conversation->id)}}">Delete</a></li>
                    </ul>
                </div>
            @endif
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
            {{-- <span class="chat-delete">
                @if($delete && $conversation->user_id == auth()->id() && is_null($conversation->deleted_at))
                    <a href="{{route('conversation.delete', $conversation->id)}}">
                        <i class="bi bi-trash"></i>
                    </a>
                @endif
            </span> --}}
            <div class="row">
                @if($conversation->images)
                    @forelse(json_decode($conversation->images, true) as $image)
                        <div class="col-12">
                            <img src="{{asset($image)}}" alt="" class="chat-image">
                        </div>
                    @empty
                    @endforelse
                @endif
                @if($conversation->attachments)
                    @forelse(json_decode($conversation->attachments, true) as $attachment)
                        <div class="col-12">
                            <a class="chat-attachment" href="{{asset($attachment['path'])}}" download="{{$attachment['original_filename']}}"><i class="bi bi-download"></i> {{$attachment['original_filename']}} </a>
                        </div>
                    @empty
                    @endforelse
                @endif
            </div>
        </div>
    </div>
</div>
@empty
<p class="text-center" id="no-count">No Message Here</p>
@endforelse