@extends('Admin.layout.app')
@section('admincontent')
<style>
    input.choices__input.choices__input--cloned {
        height: 0px;
    }
    #chat-info{
        min-height: 50px;
    }
    .saved-suppliers.saved-suppliers-page .chat-view-mid {
        height: calc(100vh - 360px);
    }
    .messages-tab.nav-pills{
        gap: 32px;
    }
    .messages-tab.nav-pills .nav-link{
        color: #888888;
        font-weight: 600;
        border-radius: 0;
        padding-left: 0;
        padding-right: 0;
        font-size: 15px;
        padding-bottom: 5px;
    }
    .messages-tab.nav-pills .nav-link.active{
        background: none;
        font-weight: 600;
        color: #4273E0;
        border-bottom: 2px solid #4273E0;
    }
    
    .rfqs-name-list{
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
    }
    .all-rfq-listing.chat-small, #rfq-chat-list.chat-small{
        height: unset;
        overflow: unset;
        padding: 0;
    }
    .rfq-event-parent{
        height: calc(100vh - 375px);
        overflow: auto;
        padding-right: 10px;
    }
    #rfq-title{
        cursor: pointer;
    }
    
    #rfq-title i::before{
        font-weight: bold !important;
    }
    
    /*Modal*/
    #newMessageModal .modal-dialog{
        max-width: 500px;
    }
    #searched-suppliers li{
        cursor: pointer;
    }
    .input-group>#search-supplier.form-control:focus{
        z-index: unset;
    }
    
    .listing-loader {
        width: 100%;
        height: 100%;
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ffffff9c;
        z-index: 1;
    }
    .chat-view-bott{
        grid-template-columns: 40px 1fr;
        gap: 8px;
    }
    .chat-view-bott img{
        border-radius: 100%;
    }
    .chat-spinner{
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .chat-spinner .spinner-border{
        width: 32px;
        height: 32px;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" />
<link href="{{asset('SuperAdmin/assets/libs/choices.js/public/assets/styles/choices.min.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('SuperAdmin/assets/js/pages/form-advanced.init.js')}}"></script>
<script src="{{asset('SuperAdmin/assets/libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
<!-- main content section -->
<section id="main" class="d-flex flex-column">
   <div class="main-content px-md-4 px-2 py-4" style="margin-top: 57px;">
      <!-- Welcome -->
      <div class="row pb-4">
          <div class="col-3">
              <h2 class=" position-relative">Message</h2>
          </div>
          <div class="col-3 offset-6 text-end">
                <!--<form id="supplier-search" action="{{route('search.supplier')}}" method="get">-->
                <!--    <div class="input-group search-chat">-->
                <!--        <input type="search" name="supplier_name" id="search-supplier" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon">-->
                <!--        <a href="javascript::void(0)"><i class="bi bi-search" id="search-supplier-btn"></i> </a>-->
                <!--    </div>-->
                <!--</form>-->
                <!--<div class="row">-->
                <!--    <div class="col">-->
                <!--        <ul class="list-group" id="searched-suppliers">-->

                <!--        </ul>-->
                <!--    </div>-->
                <!--</div>-->
                <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#newMessageModal"><i class="bi bi-plus-lg"></i> New Message </button>
          </div>
      </div>
        <div class="d-block saved-suppliers saved-suppliers-page">
            <!-- Chatbox -->
            <div class="row chat-list-l">
                <div class="col-12 col-md-3">
                    <div class="">
                        <!--<div class="mess-title">-->
                        <!--    <h3>Messages</h3>-->
                        <!--    <img src="assets/dist/images/message-square.svg">-->
                        <!--</div>-->
                        <div class="input-group search-chat">
                            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                            <a href=""><i class="bi bi-search"></i> </a>
                        </div>
                        <div data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px" class="perfect-scrollbar ps ps--active-y">
                        <!-- tabbing -->
                        <ul class="nav nav-pills mb-3 messages-tab" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="chat-general-tab" data-bs-toggle="pill" data-bs-target="#chat-general" type="button" role="tab" aria-controls="pills-home" aria-selected="true">General</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="chat-group-tab" data-bs-toggle="pill" data-bs-target="#chat-group" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Event</button>
                            </li>
                        </ul>
                        @php
                            $general = 'general';
                            $rfq = 'rfq';
                        @endphp
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="chat-general" role="tabpanel" aria-labelledby="chat-general-tab">
                                <ul class="list-unstyled mb-0 chat-small" id="general-chat-list">
                                    <!-- rfq group -->
                                    <x-admin.message-group :type=$general />
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="chat-group" role="tabpanel" aria-labelledby="chat-group-tab">
                                <div class="rfq-event-parent">
                                    <div class="listing-loader" style="display: none">
                                        <i class="fas fa-circle-notch fa-spin"></i>
                                    </div>
                                    <ul class="list-unstyled mb-0 chat-small all-rfq-listing">
                                        @forelse (auth()->user()->chatRfqs() as $rfqChat)    
                                            <li class="border-bottom rfqs-name-list" id="chat-group-rfq-{{$rfqChat->id}}" data-id="{{$rfqChat->id}}">
                                                <p class="fw-bold mb-0">{{$rfqChat->rfq_name}}</p>
                                                <i class="bi bi-chevron-double-right"></i>
                                            </li>
                                        @empty

                                        @endforelse
                                    </ul>
                                    <div class="event-rfqs-chats" style="display: none">
                                        <h3 class="ch-title" id="rfq-title"><i class="bi bi-chevron-left"></i> LED IPS Monitors</h3>
                                        <ul class="list-unstyled mb-0 chat-small" id="rfq-chat-list">
                                             <!--rfq group -->
                                            <x-admin.message-group :type=$rfq />
                                        </ul>
                                    </div>
                                </div>
                                <!--<ul class="list-unstyled mb-0 chat-small" id="rfq-chat-list">-->
                                    <!-- rfq group -->
                                    <!--<x-admin.message-group :type=$rfq />-->
                                <!--</ul>-->
                            </div>
                        </div>
                        <!-- end tabbing -->

                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 0px; height: 400px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 314px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="chat-view-box">
                        <!-- chat info will display here -->
                        <div id="chat-info">

                        </div>
                        <!-- end -->
                        <div class="chat-view-mid" id="message-box" data-id="">
                        </div>                
                        <div class="chat-view-bott">
                            <img src="{{asset(auth()->user()->img_path ?? 'Admin/assets/dist/images/profile.png')}}">
                            <form id="group-message-form" action="{{route('group.chat.send')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="group_id" id="chat-group-id" value="" required>
                                <div class="chat-view-input">
                                    <input type="text" name="message"/>
                                    <!-- <a href="javascript::void(0)"><img src="{{asset('Admin/assets/dist/images/attach-icon.svg')}}"></a> -->
                                    <!-- <a href="javascript::void(0)"><img src="{{asset('Admin/assets/dist/images/image-icon.svg')}}"></a> -->
                                    <a href="javascript:void(0);" class="comm-chat-img">
                                        <input type="file" name="files[]" accept="image/png, image/gif, image/jpeg" id="post-file" multiple>
                                        <img src="{{asset('Admin/assets/dist/images/image-icon.svg')}}">
                                    </a>
                                    <a href="javascript:void(0);" class="comm-chat-att">
                                        <input type="file" name="attachments[]" accept="application/pdf, application/doc, application/docx" id="post-attachments">
                                        <img src="{{asset('Admin/assets/dist/images/attach-icon.svg')}}">
                                    </a>
                                    <button type="submit" class="ml-5 send-message-btn">Send</button>
                                </div>
                                <div class="d-flex">
                                    <div class="post-img-preview">

                                    </div>
                                    <div class="post-video-preview">

                                    </div>
                                    <div class="post-attachment-preview">

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="p-3">
                        <div data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px" class="perfect-scrollbar ps ps--active-y document-chat">
                            <h3>Documents</h3>
                            <ul class="list-unstyled mb-0" id="group-doc">
                            
                            </ul>
                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 0px; height: 400px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 314px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</section>
<!--- upload drag and drop -->

<!-- Modal Start -->

<div class="modal fade" id="newMessageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <h3>Add new Supplier</h3>
        <form id="supplier-search" action="{{route('search.supplier')}}" method="get" class="pt-3">
            <div class="input-group search-chat">
                <input type="search" name="supplier_name" id="search-supplier" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                <a href="javascript::void(0)"><i class="bi bi-search" id="search-supplier-btn"></i> </a>
            </div>
        </form>
        <div class="row pb-4">
            <div class="col">
                <ul class="list-group" id="searched-suppliers">

                </ul>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal End -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $(function() {
        // fetch suppliers
        $("form#supplier-search").submit(function(e) {
            e.preventDefault();
            $.getJSON($(e.target).attr('action'), {supplier_name: $('input[name=supplier_name]').val()}, function(response){
                $('ul#searched-suppliers').html("");
                response.data.forEach(supplier => {
                    $('ul#searched-suppliers').append(`<li class="list-group-item supplier" data-id="${supplier.id}">${supplier.company_name}</li>`);
                });
            });
        });

        // create chat for suppliers

        $('body').on('click', 'li.supplier', function(e) {
            $('#newMessageModal').modal('hide');
            $('ul#searched-suppliers').html("");
            document.querySelector(`form[id="supplier-search"]`).reset();
            let url = baseUrl + '/admin/supplier/individual-chat/' + $(this).data('id');
            $.getJSON(url, function(response) {
                document.getElementById('general-chat-list').insertAdjacentHTML("beforeend",response.data);
            }).fail(function(xhr) {
                let responseData = xhr.responseJSON.data;
                if (xhr.status == 422) {
                    document.getElementById("chat-general-tab").click();
                    document.querySelector(`li[id="${responseData.identifier}"][data-id="${responseData.id}"]`).click();
                }
            });
        });
        
        $('body').on('click', 'li.rfqs-name-list', function () {
            let url = baseUrl + '/admin/get/rfq-chat-groups/' + $(this).data('id');
            const this_ = $(this);
            $('.listing-loader').show();
            $.getJSON(url, function (response) {
                const RFQName = this_.find('p').text();
                $("body").find('ul#rfq-chat-list').html(response.data);
                $('.event-rfqs-chats').find("h3").html(`<i class="bi bi-chevron-left"></i> ${RFQName}`);
                $('.listing-loader').hide();
                this_.parent().hide();
                $('.event-rfqs-chats').show();
                
            });
        });
        
        $('body').on('click', '#rfq-title', function(){
            $(this).parent().hide();
            $(".all-rfq-listing").show();
        })
    });
</script>

<script>
    const uploadDragBox = document.querySelector('.upload-drag-box');
    const fileNameElement = document.getElementById('fileName');
    const fileInput = document.getElementById('fileInput');

    uploadDragBox.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadDragBox.classList.add('drag-over');
    });

    uploadDragBox.addEventListener('dragleave', () => {
        uploadDragBox.classList.remove('drag-over');
    });

    uploadDragBox.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadDragBox.classList.remove('drag-over');
        fileInput.files = e.dataTransfer.files;
        if (fileInput.files.length > 0) {
            fileNameElement.textContent = fileInput.files[0].name;
        }
    });

    // Listen for file input change event
    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            fileNameElement.textContent = fileInput.files[0].name;
        }
    });
</script>

<script>
  
function getCurrency(currency,currency_name) {
  var autoCompleteResult = currency;
  document.getElementById("currency-options").innerHTML = "";
  for (var i = 0, limit = 5, len = autoCompleteResult.length; i < len  && i < limit; i++) {
    document.getElementById("currency-options").innerHTML += "<a class='list-group-item list-group-item-action' href='#' onclick='setSearch(\"" + autoCompleteResult[i] + "("+currency_name+")\")'>" + autoCompleteResult[i]+ " ("+currency_name+")</a>";
  }
}

function setSearch(currency,currency_name) {
  document.getElementById('bidautocomplete-input').value = currency;
  document.getElementById("currency-options").innerHTML = "";
}

jQuery.noConflict();
jQuery(function($) {
  $('#bidautocomplete-input').autocomplete({
          source: function(request, response) {
          console.log('Autocomplete triggered');
            $.ajax({
                url: "{{route('autocomplete.bidcurrency')}}",
                method: 'GET',
                data: {
                    currency: request.term 
                },

                success: function(data) {
                      console.log('0',data[0]);
                      console.log('1',data[1]);
                  if (data.length === 0) {
                        // response(["currency not available"]);
                    } else {
                      getCurrency(data[0],data[1]) 
                    }
                }
            });
        },
    }).on('keyup', function (event) {
        var inputVal = $(this).val();        
        if (inputVal === '') {
          document.getElementById("currency-options").innerHTML = "";
        }
}); 
});
</script>

<script>
    // Get the file input element
const fileInputBid = document.getElementById("fileInputBid");

// Get the file name display element
const fileNameBid = document.getElementById("fileNameBid");

// Add an event listener to the file input element
fileInputBid.addEventListener("change", function() {
  // Check if a file is selected
  if (fileInputBid.files.length > 0) {
    // Display the selected file name in the file name display element
    fileNameBid.textContent = "Selected File: " + fileInputBid.files[0].name;
  } else {
    // Clear the file name display if no file is selected
    fileNameBid.textContent = "";
  }
});

</script>

@endsection