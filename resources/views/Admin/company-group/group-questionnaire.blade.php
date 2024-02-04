@push('custom-style')
@endpush
@extends('Admin.layout.app')
@section('admincontent')
<style>
    .dropdown-container {
        display: none;
        padding-left: 8px;
        position: relative;
        width: calc(100% - 20px);
        left: 20px;
        background: none;
    }
    .listing .nav-link {
        border: none !important;
    }
    .dropdown-container .listing .nav-link:hover{
        border: none !important;
    }
    .questionnaire-result-list .dropdown-btn{
        border-top: 1px solid;
        border-radius: 0;
        box-shadow: none !important;
    }
    .questionnaire-result-list .dropdown-btn:first-child{
        border: none;
    }
</style>
<!-- main content section -->
<div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">
    <!-- Welcome -->
    <div class="d-block flex-wrap gap-3 welcomeBox">

        <div class="row">
            <div class="col-12 col-md-5 col-xl-3 mb-3 mb-md-0">
                <div class="border bg-white compnay-tabs-ul" style="border-color:#B4B6BD;">
                    <div class="tabs-ac">
                        <a href="#" class="active">Questionnaire</a>
                    </div>
                    <!-- dropdown tabs with responsers -->
                    <ul class="d-flex flex-column nav nav-tabs questionnaire-result-list listing" id="nav-tabs" role="tablist">
                        @forelse($questionnaires as $questionnaire)
                            <button class="btn btn-sm dropdown-btn text-primary bg-none" type="button">
                                {{ $questionnaire->title }} <i class="fa fa-caret-down"></i>
                            </button>
                            <div class="dropdown-container" style="display: none;">
                                @forelse ($questionnaire->submissions as $submitter) 
                                    <!-- <li> -->
                                        <a id="nav-questionnaire-{{$questionnaire->id}}-{{$submitter->id}}-tab" data-bs-toggle="tab" data-bs-target="#nav-questionnaire-{{$questionnaire->id}}-{{$submitter->id}}" type="button" role="tab" aria-controls="nav-questionnaire-{{$questionnaire->id}}-{{$submitter->id}}" aria-selected="true" href="#" class="nav-link py-3 px-1 questionnaire-group-link data-group-tab-section-{{$questionnaire->id}}-{{$submitter->id}}">
                                            <div class="tab-text">
                                                <b class="group-name">{{$submitter->company_name ?? ''}}</b>
                                            </div>
                                        </a>
                                    <!-- </li> -->
                                @empty
                                    
                                @endforelse
                            </div>
                        @empty
                            <p class="text-center">{{ "No Data Found" }}
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-7 col-xl-9 ">
                <!-- <div class="tabs-questionnaire">
                    <h3>Create Supplier Network Group</h3>
                    <div class="ac-to-p d-none">
                        <ul class="nav nav-tab">
                            <li class="nav-item mx-1" id="group-questionnaire-tab">
                                <a class="nav-link" target="_blank" id="group-questionnaire" href="#">Questionnaire</a>
                            </li>
                            <li class="nav-item mx-1" id="group-feed-tab">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#group-feed" href="#">Feed</a>
                            </li>
                            <li class="nav-item mx-1">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-product" id="group-setting-tab" href="#">Settings</a>
                            </li>
                        </ul>
                    </div>
                </div> -->
                <div class="border bg-white p-3 px-sm-4 py-sm-4 tab-content" id="nav-tabContent" style="border-color:#B4B6BD;">
                    @forelse($questionnaires as $questionnaire)
                        @forelse ($questionnaire->answers as $answer)    
                            <div class="tab-pane fade" id="nav-questionnaire-{{$answer->questionnaire_id}}-{{$answer->company_id}}" role="tabpanel" aria-labelledby="nav-questionnaire-{{$answer->questionnaire_id}}-{{$answer->company_id}}-tab">
                                <x-admin.questionnair-answer :questionnairId="$answer->questionnaire_id" :supplierId="$answer->company_id" />
                            </div>
                        @empty
                            
                        @endforelse
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-script')
<script type="text/javascript">
$(document).ready(function(){
    var dropdown = $('body').find("button.dropdown-btn");
    var i;
    $('div.dropdown-container').css('display', 'none');
    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
});
</script>
@endpush