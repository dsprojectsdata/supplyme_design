<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="Html5, CSS3, Bootstarp5 Javascript & Jquery">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Page Title -->
    <title>Supply-Me</title>
    <!-- Bootstrap CSS -->
    <link href="{{asset('Admin/assets/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Alpine Js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- custom css link -->
    <link rel="stylesheet" href="{{asset('Admin/assets/dist/css/style.css')}}">
  </head>

  <body>

  @yield('content')

      <!--  Javascript file  link here -->
      <script src="{{asset('Admin/assets/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('Admin/assets/dist/js/jquery.js')}}"></script>
    <script src="{{asset('Admin/assets/dist/js/custom.js')}}"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script> 
    <script src="{{asset('Admin/assets/dist/js/validate.js')}}"></script>
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
  </body>
</html>