@extends('Admin.layout.app')
@section('admincontent')
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
</style>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="main-content px-md-4 px-2 py-4 mess-overflow" style="margin-top:57px">
          <!-- Welcome -->
          <div class="d-block flex-wrap gap-3 welcomeBox">
            <div class="title pb-4 d-flex flex-column w-100 gap-2">
              <h2 class=" position-relative">News Feeds</h2>
              <div class="d-md-flex justify-content-between">
                <p class="pb-2">Manage all your News Feeds here.</p>
              </div>
                @if ($message = Session::get('success'))
                  <div class="alert alert-success alert-top-border alert-dismissible fade show my-4" role="alert">
                      <i class="mdi mdi-check-all me-3 align-middle text-success"></i><strong>Success</strong> - {{$message}}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                @if ($message = Session::get('error'))
                  <div class="alert alert-danger alert-top-border alert-dismissible fade show my-4" role="alert">
                      <i class="mdi mdi-check-all me-3 align-middle text-danger"></i><strong>Error</strong> - {{$message}}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="news-feed-page">
              <div class="row">
                <div class="col-9 col-md-9 col-xl-9 mb-3 mb-md-0">
                    <div class="news-feed-l">
                      <div class="row">
                        <div class="col-12 col-md-12 col-xl-12 mb-3 mb-md-0">
                            <div class="news-feed-top">
                               	<form action="{{ route('newsfeed.store') }}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="news-share">
                                        <img src="{{ asset('Admin/assets/dist/images/table-iconOne.png') }}" alt="icon" class="w-auto img-fluid">
                                        <input type="text" name="description" placeholder="Share Your Post" />
                                    </div>
                                    <div class="news-share-icon">
                                        <a href="javascript:void(0);" onclick="selectImage()">
                                            <input type="file" name="image_files[]" id="image-file" multiple="multiple" accept="image/png, image/gif, image/jpeg" style="display: none;">
                                            <i class="fa-solid fa-image"></i> Photo
                                        </a>
                                        <a href="javascript:void(0);" onclick="selectVideo()">
                                            <input type="file" name="video_files[]" id="video-file" multiple="multiple" accept="video/*" style="display: none;">
                                            <i class="fa-solid fa-video"></i> Video
                                        </a>
                                        <a href="javascript:void(0);" onclick="selectEvent()">
                                            <input type="file" name="event_files[]" id="event-file" multiple="multiple" accept=".ics" style="display: none;">
                                            <i class="fa-regular fa-calendar-check"></i> Events
                                        </a>
                                        <button type="submit" class="btn btn-primary float-end">Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- my post -->
                          <div class="post-show">
                              <div id="loader" style="display: none;">
                                <embed src="{{asset('Admin/assets/output-onlinegiftools (1).gif')}}" type="" style="position: relative;left: 25%;height: 200px;width: 200px;">
                              </div>
  
                          </div>
                          
                      </div>
                       
                    </div>
                </div>
                <div class="col-3 col-md-3 col-xl-3 mb-3 mb-md-0">
                    <div class="news-follow">
                      <h4>Companies to Follow</h4>
                      <p>Follow recommendations based on your activity</p>
                      @if($follow_companies)
                        @foreach($follow_companies as $companyfollow)
                          <div class="feed-list-lt">
                              <img src="{{ asset('Admin/assets/dist/images/table-iconOne.png') }}" alt="icon" class="w-auto img-fluid">
                              <div class="feed-list-ltext">
                                <h3>{{$companyfollow->company_name}}</h3>
                                <p><i class="fa-solid fa-display"></i> {{$companyfollow->company_category}}</p>
                                <b>{{ $companyfollow->created_at->diffForHumans(null, true) }}</b>
                              </div>
                          </div>
                        @endforeach  
                      @else
                      <p>Follow recommendations based on your activity</p>
                      @endif
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>       
        
        </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var page = 1; 
    var isLoading = false; 

    function showLoader() {
        $('#loader').show();
    }

    function hideLoader() {
        $('#loader').hide();
    }

    function loadMoreData() {
        if (!isLoading) {
            isLoading = true;
            showLoader(); // Show the loader while data is loading
            var url = "{{ route('newsfeed.post') }}";
            $.ajax({
                url: url, 
                method: 'GET',
                data: { page: page },
                success: function (data) {
                    if (data.length > 0) {
                        $('.post-show').append(data);
                        page++;
                    }
                    hideLoader(); // Hide the loader after data is loaded
                    isLoading = false;
                },
                error: function () {
                    hideLoader(); // Hide the loader in case of an error
                    isLoading = false;
                }
            });
        }
    }

    $(document).ready(function () {
        loadMoreData(); 
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 200) {
                loadMoreData(); 
            }
        });
    });
</script>

<script>
    function selectImage() {
        document.getElementById('image-file').click();
    }
    function selectVideo() {
        document.getElementById('video-file').click();
    }
    function selectEvent() {
        document.getElementById('event-file').click();
    }
</script>

@endsection