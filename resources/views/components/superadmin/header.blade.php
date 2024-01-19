<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="description" content="Dashlead -  Admin Panel HTML Dashboard Template">
	<meta name="author" content="Spruko Technologies Private Limited">
	<meta name="keywords" content="admin,dashboard,panel,bootstrap admin template,bootstrap dashboard,dashboard,themeforest admin dashboard,themeforest admin,themeforest dashboard,themeforest admin panel,themeforest admin template,themeforest admin dashboard,cool admin,it dashboard,admin design,dash templates,saas dashboard,dmin ui design">

	<!-- Favicon -->
	<link rel="icon" href="{{asset('SuperAdmin/assets/img/brand/favicon.ico')}}" type="image/x-icon" />

	<!-- Title -->
	<title>Supply-me || Dashboard </title>

	<!-- Bootstrap css-->
	<link href="{{asset('SuperAdmin/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

	<!-- Icons css-->
	<link href="{{asset('SuperAdmin/assets/plugins/web-fonts/icons.css')}}" rel="stylesheet" />
	<link href="{{asset('SuperAdmin/assets/plugins/web-fonts/font-awesome/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{asset('SuperAdmin/assets/plugins/web-fonts/plugin.css')}}" rel="stylesheet" />

	<!-- Style css-->
	<link href="{{asset('SuperAdmin/assets/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('SuperAdmin/assets/css/boxed.css')}}" rel="stylesheet" />
	<link href="{{asset('SuperAdmin/assets/css/dark-boxed.css')}}" rel="stylesheet" />
	<link href="{{asset('SuperAdmin/assets/css/skins.css')}}" rel="stylesheet">
	<link href="{{asset('SuperAdmin/assets/css/dark-style.css')}}" rel="stylesheet">
	<link href="{{asset('SuperAdmin/assets/css/colors/default.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

	<!-- Color css-->
	<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('SuperAdmin/assets/css/colors/color7.css')}}">

	<!---Select2 css-->
	<link href="{{asset('SuperAdmin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

	<!-- Mutipleselect css-->
	<link rel="stylesheet" href="{{asset('SuperAdmin/assets/plugins/multipleselect/multiple-select.css')}}">
	<!-- Select2 css -->
	<link href="{asset('SuperAdmin/assets/plugins/select2/css/select2.min.css" rel="stylesheet">

	<!-- INTERNAL COLOR PICKER css-->
	<link href="{asset('SuperAdmin/assets/plugins/pickr-master/themes/classic.min.css')}}" rel="stylesheet" />
	<link href="{asset('SuperAdmin/assets/plugins/pickr-master/themes/monolith.min.css')}}" rel="stylesheet" />
	<link href="{asset('SuperAdmin/assets/plugins/pickr-master/themes/nano.min.css')}}" rel="stylesheet" />

	<!--Bootstrap-datepicker css-->
	<link rel="stylesheet" href="{asset('SuperAdmin/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">

	<!-- Internal Datetimepicker-slider css -->
	<link href="{asset('SuperAdmin/assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">

	<!-- Internal Specturm-color picker css-->
	<link href="{asset('SuperAdmin/assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">

	<!-- Internal Ion.rangeslider css-->
	<link href="{asset('SuperAdmin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
	<link href="{asset('SuperAdmin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">

	<!-- Sidemenu css-->
	<link href="{asset('SuperAdmin/assets/css/sidemenu/sidemenu.css')}}" rel="stylesheet">
	@stack('custom-style')
</head>

<body class="horizontalmenu">

	<!-- Loader -->
	<div id="global-loader">
		<img src="{{asset('SuperAdmin/assets/img/loader.svg')}}" class="loader-img" alt="Loader">
	</div>
	<!-- End Loader -->

	<!-- Page -->
	<div class="page">


		<!-- Main Header-->
		<div class="main-header side-header header top-header">
			<div class="container">
				<div class="main-header-left">
					<a class="main-header-menu-icon d-lg-none" href="" id="mainNavShow"><span></span></a>
					<a class="main-logo" href="index.html">
						<img src="{{asset('SuperAdmin/assets/img/brand/logo.png')}}" class="header-brand-img desktop-logo" alt="logo">
						<img src="{{asset('SuperAdmin/assets/img/brand/logo-light.png')}}" class="header-brand-img desktop-logo theme-logo" alt="logo">
					</a>
				</div>
				<div class="main-header-center">
					<div class="responsive-logo">
						<a href="index.html"><img src="{{asset('SuperAdmin/assets/img/brand/logo.png')}}" class="mobile-logo" alt="logo"></a>
						<a href="index.html"><img src="{{asset('SuperAdmin/assets/img/brand/logo-light.png')}}" class="mobile-logo-dark" alt="logo"></a>
					</div>
					<!-- <div class="input-group">
							<div class="input-group-btn search-panel">
								<select class="form-control select2">
									<option label="All categories">
									</option>
									<option value="IT Projects">
										IT Projects
									</option>
									<option value="Business Case">
										Business Case
									</option>
									<option value="Microsoft Project">
										Microsoft Project
									</option>
									<option value="Risk Management">
										Risk Management
									</option>
									<option value="Team Building">
										Team Building
									</option>
								</select>
							</div>
							<input type="search" class="form-control rounded-0" placeholder="Search for anything...">
							<button class="btn search-btn"><i class="fe fe-search"></i></button>
						</div> -->
				</div>
				<div class="main-header-right">
					<div class="dropdown header-search">
						<a class="nav-link icon header-search">
							<i class="fe fe-search"></i>
						</a>
						<div class="dropdown-menu">
							<div class="main-form-search p-2">
								<div class="input-group">
									<div class="input-group-btn search-panel">
										<select class="form-control select2">
											<option label="All categories">
											</option>
											<option value="IT Projects">
												IT Projects
											</option>
											<option value="Business Case">
												Business Case
											</option>
											<option value="Microsoft Project">
												Microsoft Project
											</option>
											<option value="Risk Management">
												Risk Management
											</option>
											<option value="Team Building">
												Team Building
											</option>
										</select>
									</div>
									<input type="search" class="form-control" placeholder="Search for anything...">
									<button class="btn search-btn"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
											<circle cx="11" cy="11" r="8"></circle>
											<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
										</svg></button>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="dropdown main-header-notification flag-dropdown">
							<a class="nav-link icon country-Flag">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><circle cx="256" cy="256" r="256" fill="#f0f0f0"/><g fill="#0052b4"><path d="M52.92 100.142c-20.109 26.163-35.272 56.318-44.101 89.077h133.178L52.92 100.142zM503.181 189.219c-8.829-32.758-23.993-62.913-44.101-89.076l-89.075 89.076h133.176zM8.819 322.784c8.83 32.758 23.993 62.913 44.101 89.075l89.074-89.075H8.819zM411.858 52.921c-26.163-20.109-56.317-35.272-89.076-44.102v133.177l89.076-89.075zM100.142 459.079c26.163 20.109 56.318 35.272 89.076 44.102V370.005l-89.076 89.074zM189.217 8.819c-32.758 8.83-62.913 23.993-89.075 44.101l89.075 89.075V8.819zM322.783 503.181c32.758-8.83 62.913-23.993 89.075-44.101l-89.075-89.075v133.176zM370.005 322.784l89.075 89.076c20.108-26.162 35.272-56.318 44.101-89.076H370.005z"/></g><g fill="#d80027"><path d="M509.833 222.609H289.392V2.167A258.556 258.556 0 00256 0c-11.319 0-22.461.744-33.391 2.167v220.441H2.167A258.556 258.556 0 000 256c0 11.319.744 22.461 2.167 33.391h220.441v220.442a258.35 258.35 0 0066.783 0V289.392h220.442A258.533 258.533 0 00512 256c0-11.317-.744-22.461-2.167-33.391z"/><path d="M322.783 322.784L437.019 437.02a256.636 256.636 0 0015.048-16.435l-97.802-97.802h-31.482v.001zM189.217 322.784h-.002L74.98 437.019a256.636 256.636 0 0016.435 15.048l97.802-97.804v-31.479zM189.217 189.219v-.002L74.981 74.98a256.636 256.636 0 00-15.048 16.435l97.803 97.803h31.481zM322.783 189.219L437.02 74.981a256.328 256.328 0 00-16.435-15.047l-97.802 97.803v31.482z"/></g></svg>
							</a>
							<div class="dropdown-menu">
								<a href="#" class="dropdown-item d-flex ">
									<span class="avatar  me-3 align-self-center bg-transparent"><img src="{{asset('SuperAdmin/assets/img/flags/french_flag.jpg')}}" alt="img"></span>
									<div class="d-flex">
										<span class="mt-2">French</span>
									</div>
								</a>
								<a href="#" class="dropdown-item d-flex">
									<span class="avatar  me-3 align-self-center bg-transparent"><img src="{{asset('SuperAdmin/assets/img/flags/germany_flag.jpg')}}" alt="img"></span>
									<div class="d-flex">
										<span class="mt-2">Germany</span>
									</div>
								</a>
								<a href="#" class="dropdown-item d-flex">
									<span class="avatar me-3 align-self-center bg-transparent"><img src="{{asset('SuperAdmin/assets/img/flags/italy_flag.jpg')}}" alt="img"></span>
									<div class="d-flex">
										<span class="mt-2">Italy</span>
									</div>
								</a>
								<a href="#" class="dropdown-item d-flex">
									<span class="avatar me-3 align-self-center bg-transparent"><img src="{{asset('SuperAdmin/assets/img/flags/russia_flag.jpg')}}" alt="img"></span>
									<div class="d-flex">
										<span class="mt-2">Russia</span>
									</div>
								</a>
								<a href="#" class="dropdown-item d-flex">
									<span class="avatar  me-3 align-self-center bg-transparent"><img src="{{asset('SuperAdmin/assets/img/flags/spain_flag.jpg')}}" alt="img"></span>
									<div class="d-flex">
										<span class="mt-2">spain</span>
									</div>
								</a>
							</div>
						</div> -->
					<!-- <div class="dropdown d-md-flex">
							<a class="nav-link icon full-screen-link" href="">
								<i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
								<i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
							</a>
						</div> -->
					<!-- <div class="dropdown main-header-notification">
							<a class="nav-link icon" href="">
								<i class="fe fe-bell header-icons"></i>
								<span class="badge bg-danger nav-link-badge">4</span>
							</a>
							<div class="dropdown-menu">
								<div class="header-navheading">
									<p class="main-notification-text">You have 1 unread notification<span class="badge bg-pill bg-primary ms-3">View all</span></p>
								</div>
								<div class="main-notification-list">
									<div class="media new">
										<div class="main-img-user online"><img alt="avatar" src="{{asset('SuperAdmin/assets/img/users/5.jpg')}}"></div>
										<div class="media-body">
											<p>Congratulate <strong>Olivia James</strong> for New template start</p><span>Oct 15 12:32pm</span>
										</div>
									</div>
									<div class="media">
										<div class="main-img-user"><img alt="avatar" src="{{asset('SuperAdmin/assets/img/users/2.jpg')}}"></div>
										<div class="media-body">
											<p><strong>Joshua Gray</strong> New Message Received</p><span>Oct 13 02:56am</span>
										</div>
									</div>
									<div class="media">
										<div class="main-img-user online"><img alt="avatar" src="{{asset('SuperAdmin/assets/img/users/3.jpg')}}"></div>
										<div class="media-body">
											<p><strong>Elizabeth Lewis</strong> added new schedule realease</p><span>Oct 12 10:40pm</span>
										</div>
									</div>
								</div>
								<div class="dropdown-footer">
									<a href="#">View All Notifications</a>
								</div>
							</div>
						</div> -->
					<!-- <div class="main-header-notification">
							<a class="nav-link icon" href="chat.html">
								<i class="fe fe-message-square header-icons"></i>
								<span class="badge bg-success nav-link-badge">6</span>
							</a>
						</div> -->
					<div class="dropdown main-profile-menu">
						<a class="d-flex" href="">
							<span class="main-img-user"><img alt="avatar" src="{{asset('SuperAdmin/assets/img/users/1.jpg')}}"></span>
						</a>
						<div class="dropdown-menu">
							<div class="header-navheading">
								<h6 class="main-notification-title">Sonia Taylor</h6>
								<p class="main-notification-text">Web Designer</p>
							</div>
							<a class="dropdown-item border-top" href="profile.html">
								<i class="fe fe-user"></i> My Profile
							</a>
							<a class="dropdown-item" href="profile.html">
								<i class="fe fe-edit"></i> Edit Profile
							</a>
							<a class="dropdown-item" href="profile.html">
								<i class="fe fe-settings"></i> Account Settings
							</a>
							<a class="dropdown-item" href="profile.html">
								<i class="fe fe-settings"></i> Support
							</a>
							<a class="dropdown-item" href="profile.html">
								<i class="fe fe-compass"></i> Activity
							</a>
							<a class="dropdown-item" href="{{ route('superadmin.SuperAdminlogout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();"> <i class='bx bx-log-out text-muted font-size-18 align-middle me-1'></i> <span class="align-middle">Logout</span></a>
							<form id="logout-form" action="{{ route('superadmin.SuperAdminlogout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</div>
					</div>
					<div class="dropdown d-md-flex header-settings">
						<a href="#" class="nav-link icon" data-bs-toggle="sidebar-right" data-bs-target=".sidebar-right">
							<i class="fe fe-align-right header-icons"></i>
						</a>
					</div>
					<button class="navbar-toggler navresponsive-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
						<i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
					</button><!-- Navresponsive closed -->
				</div>
			</div>
		</div>
		<!-- End Main Header-->

		<!-- Centerlogo Header-->
		<div class="main-header side-header hor-header top-header">
			<div class="container">
				<div class="main-header-left">
					<a class="main-header-menu-icon d-lg-none" href="" id="mainNavShow"><span></span></a>
					<a class="main-logo" href="index.html">
						<img src="{{asset('SuperAdmin/assets/img/brand/logo.png')}}" class="header-brand-img desktop-logo" alt="logo">
						<img src="{{asset('SuperAdmin/assets/img/brand/logo-light.png')}}" class="header-brand-img desktop-logo theme-logo" alt="logo">
					</a>
				</div>
				<div class="main-header-center">
					<div class="responsive-logo">
						<a href="index.html"><img src="{{asset('SuperAdmin/assets/img/brand/logo.png')}}" class="mobile-logo" alt="logo"></a>
						<a href="index.html"><img src="{{asset('SuperAdmin/assets/img/brand/logo-light.png')}}" class="mobile-logo-dark" alt="logo"></a>
					</div>
					<div class="input-group">
						<div class="input-group-btn search-panel">
							<select class="form-control select2">
								<option label="All categories">
								</option>
								<option value="IT Projects">
									IT Projects
								</option>
								<option value="Business Case">
									Business Case
								</option>
								<option value="Microsoft Project">
									Microsoft Project
								</option>
								<option value="Risk Management">
									Risk Management
								</option>
								<option value="Team Building">
									Team Building
								</option>
							</select>
						</div>
						<input type="search" class="form-control rounded-0" placeholder="Search for anything...">
						<button class="btn search-btn"><i class="fe fe-search"></i></button>
					</div>
				</div>
				<div class="main-header-right">
					<div class="dropdown header-search">
						<a class="nav-link icon header-search">
							<i class="fe fe-search"></i>
						</a>
						<div class="dropdown-menu">
							<div class="main-form-search p-2">
								<div class="input-group">
									<div class="input-group-btn search-panel">
										<select class="form-control select2">
											<option label="All categories">
											</option>
											<option value="IT Projects">
												IT Projects
											</option>
											<option value="Business Case">
												Business Case
											</option>
											<option value="Microsoft Project">
												Microsoft Project
											</option>
											<option value="Risk Management">
												Risk Management
											</option>
											<option value="Team Building">
												Team Building
											</option>
										</select>
									</div>
									<input type="search" class="form-control" placeholder="Search for anything...">
									<button class="btn search-btn"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
											<circle cx="11" cy="11" r="8"></circle>
											<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
										</svg></button>
								</div>
							</div>
						</div>
					</div>
					<a class="header-brand2" href="index.html">
						<img src="{{asset('SuperAdmin/assets/img/brand/logo.png')}}" class="logo-white top-header-logo1">
						<img src="{{asset('SuperAdmin/assets/img/brand/logo-light.png')}}" class="logo-default top-header-logo2">
					</a>
					<div class="dropdown main-header-notification flag-dropdown">
						<a class="nav-link icon country-Flag">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
								<circle cx="256" cy="256" r="256" fill="#f0f0f0" />
								<g fill="#0052b4">
									<path d="M52.92 100.142c-20.109 26.163-35.272 56.318-44.101 89.077h133.178L52.92 100.142zM503.181 189.219c-8.829-32.758-23.993-62.913-44.101-89.076l-89.075 89.076h133.176zM8.819 322.784c8.83 32.758 23.993 62.913 44.101 89.075l89.074-89.075H8.819zM411.858 52.921c-26.163-20.109-56.317-35.272-89.076-44.102v133.177l89.076-89.075zM100.142 459.079c26.163 20.109 56.318 35.272 89.076 44.102V370.005l-89.076 89.074zM189.217 8.819c-32.758 8.83-62.913 23.993-89.075 44.101l89.075 89.075V8.819zM322.783 503.181c32.758-8.83 62.913-23.993 89.075-44.101l-89.075-89.075v133.176zM370.005 322.784l89.075 89.076c20.108-26.162 35.272-56.318 44.101-89.076H370.005z" />
								</g>
								<g fill="#d80027">
									<path d="M509.833 222.609H289.392V2.167A258.556 258.556 0 00256 0c-11.319 0-22.461.744-33.391 2.167v220.441H2.167A258.556 258.556 0 000 256c0 11.319.744 22.461 2.167 33.391h220.441v220.442a258.35 258.35 0 0066.783 0V289.392h220.442A258.533 258.533 0 00512 256c0-11.317-.744-22.461-2.167-33.391z" />
									<path d="M322.783 322.784L437.019 437.02a256.636 256.636 0 0015.048-16.435l-97.802-97.802h-31.482v.001zM189.217 322.784h-.002L74.98 437.019a256.636 256.636 0 0016.435 15.048l97.802-97.804v-31.479zM189.217 189.219v-.002L74.981 74.98a256.636 256.636 0 00-15.048 16.435l97.803 97.803h31.481zM322.783 189.219L437.02 74.981a256.328 256.328 0 00-16.435-15.047l-97.802 97.803v31.482z" />
								</g>
							</svg>
						</a>
						<div class="dropdown-menu">
							<a href="#" class="dropdown-item d-flex ">
								<span class="avatar  me-3 align-self-center bg-transparent"><img src="{{asset('SuperAdmin/assets/img/flags/french_flag.jpg')}}" alt="img"></span>
								<div class="d-flex">
									<span class="mt-2">French</span>
								</div>
							</a>
							<a href="#" class="dropdown-item d-flex">
								<span class="avatar  me-3 align-self-center bg-transparent"><img src="{{asset('SuperAdmin/assets/img/flags/germany_flag.jpg')}}" alt="img"></span>
								<div class="d-flex">
									<span class="mt-2">Germany</span>
								</div>
							</a>
							<a href="#" class="dropdown-item d-flex">
								<span class="avatar me-3 align-self-center bg-transparent"><img src="{{asset('SuperAdmin/assets/img/flags/italy_flag.jpg')}}" alt="img"></span>
								<div class="d-flex">
									<span class="mt-2">Italy</span>
								</div>
							</a>
							<a href="#" class="dropdown-item d-flex">
								<span class="avatar me-3 align-self-center bg-transparent"><img src="{{asset('SuperAdmin/assets/img/flags/russia_flag.jpg')}}" alt="img"></span>
								<div class="d-flex">
									<span class="mt-2">Russia</span>
								</div>
							</a>
							<a href="#" class="dropdown-item d-flex">
								<span class="avatar  me-3 align-self-center bg-transparent"><img src="{{asset('SuperAdmin/assets/img/flags/spain_flag.jpg')}}" alt="img"></span>
								<div class="d-flex">
									<span class="mt-2">spain</span>
								</div>
							</a>
						</div>
					</div>
					<div class="dropdown d-md-flex">
						<a class="nav-link icon full-screen-link" href="">
							<i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
							<i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
						</a>
					</div>
					<div class="dropdown main-header-notification">
						<a class="nav-link icon" href="">
							<i class="fe fe-bell header-icons"></i>
							<span class="badge bg-danger nav-link-badge">4</span>
						</a>
						<div class="dropdown-menu">
							<div class="header-navheading">
								<p class="main-notification-text">You have 1 unread notification<span class="badge bg-pill bg-primary ms-3">View all</span></p>
							</div>
							<div class="main-notification-list">
								<div class="media new">
									<div class="main-img-user online"><img alt="avatar" src="{{asset('SuperAdmin/assets/img/users/5.jpg')}}"></div>
									<div class="media-body">
										<p>Congratulate <strong>Olivia James</strong> for New template start</p><span>Oct 15 12:32pm</span>
									</div>
								</div>
								<div class="media">
									<div class="main-img-user"><img alt="avatar" src="{{asset('SuperAdmin/assets/img/users/2.jpg')}}"></div>
									<div class="media-body">
										<p><strong>Joshua Gray</strong> New Message Received</p><span>Oct 13 02:56am</span>
									</div>
								</div>
								<div class="media">
									<div class="main-img-user online"><img alt="avatar" src="{{asset('SuperAdmin/assets/img/users/3.jpg')}}"></div>
									<div class="media-body">
										<p><strong>Elizabeth Lewis</strong> added new schedule realease</p><span>Oct 12 10:40pm</span>
									</div>
								</div>
							</div>
							<div class="dropdown-footer">
								<a href="#">View All Notifications</a>
							</div>
						</div>
					</div>
					<div class="main-header-notification">
						<a class="nav-link icon" href="chat.html">
							<i class="fe fe-message-square header-icons"></i>
							<span class="badge bg-success nav-link-badge">6</span>
						</a>
					</div>
					<div class="dropdown main-profile-menu">
						<a class="d-flex" href="">
							<span class="main-img-user"><img alt="avatar" src="{{asset('SuperAdmin/assets/img/users/1.jpg')}}"></span>
						</a>
						<div class="dropdown-menu">
							<div class="header-navheading">
								<h6 class="main-notification-title">Sonia Taylor</h6>
								<p class="main-notification-text">Web Designer</p>
							</div>
							<a class="dropdown-item border-top" href="profile.html">
								<i class="fe fe-user"></i> My Profile
							</a>
							<a class="dropdown-item" href="profile.html">
								<i class="fe fe-edit"></i> Edit Profile
							</a>
							<a class="dropdown-item" href="profile.html">
								<i class="fe fe-settings"></i> Account Settings
							</a>
							<a class="dropdown-item" href="profile.html">
								<i class="fe fe-settings"></i> Support
							</a>
							<a class="dropdown-item" href="profile.html">
								<i class="fe fe-compass"></i> Activity
							</a>
							<a class="dropdown-item" href="signin.html">
								<i class="fe fe-power"></i> Sign Out
							</a>
						</div>
					</div>
					<div class="dropdown d-md-flex header-settings">
						<a href="#" class="nav-link icon" data-bs-toggle="sidebar-right" data-bs-target=".sidebar-right">
							<i class="fe fe-align-right header-icons"></i>
						</a>
					</div>
					<button class="navbar-toggler navresponsive-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
						<i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
					</button><!-- Navresponsive closed -->
				</div>
			</div>
		</div>
		<!-- End Centerlogo Header-->

		<!-- Mobile-header -->
		<div class="mobile-main-header">
			<div class="mb-1 navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
				<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
					<div class="d-flex order-lg-2 ms-auto">
						<div class="dropdown header-search">
							<a class="nav-link icon header-search">
								<i class="fe fe-search"></i>
							</a>
							<div class="dropdown-menu">
								<div class="main-form-search p-2">
									<div class="input-group">
										<div class="input-group-btn search-panel">
											<select class="form-control select2">
												<option label="All categories">
												</option>
												<option value="IT Projects">
													IT Projects
												</option>
												<option value="Business Case">
													Business Case
												</option>
												<option value="Microsoft Project">
													Microsoft Project
												</option>
												<option value="Risk Management">
													Risk Management
												</option>
												<option value="Team Building">
													Team Building
												</option>
											</select>
										</div>
										<input type="search" class="form-control" placeholder="Search for anything...">
										<button class="btn search-btn"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
												<circle cx="11" cy="11" r="8"></circle>
												<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
											</svg></button>
									</div>
								</div>
							</div>
						</div>
						<div class="dropdown main-header-notification flag-dropdown">
							<a class="nav-link icon country-Flag">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
									<circle cx="256" cy="256" r="256" fill="#f0f0f0" />
									<g fill="#0052b4">
										<path d="M52.92 100.142c-20.109 26.163-35.272 56.318-44.101 89.077h133.178L52.92 100.142zM503.181 189.219c-8.829-32.758-23.993-62.913-44.101-89.076l-89.075 89.076h133.176zM8.819 322.784c8.83 32.758 23.993 62.913 44.101 89.075l89.074-89.075H8.819zM411.858 52.921c-26.163-20.109-56.317-35.272-89.076-44.102v133.177l89.076-89.075zM100.142 459.079c26.163 20.109 56.318 35.272 89.076 44.102V370.005l-89.076 89.074zM189.217 8.819c-32.758 8.83-62.913 23.993-89.075 44.101l89.075 89.075V8.819zM322.783 503.181c32.758-8.83 62.913-23.993 89.075-44.101l-89.075-89.075v133.176zM370.005 322.784l89.075 89.076c20.108-26.162 35.272-56.318 44.101-89.076H370.005z" />
									</g>
									<g fill="#d80027">
										<path d="M509.833 222.609H289.392V2.167A258.556 258.556 0 00256 0c-11.319 0-22.461.744-33.391 2.167v220.441H2.167A258.556 258.556 0 000 256c0 11.319.744 22.461 2.167 33.391h220.441v220.442a258.35 258.35 0 0066.783 0V289.392h220.442A258.533 258.533 0 00512 256c0-11.317-.744-22.461-2.167-33.391z" />
										<path d="M322.783 322.784L437.019 437.02a256.636 256.636 0 0015.048-16.435l-97.802-97.802h-31.482v.001zM189.217 322.784h-.002L74.98 437.019a256.636 256.636 0 0016.435 15.048l97.802-97.804v-31.479zM189.217 189.219v-.002L74.981 74.98a256.636 256.636 0 00-15.048 16.435l97.803 97.803h31.481zM322.783 189.219L437.02 74.981a256.328 256.328 0 00-16.435-15.047l-97.802 97.803v31.482z" />
									</g>
								</svg>
							</a>
							<div class="dropdown-menu">
								<a href="#" class="dropdown-item d-flex ">
									<span class="avatar  me-3 align-self-center bg-transparent"><img src="{{asset('SuperAdmin/assets/img/flags/french_flag.jpg')}}" alt="img"></span>
									<div class="d-flex">
										<span class="mt-2">French</span>
									</div>
								</a>
								<a href="#" class="dropdown-item d-flex">
									<span class="avatar  me-3 align-self-center bg-transparent"><img src="{{asset('SuperAdmin/assets/img/flags/germany_flag.jpg')}}" alt="img"></span>
									<div class="d-flex">
										<span class="mt-2">Germany</span>
									</div>
								</a>
								<a href="#" class="dropdown-item d-flex">
									<span class="avatar me-3 align-self-center bg-transparent"><img src="{{asset('SuperAdmin/assets/img/flags/italy_flag.jpg')}}" alt="img"></span>
									<div class="d-flex">
										<span class="mt-2">Italy</span>
									</div>
								</a>
								<a href="#" class="dropdown-item d-flex">
									<span class="avatar me-3 align-self-center bg-transparent"><img src="{{asset('SuperAdmin/assets/img/flags/russia_flag.jpg')}}" alt="img"></span>
									<div class="d-flex">
										<span class="mt-2">Russia</span>
									</div>
								</a>
								<a href="#" class="dropdown-item d-flex">
									<span class="avatar  me-3 align-self-center bg-transparent"><img src="{{asset('SuperAdmin/assets/img/flags/spain_flag.jpg')}}" alt="img"></span>
									<div class="d-flex">
										<span class="mt-2">spain</span>
									</div>
								</a>
							</div>
						</div>
						<div class="dropdown ">
							<a class="nav-link icon full-screen-link">
								<i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
								<i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
							</a>
						</div>
						<div class="dropdown main-header-notification">
							<a class="nav-link icon" href="">
								<i class="fe fe-bell header-icons"></i>
								<span class="badge bg-danger nav-link-badge">4</span>
							</a>
							<div class="dropdown-menu">
								<div class="header-navheading">
									<p class="main-notification-text">You have 1 unread notification<span class="badge bg-pill bg-primary ms-3">View all</span></p>
								</div>
								<div class="main-notification-list">
									<div class="media new">
										<div class="main-img-user online"><img alt="avatar" src="{{asset('SuperAdmin/assets/img/users/5.jpg')}}"></div>
										<div class="media-body">
											<p>Congratulate <strong>Olivia James</strong> for New template start</p><span>Oct 15 12:32pm</span>
										</div>
									</div>
									<div class="media">
										<div class="main-img-user"><img alt="avatar" src="{{asset('SuperAdmin/assets/img/users/2.jpg')}}"></div>
										<div class="media-body">
											<p><strong>Joshua Gray</strong> New Message Received</p><span>Oct 13 02:56am</span>
										</div>
									</div>
									<div class="media">
										<div class="main-img-user online"><img alt="avatar" src="{{asset('SuperAdmin/assets/img/users/3.jpg')}}"></div>
										<div class="media-body">
											<p><strong>Elizabeth Lewis</strong> added new schedule realease</p><span>Oct 12 10:40pm</span>
										</div>
									</div>
								</div>
								<div class="dropdown-footer">
									<a href="#">View All Notifications</a>
								</div>
							</div>
						</div>
						<div class="main-header-notification mt-2">
							<a class="nav-link icon" href="chat.html">
								<i class="fe fe-message-square header-icons"></i>
								<span class="badge bg-success nav-link-badge">6</span>
							</a>
						</div>
						<div class="dropdown main-profile-menu">
							<a class="d-flex" href="#">
								<span class="main-img-user"><img alt="avatar" src="{{asset('SuperAdmin/assets/img/users/1.jpg')}}"></span>
							</a>
							<div class="dropdown-menu">
								<div class="header-navheading">
									<h6 class="main-notification-title">Sonia Taylor</h6>
									<p class="main-notification-text">Web Designer</p>
								</div>
								<a class="dropdown-item border-top" href="profile.html">
									<i class="fe fe-user"></i> My Profile
								</a>
								<a class="dropdown-item" href="profile.html">
									<i class="fe fe-edit"></i> Edit Profile
								</a>
								<a class="dropdown-item" href="profile.html">
									<i class="fe fe-settings"></i> Account Settings
								</a>
								<a class="dropdown-item" href="profile.html">
									<i class="fe fe-settings"></i> Support
								</a>
								<a class="dropdown-item" href="profile.html">
									<i class="fe fe-compass"></i> Activity
								</a>
								<a class="dropdown-item" href="signin.html">
									<i class="fe fe-power"></i> Sign Out
								</a>
							</div>
						</div>
						<div class="dropdown  header-settings">
							<a href="#" class="nav-link icon" data-bs-toggle="sidebar-right" data-bs-target=".sidebar-right">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-right header-icons">
									<line x1="21" y1="10" x2="7" y2="10"></line>
									<line x1="21" y1="6" x2="3" y2="6"></line>
									<line x1="21" y1="14" x2="3" y2="14"></line>
									<line x1="21" y1="18" x2="7" y2="18"></line>
								</svg>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Mobile-header closed -->

		<!-- Horizonatal menu-->
		<div class="main-navbar hor-menu sticky">
			<div class="container">
				<ul class="nav">
					<li class="nav-item">
						<a class="nav-link" href="{{Route('superadmin.dashboard')}}"><i class="ti-home"></i>Dashboard</a>
					</li>

					<!--================= company menu open =================-->
					<li class="nav-item">
						<a class="nav-link with-sub" href=""><i class="fa fa-building-o"></i>Company</a>
						<ul class="nav-sub">
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('company.index')}}">Companies</a>
							</li>
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('new.request.index')}}">New Request Company</a>
							</li>
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('claim.request.index')}}">Claim Request</a>
							</li>

							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('rejected.company.index')}}">Claim Rejected</a>
							</li>

						</ul>
					</li>
					<!--================= company menu close =================-->

					<li class="nav-item">
						<a class="nav-link with-sub" href=""><i class="ti-wallet"></i>Master</a>
						<ul class="nav-sub">
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('company.companyType')}}">Company Type</a>
							</li>
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('company.getStoreAnnualRevenue')}}">Annual Revenue</a>
							</li>
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('company.getStoreCertificate')}}">Certificate</a>
							</li>
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('company.getStoreCurrencies')}}">Currencies</a>
							</li>
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('company.getStoreIndustries')}}">Industries</a>
							</li>
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('company.getStoreNumberOfEmployee')}}">Number Of Employee</a>
							</li>
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('company.getStoreProfilePositions')}}">Profile Positions</a>
							</li>
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('jobs.roles.index')}}">Job Role</a>
							</li>
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('comapny.document.manager')}}">Company Document Mnager</a>
							</li>
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('category.index')}}">Category</a>
							</li>

							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('cover-letter.index')}}">Cover Letter</a>
							</li>
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('nda.index')}}">NDA</a>
							</li>
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('contract.index')}}">Contract </a>
							</li>
							<li class="nav-sub-item">
								<a class="nav-sub-link" href="{{route('bidsheet.index')}}">Bid Sheet </a>
							</li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{Route('paymant.plans.index')}}"><i class="ti-wallet"></i>Payment Plans</a>
					</li>
				</ul>
			</div>
		</div>
		<!--End  Horizonatal menu-->