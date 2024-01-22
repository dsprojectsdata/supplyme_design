<style>
    .news-share{
        padding: 15px 0;
    }
    .news-share img{
        max-width: 50px;
    }
    .create-post-btn{
        right: 0;
    }

    .news-share-icon a label{
        /* position: unset; */
        display: flex;
        align-items: center;
        cursor: pointer;
        color: #888;
        font-size: 0.875rem;
    }

    .news-share-icon a img,
    .news-share-icon a label i{
        margin: 0px 6px 0 0
    }
    
    .news-share-icon a label i{
        font-size: 18px;
    }
    
    .news-share-icon a:hover label{
        color: #518EF0;
    }

    .coal-sup-pol-img{
        /* background: #f8f8f8; */
    }

    .news-share-icon input[type="file"]{
        display: none
    }

</style>

<?php

$external_link = URL::asset(auth()->user()->img_path) ?? asset('Admin/assets/dist/images/table-iconOne.png');
if (@getimagesize($external_link)) {
    $profileImg = URL::asset(auth()->user()->img_path);
} else {
    $profileImg = asset('Admin/assets/dist/images/table-iconOne.png');
}

?>

<div class="accordion accordion-flush" id="accordionFlushExample">
    <!-- form -->
    <form id="news-feed-form" action="{{ route('admin.news-feed.store') }}" enctype="multipart/form-data" method="POST">
        <div class="news-share d-flex gap-2 align-items-center">
            <img src="{{ $profileImg }}" alt="icon" class="w-auto img-fluid">
            @csrf
            <input type="hidden" name="ccg_id" value="">
            <textarea rows="2" name="description" placeholder="Share Your Post" class="form-control" required></textarea>
            <button type="submit" value="Create" class="btn btn-sm btn-primary create-post-btn mr-2 mb-2">Post</button>
        </div>
        <div class="news-share-icon">
            <a href="javascript:void(0);" class="comm-img">
                <input type="file" name="files[]" accept="image/png, image/gif, image/jpeg" id="post-file" multiple="multiple">
                <label for="post-file">
                    <!--<img src="{{asset('Admin/assets/dist/images/photo-icon.svg')}}">-->
                    <i class="bi bi-image"></i>
                    Photo
                </label>
            </a>
            <a href="javascript:void(0);" class="comm-att">
                <input type="file" name="video" accept="video/mp4, video/avi, video/mkv" id="post-video" >
                <label for="post-video">
                    <!--<img src="{{asset('Admin/assets/dist/images/video-icon.svg')}}"> -->
                    <i class="bi bi-camera-video"></i>
                    Video
                </label>
            </a>
            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#newQuestionnaireModal" class="event-icon" id="post-event">
                <label for="post-event">
                    <!--<img src="{{asset('Admin/assets/dist/images/event-icon.svg')}}"> -->
                    <i class="bi bi-calendar4-event"></i>
                    Questionnaire
                </label>
            </a>
        </div>
        {{-- <div class="d-flex justify-content-end">
            <button type="submit" value="Create" class="btn btn-sm btn-primary create-post-btn mr-2 mb-2">Create</button>
        </div> --}}
        <div class="d-flex">
            <div class="post-img-preview">

            </div>
            <div class="post-video-preview">

            </div>
        </div>
        <div id="questionnaire-modal-add" class="d-none">

        </div>
    </form>
    <!-- end -->
    <div class="row gap-3 gap-xl-0 feed-box" id="feed-box">
        @forelse($ccg_feeds as $ccg_feed)
            <x-admin.single-group-feed :singleGroupFeed=$ccg_feed />
        @empty
            <div class="row">
                <div class="col">
                    <p class="text-center">
                        No feed available.
                    </p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@include('Admin.company-group.component.questionnaire')