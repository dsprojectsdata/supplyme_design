<!doctype html>
<html lang="en">
    <?php
        $helper = new \App\Helper\Helper();
    ?>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="keywords" content="Html5, CSS3, Bootstarp5 Javascript & Jquery">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Page Title -->
  <title>Supply || Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="{{asset('Admin/assets/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <!-- Alpine Js -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <!-- custom css link -->
  <link rel="stylesheet" href="{{asset('Admin/assets/dist/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('Admin/assets/dist/css/news-feed.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('Admin/assets/dist/css/chat.css')}}">
  
</head>

<style>
body {
  font-family: "Lato", sans-serif;
}
/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 15px;
  color: white;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
  margin: 0
}

/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
  color: #f1f1f1;
}

/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}


.dropdown-container {
  display: none;
  background-color:var(--blue-dark);
  padding-left: 8px;
  font-size:10px;
  color:white;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}
.sidemenuText{
    padding-left: 7px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
@stack('custom-style')

<body>
  <section id="page" class="events">
    <section class="wrapper w-100 d-flex">
      <!-- sidebar section -->
      <nav id="sidebar">
        <div class="sidebar-content position-sticky top-0 py-3" style=" z-index: 99;">
          <div class="sidebar-top d-flex flex-column gap-4">
            <figure class="logo px-3 py-2 mx-3">
              <img src="{{asset('Admin/assets/dist/images/logo.png')}}" alt="logo">
            </figure>
              <!--<div class="profile px-3 py-2 d-flex flex-column gap-2">-->
            <!--  <div class="d-flex flex-wrap justify-content-between align-items-center">-->
            <!--    <p class="text-white ">Profile Completion</p>-->
            <!--    <img src="{{asset('Admin/assets/dist/images/icon-arrow.png')}}" alt="icon-arrow" style="width:14px; filter: invert(100%);">-->
            <!--  </div>-->
            <!--  <div class="d-flex align-items-center justify-content-between gap-2">-->
            <!--    <span>50% Complete </span>-->
            <!--    <div class="progress flex-row rounded-pill" style="height:6px; width: 100px; background: #1C202F;">-->
            <!--      <div class="progress-bar rounded-pill" role="progressbar" style="width:50%; background: #fff;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->
          </div>
            <?php
               $data = $helper->customHeaderFunction();
               $subscriptionHistories = $helper->subscriptionHistoriesHeader();
               $userAuth = \Auth::user();
            ?>
            <ul class="sidebar-nav mt-3">
                   <li class="sidebar-item {{ 'admin/dashboard' == Request::is('admin/dashboard') ? 'active': '' }}">
                        <a href="{{Route('admin.dashboard')}}" class="d-inline-flex w-100 gap-2 align-items-center py-3 px-3 sidebar-link">
                            <i class="bi bi-cassette-fill" style="font-size:14px;"></i>
                              <span class="sidemenuText">Dashboard </span>
                        </a> 
                    </li>
                @if((is_array($data) && in_array('Newfeed', $data)) || (is_array($subscriptionHistories) && in_array('Newfeed',$subscriptionHistories)))
                  <li class="sidebar-item"> 
                     <a href="{{route('newsfeed.index')}}" class="d-inline-flex w-100 gap-2 align-items-center py-3 px-3 sidebar-link"><i class="fa-solid fa-newspaper" style="font-size:14px;"></i>  <span class="sidemenuText">Newsfeed</span> </a> </li>
                @endif
                @if((is_array($data) && in_array('RFQ Events', $data)) || (is_array($subscriptionHistories) && in_array('RFQ Events',$subscriptionHistories)))
                <div class="sidenav">
                  <a class="d-inline-flex w-100 gap-2 align-items-center py-3 px-3 sidebar-link dropdown-btn"><i class="fa-solid fa-calendar-days" style="font-size:14px;"></i> <span class="sidemenuText">RFQ Events</span>  <i class="fa fa-caret-down"></i> </a>
                  <div class="dropdown-container">
                    <!--<a href="{{Route('RFQ.create')}}"> <i class="bi bi-person"></i> Create New RFQ </a>-->
                    <a href="{{Route('RFQ.index')}}"> <i class="bi bi-person"></i> RFQ as Buyer </a>
                    <a href="{{Route('RFQ.ReceivedIndex')}}"> <i class="bi bi-person"></i> RFQ as Supplier </a>
                  </div>
                </div>
                @endif
                @if((is_array($data) && in_array('Collaborators', $data)) || (is_array($subscriptionHistories) && in_array('Collaborators',$subscriptionHistories)))
                  <li class="sidebar-item"> <a href="{{route('admin.create.group')}}" class="d-inline-flex w-100 gap-2 align-items-center py-3 px-3 sidebar-link"><i class="fa-solid fa-people-group" style="font-size:14px;"></i> <span class="sidemenuText">Collaborators</span> </a> </li>
                @endif
                @if((is_array($data) && in_array('Supplier Group', $data))  || (is_array($subscriptionHistories) && in_array('Supplier Group',$subscriptionHistories)))
                  <li class="sidebar-item"> <a href="{{Route('admin.supplier.group')}}" class="d-inline-flex w-100 gap-2 align-items-center py-3 px-3 sidebar-link"><i class="fa-solid fa-plus" style="font-size:14px;"></i>  <span class="sidemenuText">Add Supplier </span> </a> 
                  </li>
                @endif
                @if((is_array($data) && in_array('Messages', $data)) || (is_array($subscriptionHistories) && in_array('Messages',$subscriptionHistories)))
                  <li class="sidebar-item d-flex align-items-center position-relative"> <a href="{{route('RFQ.messages.all')}}" class="d-inline-flex w-100 gap-2 align-items-center py-3 px-3 sidebar-link"><i class="fa fa-commenting-o" aria-hidden="true" style="font-size:14px;"></i>  <span class="sidemenuText">Messages</span> </a> </li>
                @endif
                
                @if((is_array($data) && in_array('User', $data)) || (is_array($subscriptionHistories) && in_array('User', $subscriptionHistories)))
                    <div class="sidenav">
                      <a class="d-inline-flex w-100 gap-2 align-items-center py-3 px-3 sidebar-link dropdown-btn"><i class="fa fa-user-plus" aria-hidden="true" style="font-size:14px;"></i><span class="sidemenuText">Team Members</span>  <i class="fa fa-caret-down"></i> </a>
                      <div class="dropdown-container">
                          <a href="{{route('invites-members.create')}}"> <i class="bi bi-person"></i> User </a>
                          @if((is_array($data) && in_array('Role', $data)) || (is_array($subscriptionHistories) && in_array('Role',$subscriptionHistories)))
                          <a href="{{ route('role.index') }}"> <i class="fa-brands fa-critical-role"></i> Role </a>
                          @endif
                      </div>
                    </div>
                @endif
                <li class="sidebar-item"> <a href="{{route('subscription.index')}}" class="d-inline-flex w-100 gap-2 align-items-center py-3 px-3 sidebar-link"> <i class="fa-solid fa-bell" style="font-size:14px;"></i> <span class="sidemenuText">Subscription</span> </a> </li>
                @if((is_array($data) && in_array('Company', $data)) || (is_array($subscriptionHistories) && in_array('Company',$subscriptionHistories)))
                <div class="sidenav">
                  <a class="d-inline-flex w-100 gap-2 align-items-center py-3 px-3 sidebar-link dropdown-btn"><i class="fa-regular fa-building" style="font-size:14px;"></i> <span class="sidemenuText">Company</span>  <i class="fa fa-caret-down"></i> </a>
                  <div class="dropdown-container">
                      <a href="{{ route('admin.company.profile') }}"> <i class="bi bi-person"></i> Profile </a>
                      
                  </div>
                </div>
                @endif
               
            </ul>
        </div>
      </nav>
      <!-- main content section -->
      <section id="main" class="d-flex flex-column">
        <!-- navbar -->
        <nav class="navbar bg-white position-fixed top-0  end-0 px-3" style="z-index: 99; ">
          <div class="menu"><i class="bi bi-list text-black " style="font-size: 32px; cursor: pointer;"></i></div>
          <ul class="navbar-nav align-items-center flex-row ms-auto px-md-4 px-2 gap-4">
            <li class="nav-item d-none d-md-block border" id="search">
              <div class="input-group">
                <span class="input-group-append">
                  <button class="btn p-1" type="button">
                    <i class="bi bi-search"></i>
                  </button>
                </span>
                <input class="form-control border-0 p-1" type="search" value="search" id="example-search-input">
              </div>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-icon dropdown-toggle" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-bell-fill" style="color:#222222;"></i></a>
              <ul class="dropdown-menu position-absolute end-0 border bg-white px-4 py-3" aria-labelledby="dropdownMenu2" style="left:auto; border-color:#B4B6BD; min-width: 283px; max-width:100%;">
                <li class="py-2">
                  <h6 class="text-uppercase">2 New Notifications </h6>
                </li>
                <li class="py-2">
                  <div class="d-flex flex-wrap justify-content-between gap-3">
                    <div class="d-inline-flex align-items-center gap-3">
                      <img src="{{asset('Admin/assets/dist/images/table-iconOne.png')}}" alt="icon" class="img-fluid w-auto">
                      <div class="d-block">
                        <b class="d-block"> ATG Group</b>
                        <small style="font-size: 12px;" class="opacity-25">Sent you a message</small>
                      </div>
                    </div>
                    <span>4m</span>
                    <div class="d-flex align-items-center gap-3 ">
                      <button type="button" class="btn text-primary text-uppercase" style="background-color: #0d6efd14; font-size: 12px;">View Message</button>
                      <button type="button" class="btn text-gray text-uppercase" style="font-size: 12px;">Dismiss</button>
                    </div>
                  </div>
                </li>
                <li class="py-2">
                  <div class="d-flex flex-wrap justify-content-between gap-3">
                    <div class="d-inline-flex align-items-center gap-3">
                      <img src="{{asset('Admin/assets/dist/images/table-iconOne.png')}}" alt="icon" class="img-fluid w-auto">
                      <div class="d-block">
                        <b class="d-block"> ATG Group</b>
                        <small style="font-size: 12px;" class="opacity-25">Sent you a message</small>
                      </div>
                    </div>
                    <span>4m</span>
                    <div class="d-flex align-items-center gap-3 ">
                      <button type="button" class="btn text-primary text-uppercase" style="background-color: #0d6efd14; font-size: 12px;">View Message</button>
                      <button type="button" class="btn text-gray text-uppercase" style="font-size: 12px;">Dismiss</button>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-icon dropdown-toggle" id="dropdownMenu3" data-bs-toggle="dropdown" aria-expanded="false">
                    <img  src="{{\Auth::guard('web')->user()->img_path ? asset(\Auth::guard('web')->user()->img_path) :  asset('Admin/assets/dist/images/profile.png') }}" alt="profile"  style=" position: relative; width: 36px !important;height: 36px; border-radius: 100% !important;">
                </a>
                <ul class="dropdown-menu position-absolute end-0 border bg-white px-4 py-3" aria-labelledby="dropdownMenu3" style="left:auto; border-color:#B4B6BD; min-width:190px; max-width:100%;">
                      <li> {{\Auth::guard('web')->user()->firstname}} {{\Auth::guard('web')->user()->lastname}}</a></li><hr>
                      <li><a class="dropdown-item" href="{{route('user.profile')}}"><i class="fe fe-user"></i> My Profile</a></li>
                      <li>
                          <form id="logout-form" action="{{ route('admin.admin_logout') }}" method="POST">
                              @csrf
                              <button type="submit" class="dropdown-item"><i class='bx bx-log-out text-muted font-size-18 align-middle me-1'></i> Logout</button>
                          </form>
                      </li>
                </ul>
            </li>
          </ul>
        </nav>
        <script>
          var dropdown = document.getElementsByClassName("dropdown-btn");
          var i;
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
        </script>
