@extends('Admin.layout.app')
@section('admincontent')
<style>
    .cyc-searchResultsItem__logo {
        border-radius: 50%;
        height: 100%;
        margin-right: -2.5rem;
        max-height: 3.125rem;
        max-width: 3.125rem;
        width: 100%;
        position: relative;
        top: 4px;
}
    .h-pricing-card__discount[data-v-b19b8049] {
    min-height: 32px;
}.h-price[data-v-6508a6ad] {
    display: inline-flex;
}.h-price--text-gray .h-price__currency[data-v-6508a6ad], .h-price--text-gray .h-price__number[data-v-6508a6ad], .h-price--text-gray .h-price__suffix[data-v-6508a6ad] {
    color: #727586;
}

.t-body-strikethrough, .t-price-strikethrough {
    text-decoration-line: line-through;
}
.t-body-2, .t-body-3, .t-body-strikethrough {
    font-size: 14px;
}.h-price--text-gray .h-price__currency[data-v-6508a6ad], .h-price--text-gray .h-price__number[data-v-6508a6ad], .h-price--text-gray .h-price__suffix[data-v-6508a6ad] {
    color: #727586;
}

.t-body-strikethrough, .t-price-strikethrough {
    text-decoration-line: line-through;
}
.t-body-2, .t-body-3, .t-body-strikethrough {
    font-size: 14px;
}.h-pricing-card__discount--tag[data-v-b19b8049] {
    margin-left: 4px;
}
.h-discount-tag-text-danger-dark[data-v-cba67550] {
    color: #d63163;
}
.h-discount-tag-bg-danger-light[data-v-cba67550] {
    background-color: #ffe8ef;
}
.h-discount-tag[data-v-cba67550] {
    border-radius: 20px;
    display: inline-block;
    padding: 4px 12px;
}
.t-body-2, .t-body-3, .t-body-strikethrough {
    font-size: 14px;
}
.t-body-2, .t-body-4, .t-body-uppercase, .t-button, .t-h1, .t-h2, .t-h3, .t-h4, .t-h5, .t-header-currency, .t-header-currency-long, .t-headline-pt, .t-overline, .t-price-header, .t-price-pt, a, b, h1, h2, h3, h4, h5, strong {
    font-weight: 700;
}


@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap");
* {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}


#container {
  background-color: #fff;
  padding: 10px;
  margin: 0 20px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: justify;
  -ms-flex-pack: justify;
  justify-content: space-between;
}

#container .text {
  border: none;
  background: none;
  font-size: 18px;
  font-weight: 400;
}

#container #menu-wrap {
  position: relative;
  height: 25px;
  width: 25px;
}

#container #menu-wrap .dots {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  z-index: 1;
}

#container #menu-wrap .dots > div,
#container #menu-wrap .dots > div:after,
#container #menu-wrap .dots > div:before {
  height: 6px;
  width: 6px;
  background-color: rgba(49, 49, 49, 0.8);
  border-radius: 50%;
  -webkit-transition: 0.5s;
  -o-transition: 0.5s;
  transition: 0.5s;
}

#container #menu-wrap .dots > div {
  position: relative;
}

#container #menu-wrap .dots > div:after {
  content: "";
  position: absolute;
  bottom: calc((25px / 2) - (6px / 2));
  left: 0;
}

#container #menu-wrap .dots > div:before {
  content: "";
  position: absolute;
  top: calc((25px / 2) - (6px / 2));
  left: 0;
}

#container #menu-wrap .menu {
  position: absolute;
  right: -10px;
  top: calc(-12px + 50px);
  width: 0;
  height: 0;
  background-color: rgba(255, 255, 255, 0.8);
  padding: 20px 15px;
  -webkit-box-shadow: 2px 4px 6px rgba(49, 49, 49, 0.2);
  box-shadow: 2px 4px 6px rgba(49, 49, 49, 0.2);
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  -webkit-box-align: start;
  -ms-flex-align: start;
  align-items: flex-start;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  opacity: 0;
  visibility: hidden;
}

#container #menu-wrap .menu ul {
  list-style: none;
}

#container #menu-wrap .menu ul li {
  margin: 15px 0;
}

#container #menu-wrap .menu ul li .link {
  text-decoration: none;
  color: rgba(49, 49, 49, 0.85);
  opacity: 0;
  visibility: hidden;
}

#container #menu-wrap .toggler {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  cursor: pointer;
  z-index: 2;
}

#container #menu-wrap .toggler:hover + .dots > div,
#container #menu-wrap .toggler:hover + .dots > div:after,
#container #menu-wrap .toggler:hover + .dots > div:before {
  background-color: rgba(49, 49, 49, 0.6);
}

#container #menu-wrap .toggler:checked + .dots > div {
  -webkit-transform: translateX(calc(((25px / 2) - (6px / 2)) * -0.7071067812))
    translateY(calc(((25px / 2) - (6px / 2)) * -0.7071067812));
  -ms-transform: translateX(calc(((25px / 2) - (6px / 2)) * -0.7071067812))
    translateY(calc(((25px / 2) - (6px / 2)) * -0.7071067812));
  transform: translateX(calc(((25px / 2) - (6px / 2)) * -0.7071067812))
    translateY(calc(((25px / 2) - (6px / 2)) * -0.7071067812));
}

#container #menu-wrap .toggler:checked + .dots > div:after {
  -webkit-transform: translateX(calc(((25px / 2) - (6px / 2)) * 0.7071067812))
    translateY(calc((2 * (25px / 2) - (6px / 2)) * 0.7071067812));
  -ms-transform: translateX(calc(((25px / 2) - (6px / 2)) * 0.7071067812))
    translateY(calc((2 * (25px / 2) - (6px / 2)) * 0.7071067812));
  transform: translateX(calc(((25px / 2) - (6px / 2)) * 0.7071067812))
    translateY(calc((2 * (25px / 2) - (6px / 2)) * 0.7071067812));
}

#container #menu-wrap .toggler:checked + .dots > div:before {
  -webkit-transform: translateX(
      calc(2 * (((25px / 2) - (6px / 2)) * 0.7071067812))
    )
    translateY(
      calc(((25px / 2) - (6px / 2)) - (((25px / 2) - (6px / 2)) * 0.7071067812))
    );
  -ms-transform: translateX(calc(2 * (((25px / 2) - (6px / 2)) * 0.7071067812)))
    translateY(
      calc(((25px / 2) - (6px / 2)) - (((25px / 2) - (6px / 2)) * 0.7071067812))
    );
  transform: translateX(calc(2 * (((25px / 2) - (6px / 2)) * 0.7071067812)))
    translateY(
      calc(((25px / 2) - (6px / 2)) - (((25px / 2) - (6px / 2)) * 0.7071067812))
    );
}

#container #menu-wrap .toggler:checked:hover + .dots > div,
#container #menu-wrap .toggler:checked:hover + .dots > div:after,
#container #menu-wrap .toggler:checked:hover + .dots > div:before {
  background-color: rgba(49, 49, 49, 0.6);
  -webkit-transition: 0.5s;
  -o-transition: 0.5s;
  transition: 0.5s;
}

#container #menu-wrap .toggler:checked ~ .menu {
  opacity: 1;
  visibility: visible;
  width: 150px;
  height: 140px;
  -webkit-transition: 0.5s;
  -o-transition: 0.5s;
  transition: 0.5s;
}

#container #menu-wrap .toggler:checked ~ .menu ul .link {
  opacity: 1;
  visibility: visible;
  -webkit-transition: 0.5s ease 0.3s;
  -o-transition: 0.5s ease 0.3s;
  transition: 0.5s ease 0.3s;
}

#container #menu-wrap .toggler:checked ~ .menu ul .link:hover {
  color: #2980b9;
  -webkit-transition: 0.2s;
  -o-transition: 0.2s;
  transition: 0.2s;
}

#container #menu-wrap .toggler:not(:checked) ~ .menu {
  -webkit-transition: 0.5s;
  -o-transition: 0.5s;
  transition: 0.5s;
}

#container #menu-wrap .toggler:not(:checked) ~ .menu ul .link {
  opacity: 0;
  visibility: hidden;
  -webkit-transition: 0.1s;
  -o-transition: 0.1s;
  transition: 0.1s;
}

@media (max-width: 600px) {
  #container {
    position: absolute;
    top: 50px;
    width: calc(100% - 40px);
    margin: 0;
  }
}

.progress-bar {
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: hidden;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    background-color: #17c653;
    transition: width .6s ease;
}


</style>
<div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">
    <?php
       $helper = new \App\Helper\Helper();
       $subscriptionHistories = $helper->subscriptionHistories();
    ?>
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
@if($subscriptionHistories)
            <!-- Welcome -->
            <div class="d-block flex-wrap gap-3 welcomeBox">
                <div class="title pb-2 pb-md-4 d-flex flex-column w-100 gap-2">
                  <h2>Welcome back, {{ucfirst(\Auth::guard('web')->user()->firstname)}}</h2>
                </div>  
                <div class="row  border bg-white"  style="border-color:#B4B6BD;">
                        <!-- User Picture -->
                        <div class="col-lg-2 col-md-6 mb-4">
                            <div style="position: relative;top: 14px;border: #f1f3f4 1px solid;height: 100%;">
                                <img  style="position: relative; top: 11px;" src="{{ $ompanyProfile ? asset($ompanyProfile->company_logo) :  asset('Admin/assets/dist/images/sun.png')}}" alt="User Image" class="img-fluid">
                            </div>
                        </div>
                        <!-- User Info -->
                        
                        <div class="col-lg-8 col-md-6 mb-4 my-4">
                            <div class="mb-3">
                                <a href="#" style=" color: black;" class="text-gray-900 text-decoration-none fs-4 fw-bold">{{$company ? ucfirst($company->company_name) : ' '}}</a>
                                <a href="#" class="text-primary fs-2"><i class="bi bi-badge-check-fill"></i></a>
                            </div>
                            <div class="mb-4 ">
                                <div class="d-flex flex-wrap fw-bold fs-6">
                                    <div class="me-5 mb-2 text-muted">
                                        <i class="bi bi-person-circle me-1"></i>
                                        {{$company ? ucfirst($company->company_type) : ' '}}
                                    </div>
                                    <div class="me-5 mb-2 text-muted">
                                        <i class="bi bi-geo-alt-fill me-1"></i>
                                        {{$company ? ucfirst($company->address) : ' '}}  {{$company ? ucfirst($company->address2) : ' '}}
                                    </div>
                                    <div class="mb-2 text-muted">
                                        <i class="bi bi-envelope-fill me-1"></i>
                                        {{$company ? ucfirst($company->company_email) : ' '}}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <div class="col-sm-6">
                                    <p class="text-uppercase" style="font-weight:600; color:#415662;">Collaborators</p> 
                                    <ul class="d-flex pt-2">
                                        @foreach($teams as $key=>$team)
                                           <li><a href="#" class="d-block"><img src="{{ $team->img_path == null ?  asset('Admin/assets/dist/images/profile.png') : asset($team->img_path) }}" alt="img" style=" position: relative; width:35px !important;height:35px; border-radius: 100% !important;"></a>
                                            @if($teams->count() == 5 )
                                                 @if($key == 0)
                                                      <span style="font-size: 24px; position: relative; left: 185px;top: -31px;">+ {{$limitedTeamsCount}}</span>
                                                 @endif
                                               </li>
                                            @endif   
                                           
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                            <span class="fw-semibold fs-6 text-gray-500 text-muted ">Profile Completion</span>
                                            <span class="fw-bold fs-6">50%</span>
                                        </div>
                                        <div class="progress" style="width:100%;">
                                            <div class="progress-bar progress-bar-striped active " style="width:50%;" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                                               50%
                                            </div>
                                      </div>
                                    </div>

                                </div>
                            </div>
                            <div class="mb-2">
                                <a href="#" class="btn btn-primary me-3" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#like-list">
                                    <span>Following  
                                        <!--{{$following ? $following : '0'}} -->
                                    </span>   
                                  <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                </a>
                                <a href="#" class="btn btn-primary me-3" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#like-list2">Followers
                                    <!--{{$followers ? $followers : '0'}}-->
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-1 my-2">
                        <!--    <a href="{{Route('company.profile.show',$company->id)}}" class="btn btn-primary me-3" >-->
                        <!--           <i class="fa fa-eye" aria-hidden="true" ></i>-->
                        <!--    </a>-->
                        </div>
                        <div class="col-sm-1 my-2">
                            <!--<button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">-->
                            <!--    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>-->
                            <!--</button>-->
                            <!--<a href="{{ route('admin.company.profile') }}" class="btn btn-primary me-3" >-->
                            <!--        <i class="fas fa-edit"></i>-->
                            <!--</a>-->
                             <div id="container">
                               
                                <div id="menu-wrap">
                                  <input type="checkbox" class="toggler" />
                                  <div class="dots">
                                    <div></div>
                                  </div>
                                  <div class="menu">
                                    <div>
                                      <ul>
                                        <li><a href="{{ route('admin.company.profile') }}" class="link"><i class="fas fa-edit"></i>  Edit Profile</a></li>
                                        <li><a href="{{Route('company.profile.show',$company->id)}}" class="link"><i class="fa fa-eye" aria-hidden="true" ></i>  View Company </a></li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                </div> 
            </div>
            <!-- Table -->
             <div class="border bg-white my-4 dropdown" style="border-color:#B4B6BD;">
              <div class="d-flex justify-content-between align-items-center px-3 border-bottom" style="border-color:#B4B6BD;">
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active py-3 " id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">RFQ Received</button>
                    <button class="nav-link py-3 " id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">RFQ Sent</button>
                  </div>
                <a href="#" style="font-size:14px; font-weight:600; color: #4574DD;">View All Events</a>
               </div>
              
               <div class="tab-content px-3 py-3" id="nav-tabContent">  
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                  <div class="table-responsive">
                  <table class="table table-striped table-hover my-0 border" style="border-color:#B4B6BD;">
                    <thead style="background: #E2E8EA;">
                      <tr>
                           <th>Title</th>
                           <th>Type</th>
                           <th>Category</th>
                           <th>Company Sender Name</th>
                           <th>Bid Submission Date</th>
                           
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($rfqdetails_received as $rfqdetail)
                               @php
                                
                                  $memberData = $rfqdetail->add_tem_member;
                                  $memberArray = explode(',', $memberData);
                                  $count_member = count($memberArray);
                                
                                  $supplierData = App\Models\RfqSupplierRequest::where('rfqdetail_id',$rfqdetail->id)->get();
                                  $category = App\Models\Category::where('id',$rfqdetail->category_id)->first();
                                  $company_sender_name = App\Models\Company::where('id',$rfqdetail->company_id)->first();
                                @endphp
                            <tr>
                               <td>{{$rfqdetail->rfq_name}}</td>
                               <td>{{$rfqdetail->rfq_type}}</td>
                               <td>{{$category ? $category->name : ' ' }}</td>
                               <td class=" d-xl-table-cell"><a id="companyname" href="{{ route('company.profile.show', ($company_sender_name->id ?? ' ')) }}">{{$company_sender_name->company_name ?? ' '}}</a></td>
                               <td class=" d-md-table-cell">{{date('d-m-Y', strtotime($rfqdetail->bid_submission_deadline)) }}</td>
                               
                            </tr>
                        @endforeach     
                    </tbody>
                  </table>     
                </div>
              </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover my-0 border" style="border-color:#B4B6BD;">
                      <thead style="background: #E2E8EA;">
                        <tr>
                           <th>Title</th>
                           <th>Type</th>
                           <th>Category</th>
                           <th>Supplier </th> 
                           <th >Bid Submission Date</th>
                           <th >Created Date</th>
                           <th >Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($rfqdetails as $key=>$rfqdetail)
                           @php
                              $memberData = $rfqdetail->add_tem_member;
                              $memberArray = explode(',', $memberData);
                              $count_member = count($memberArray);
                              
                              $supplierData = App\Models\RfqSupplierRequest::where('rfqdetail_id',$rfqdetail->id)->get();
                              $category = App\Models\Category::where('id',$rfqdetail->category_id)->first();
                            @endphp
                         <tr>
                           <td>{{$rfqdetail->rfq_name}}</td>
                           <td>{{$rfqdetail->rfq_type}}</td>
                           <td>{{$category == null ? ' ' : $category->name}}</td>
                           <td class=" d-xl-table-cell">{{$supplierData->count()}} </td>
                           <td class=" d-md-table-cell">{{ $rfqdetail->bid_submission_deadline}}</td>
                           <td class=" d-xl-table-cell">{{date('d-m-Y', strtotime($rfqdetail->created_at))}} </td>
                           <td class=" d-md-table-cell"><span class="badge border {{$rfqdetail->status == '1' ? 'border-success  text-success px-md-5' : 'border-info  text-info px-md-5'}}" style="background: #19875414;">{{$rfqdetail->status == '1' ? 'Send' : 'Draft'}}</span></td>
                           <!--<td class=" d-md-table-cell"><span class=" {{$rfqdetail->status == '1' ? ' text-success px-md-5' : ' text-info px-md-5'}}">{{$rfqdetail->status == '1' ? 'Send' : 'Draft'}}</span></td>-->
                           
                        </tr>
                        @endforeach 
                      </tbody>
                    </table>     
                  </div>
                </div>           
              </div>
            </div>
            <!-- Upcoming -->
            <div class="d-block flex-wrap gap-3 upcomingBox">
              <div class="title pb-4 d-flex flex-column w-100 gap-2">
                <h2>Upcoming Tools</h2>
                <p>Here is a glimpse on what new features we will be launching soon!</p>
              </div>  
              <div class="row ">
                <div class="col-12 col-md-4">
                  <div class="d-flex flex-column p-4 bg-white gap-3 text-left">
                    <figure class="icon"><img src="{{asset('Admin/assets/dist/images/icon-store.png')}}" alt="icon" style="width:70px; height:70px;"></figure>
                    <div class="content">
                      <h3 class="text-uppercase pb-1">Online Store</h3>
                      <p class="opacity-25">Browse through our supplier seller pages by
                        category in our upcoming Online Store.</p>
                    </div>
                  </div>
                </div>  
                <div class="col-12 col-md-4 my-3 my-md-0">
                  <div class="d-flex flex-column p-4 bg-white gap-3 text-left">
                    <figure class="icon"><img src="{{asset('Admin/assets/dist/images/icon-data.png')}}" alt="icon" style="width:70px; height:70px;"></figure>
                    <div class="content">
                      <h3 class="text-uppercase pb-1">Data Analytics</h3>
                      <p class="opacity-25">Browse through our supplier seller pages by
                        category in our upcoming Online Store.</p>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-4">
                  <div class="d-flex flex-column p-4 bg-white gap-3 text-left">
                    <figure class="icon"><img src="{{asset('Admin/assets/dist/images/icon-reports.png')}}" alt="icon" style="width:70px; height:70px;"></figure>
                    <div class="content">
                      <h3 class="text-uppercase pb-1">Detailed Reports</h3>
                      <p class="opacity-25">Browse through our supplier seller pages by
                        category in our upcoming Online Store.</p>
                    </div>
                  </div>
                </div>  
              </div>
            </div>
</div>
<!-- Modal -->
<div class="modal fade like-list" id="like-list" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="position: fixed;width: 50%;/* position: relative; */left: 25%;top: 20%;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">FOLLOWING</h2>
        <button type="button" class="close like-close" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
          <div class="company-add-card" style="cursor: pointer;" >
                <ul class="list-group mt-3">
                 @foreach($companyFollwing as $companyFoll)
                         @php
                          $companyprofile = App\Models\CompanyProfile::where('company_id',$companyFoll->id)->first();
                        @endphp
                        <li class="list-group-item">
                        @if($companyprofile)
                          <img class="cyc-searchResultsItem__logo" src="{{asset($companyprofile->company_logo)}}"  onerror="this.src='{{asset('Admin/assets/dist/images/sun.png')}}'" alt="company logo">
                        @endif
                          <div style="position: relative; left: 11%;margin-top: -5%;">
                                <h3 style="font-family: var(--artdeco-typography-sans); font-size: 17px;"><b> 
                                  {{ $companyFoll ?  $companyFoll->company_name: '' }}    
                                  </b>
                                </h3>     
                            <p>                                                     
                                {{$company->City ? $company->City->name : ' '}}, {{$company->State ? $company->State->name : ' '}}
                            </p>
                          </div>  
                        </li>
                  @endforeach  
                </ul>
          </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade like-list2" id="like-list2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true" style="position: fixed;width: 50%;/* position: relative; */left: 25%;top: 20%;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel2">FOLLOWERS</h2>
        <button type="button" class="close like-close2" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
          <div class="company-add-card" style="cursor: pointer;" >
                <ul class="list-group mt-3">
                 @foreach( $companyfollowers as  $companyfollower)
                         @php
                          $companyprofile = App\Models\CompanyProfile::where('company_id',$companyfollower->id)->first();
                        @endphp
                        <li class="list-group-item">
                        @if($companyprofile)
                          <img class="cyc-searchResultsItem__logo" src="{{asset($companyprofile->company_logo)}}"  onerror="this.src='{{asset('Admin/assets/dist/images/sun.png')}}'" alt="company logo">
                        @endif
                          <div style="position: relative; left: 11%;margin-top: -5%;">
                                <h3 style="font-family: var(--artdeco-typography-sans); font-size: 17px;"><b> 
                                  {{ $companyfollower ?  $companyfollower->company_name: '' }}    
                                  </b>
                                </h3>     
                                <p>                                                     
                                    {{$companyfollower->City ? $companyfollower->City->name : ' '}}, {{$companyfollower->State ? $companyfollower->State->name : ' '}}
                                </p>
                          </div>  
                        </li>
                  @endforeach  
                </ul>
          </div>
      </div>
    </div>
  </div>
</div>
@else
<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="add-team-titile">
       <h4>Select Subscription New plans</h4>
    </div>
</div>
   <div class="row">
        @foreach($plans as $plan)   
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="payment-list-one">
              <div class="payment-list-three-bg">
                <div class="payment-list-img">
                  <img src="{{asset('Admin/assets/dist/images/payment-3.png')}}">
                </div>
                <h2 style="  margin-bottom: 20px;">{{$plan->name}} </h2>
                <div data-v-b19b8049="" class="h-pricing-card__discount">
                @if($plan->monthly_price_inr || $plan->monthly_price_usd)
                    @if($country =='India')
                        <span data-v-6508a6ad="" data-v-b19b8049="" class="h-price h-price--text-gray" dir="ltr" country-code="IN">
                            <span data-v-6508a6ad="" class="h-price__currency t-body-strikethrough">₹</span><span data-v-6508a6ad="" class="h-price__number t-body-strikethrough">
                              {{number_format($plan->monthly_price_inr)}}
                            </span>
                        </span>
                    @else
                        <span data-v-6508a6ad="" data-v-b19b8049="" class="h-price h-price--text-gray" dir="ltr" country-code="IN">
                            <span data-v-6508a6ad="" class="h-price__currency t-body-strikethrough">$</span><span data-v-6508a6ad="" class="h-price__number t-body-strikethrough">
                              {{number_format($plan->monthly_price_usd)}}
                            </span>
                        </span>
                    @endif        
                    <span data-v-cba67550="" data-v-b19b8049="" class="h-discount-tag t-body-2 h-discount-tag-text-danger-dark h-discount-tag-bg-danger-light h-pricing-card__discount--tag" dir="ltr">
                              SAVE {{$plan->discount}}% 
                    </span>
                @else
                <span data-v-cba67550="" data-v-b19b8049="" class="h-discount-tag t-body-2 h-discount-tag-text-danger-dark h-discount-tag-bg-danger-light h-pricing-card__discount--tag" dir="ltr">
                              Free
                </span>
                @endif        
                </div>
                @if($country =='India')
                 <h6>
                  <b>Start at</b>
                    ₹{{number_format($plan->monthly_price_inr)}}
                  <b>Per Month</b>
                </h6>
                @else
                <h6>
                  <b>Start at</b>
                    ${{number_format($plan->monthly_price_usd)}}
                  <b>Per Month</b>
                </h6>
                @endif
                    <div class="card-body bg-light rounded-bottom" style=" text-align: left;">
						<ul class="list-unstyled mb-4">
						       @if(in_array('Company', explode(',',  $plan->permission)))
    						    <li class="mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-check text-success"></i></span>Company Profile</li>
    						   @else 
    						    <li class="text-muted mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-times text-danger"></i></span>Company Profile</li>
    						   @endif 
    						   @if(in_array('Newfeed', explode(',',  $plan->permission)))
    						    <li class="mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-check text-success"></i></span>Newfeed</li>
    						   @else 
    						    <li class="text-muted mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-times text-danger"></i></span>Newfeed</li>
    						   @endif 
    						   @if(in_array('RFQ Events', explode(',',  $plan->permission)))
    						    <li class="mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-check text-success"></i></span>RFQ Events{{ $plan->number_of_rfq ? '['.$plan->number_of_rfq.']' : '' }}</li>
    						   @else 
    						    <li class="text-muted mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-times text-danger"></i></span>RFQ Events</li>
    						   @endif 
    						   @if(in_array('Supplier Group', explode(',',  $plan->permission)))
    						    <li class="mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-check text-success"></i></span>Supplier Group</li>
    						   @else 
    						    <li class="text-muted mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-times text-danger"></i></span>Supplier Group</li>
    						   @endif 
    						   @if(in_array('Collaborators', explode(',',  $plan->permission)))
    						    <li class="mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-check text-success"></i></span>Collaborators</li>
    						   @else 
    						    <li class="text-muted mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-times text-danger"></i></span>Collaborators</li>
    						   @endif
    						   @if(in_array('User', explode(',',  $plan->permission)))
    						    <li class="mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-check text-success"></i></span>User {{$plan->number_of_user ? '['.$plan->number_of_user.']' : ' ' }}</li>
    						   @else 
    						    <li class="text-muted mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-times text-danger"></i></span>User</li>
    						   @endif
    						   @if(in_array('Role', explode(',',  $plan->permission)))
    						    <li class="mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-check text-success"></i></span>Role</li>
    						   @else 
    						    <li class="text-muted mb-3"><span class="mr-3" style="margin-right: 10px;"><i class="fas fa-times text-danger"></i></span>Role</li>
    						   @endif
						</ul>
					</div>
                </div>
                <p>{{$plan->description}} </p>
                @if($plan->subscription_type == '0')
                        <a href="{{Route('admin.purchaseSubscriptionPlan',$plan->id)}}" class="btn btn-primary">Select Plan</a>
                @else
                    <form action="{{Route('admin.subscriptionPlan')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input  type="hidden" class="form-control text-dark" name="company_id" value="{{$companyId}}">
                        <input  type="hidden" class="form-control text-dark" name="plan_id"    value="{{$plan->id}}">
                        <input  type="hidden" class="form-control text-dark" name="plan_name"   value="{{$plan->name}}">
                        @if($country =='India')
                           <input  type="hidden" class="form-control text-dark" name="plan_price"   value="{{$plan->monthly_price_inr}}">
                        @else
                           <input  type="hidden" class="form-control text-dark" name="plan_price"   value="{{$plan->monthly_price_usd}}">
                        @endif
                        <input  type="hidden" class="form-control text-dark" name="plan_duration" value="Free">
                        <input  type="hidden" class="form-control text-dark" name="subscription_date" value="{{date('Y-m-d')}}">
                        <button type="submit" class="btn btn-primary">Select Plan</button>
                    </form>
                @endif   
              </div>
          </div>
        @endforeach  
    </div>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        $(".like-close").click(function () {
            $(".like-list").modal("hide");
        });
        
        $(".like-close2").click(function () {
            $(".like-list2").modal("hide");
        });
    });
</script>
</script>
<script>
      $(document).ready(function(){
      $(".menu").click(function(){
      $(".wrapper").toggleClass("sidebarToggle");
      });
      });
 </script>
 <script>
  $(document).ready(function(){
  $("#search").click(function(){
  $("#search").toggleClass("nav-fluid");
  });  
  }); 
 </script>
@endsection