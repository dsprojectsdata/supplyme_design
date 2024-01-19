@extends('Admin.layout.app')
@section('admincontent')

<style>
	#products:hover {
    	cursor: pointer;
  	}
    #services:hover {
    	cursor: pointer;
  	}
    #facilities:hover {
    	cursor: pointer;
  	}
</style>

<div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">

     @if(Session::has('error'))
     <div class="alert alert-danger">
          {{Session::get('error')}}
     </div>
     @endif
     @if(Session::has('success'))
     <div class="alert alert-success">
          {{Session::get('success')}}
     </div>
     @endif
  
  <h4 class="mb-4">
    <a href="{{route('admin.supplier.group')}}" class="text-dark">  Company Profile </a>
  </h4>

     <div class="container-fluid">
          <!---  ATG Group --->
          <div class="row bg-white p-4">
               <div class="col-md-1">
                    @if($companyprofile  && $companyprofile->company_logo)
                        <img src="{{asset($companyprofile->company_logo)}}" style="height: 60px; width:100px;">
                    @else
                        <img src="{{asset('Admin/assets/dist/images/sun.png')}}" style="height: 60px; width:100px;">
                    @endif
               </div>
               <div class="col-md-8">
                    <strong>{{$company->company_name ?? ' '}}</strong><br>
                    <i class="fa-solid fa-display mt-2"></i> <span>{{$company->company_type ?? ' '}}</span><br>
                    <i class="fas fa-map-marker mt-2"></i> <span class="text-secondary" style=" margin-left: 3px;"> {{$company->City ? $company->City->name : ' '}}, {{$company->State ? $company->State->name : ' '}} ,{{$company->zipcode ?? ' '}}</span> |
                    <i class="fas fa-user-friends mt-2"></i> <span class="text-secondary" style=" margin-left: 3px;">{{$followsCount}} followers </span>  |
                    <i class="fa-solid fa-clock"></i> <span class="text-secondary" style=" margin-left: 3px;">{{$company->created_at->diffForHumans()}} </span> <br>
                    <i class="fas fa-phone-alt mt-2"></i> <span><a href="#" class="text-dark" style=" margin-left: 3px;">{{$company->contact_number ?? '1234567890'}}</a></span> |  
                    <i class="fas fa-envelope mt-2"></i> <span><a href="#" class="text-dark" style=" margin-left: 3px;">{{$company->company_email ?? 'Demo@gmail.com'}}</a></span>
               </div>
               
               <div class="col-md-3">
                   @if($company->id != Auth::user()->company_id)
                        <button class="btn btn-primary">Add To Existing RFQ</button>
                        <button class="btn btn-outline-dark m-1 p-1 mt-2" style="height: 40px;">+ Save
                             Supplier</button><span>
                             @if($follows)     
                               @if($follows->status == '1') 
                                   <a href="{{Route('newsfeed.following',['follow_id' => $company->id ])}}" class="btn btn-outline-dark m-1 p-1 mt-2" style="height: 40px;">+UnFollow</a></span>
                                 @else
                                   <a href="{{Route('newsfeed.following',['follow_id' => $company->id ])}}" class="btn btn-outline-dark m-1 p-1 mt-2" style="height: 40px;">+Follow</a></span>
                               @endif 
                             @else
                                 <a href="{{Route('newsfeed.following',['follow_id' => $company->id ])}}" class="btn btn-outline-dark m-1 p-1 mt-2" style="height: 40px;">+Follow</a></span>
                            @endif 
                    @endif         
               </div>
          </div>
     </div>

     <!--- About ATG Group --->
     <div class="container-fluid bg-white p-4 mt-4">
          <div class="mt-4" id="about-atg-group">
               <b> About {{$company->company_name ?? ' '}} Group</b>
               <hr>
               <p>{{$company->about_company ?? ' '}}</p>
          </div>

          <div class="row mt-4">
               <div class="col-md-3">
                    <p>COMPANY TYPE</p>
                    <strong>{{$company->company_type ?? ' '}}</strong>
               </div>
               <div class="col-md-3">
                    <p>PRODUCT CATEGORY</p>
                    <strong>{{$company->company_category ?? ' '}}</strong>
               </div>
               <div class="col-md-3">
                    <p>STARTED IN</p>
                    <strong>{{$company->started_in ?? ' '}}</strong>
               </div>
               <div class="col-md-3">
                    <p>ANNUAL REVENUE</p>
                 <strong>{{$company->companyprofile->annual_revenue ?? ' '}}</strong> 
               </div>
          </div>
          <div class="row mt-4">
               <div class="col-md-3">
                    <p>NO OF EMPLOYEES</p>
                    <strong>{{$company->companyprofile->number_of_employee ?? ' '}}</strong>
               </div>
               <div class="col-md-3">
                    <p>CEO/OWNER</p>
                    <strong>{{ $company->user->firstname ?? ' ' }} {{ $company->user->lastname ?? ' ' }}</strong>
               </div>
               <div class="col-md-3">
                    <p>HEAD OFFICE ADDRESS</p>
                    <strong>{{$company->address ?? ' '}} {{$company->address2 ?? ' '}}</strong>
               </div>
               <div class="col-md-3">
                    <p>KEY PERSONNEL</p>
                    <strong>{{ $company->user->firstname ?? ' ' }} {{ $company->user->lastname ?? ' ' }}</strong>
               </div>
          </div>
     </div>
     <!--- close about Atg group--->

     <div class="container-fluid bg-white p-4 mt-4">
          <h6>Latest Posts</h6>
          <hr />
          <div class="row">
              @foreach($posts as $post)
                    @php
                        $images = json_decode($post->images);
                        $imageCount = count($images);
                    @endphp
               <div class="col-md-12">
                    <div class="card" >
                         <div class="card-body">
                              <div class="row">
                                    <div class="col-md-2">
                                       @if($companyprofile  && $companyprofile->company_logo)
                                            <img src="{{asset($companyprofile->company_logo)}}" style="height: 60px; width:100px;">
                                        @else
                                            <img src="{{asset('Admin/assets/dist/images/sun.png')}}" style="height: 60px; width:100px;">
                                        @endif
                                    </div>
                                   <div class="col-md-9">
                                        <span>
                                             <h5 class="card-title">{{$company->company_name ?? ' '}}</h5>
                                        </span>
                                        <p class="card-text">{{$company->company_type ?? ' '}}</p>
                                        <p class="card-text">{{$post->created_at->diffForHumans()}}</p>
                                   </div>
                                	<div class="col-md-1">
                                        <i class="bi bi-three-dots-vertical" id="icon"></i>
                                   </div>
                              </div>
                         </div>
                         <div class="card-body">
                              <p class="card-text">
                                   {{$post->description}}
                              </p>
                                   @foreach (json_decode($post->images) as $key=>$image)
                                         <div class="mt-4">
                                            <img src="{{ asset($image) }}" >
                                         </div>
                                    @endforeach
                         </div>
                         <div class="card-body">
                              <a href="#" class="text-dark"><i class="fa-solid fa-thumbs-up"></i> {{$post->likes}} Likes</a>
                              <a href="#" class="text-dark float-end"><i class="fa-solid fa-message"></i> {{$post->comment_count}} Comments</a>
                         </div>
                         <hr />
                    </div>
               </div>
               @endforeach
               <div class="text-center mt-4" id="post-btn">
                    <a href="{{ route('newsfeed.index') }}" class="btn btn-outline-dark">View All Post</a>
               </div>
          </div>
     </div>
     <!--- close Latest post--->


     <div class="container-fluid bg-white p-4 mt-4">
          <div class="row">
               <div class="col-md-2">
                    <p id="products">Products</p>
               </div>
               <div class="col-md-2">
                    <p id="services">Services</p>
               </div>
          </div>
          <hr />
          <div id="products-content">
                @foreach($company->companyproductandservices as $companyproduct)
                   @if($companyproduct->type_of_offering == 'product')
                        <div class="row mt-4">
                            <div class="col-md-1">
                                 <img src="{{ asset($companyproduct->product_images)}}" style="height:50px; width: 60px;">
                            </div>
                            <div class="col-md-11">
                                 <h6>{{ $companyproduct->product_name ?? ' ' }}</h6>
                                 <p>{{ $companyproduct->product_description ?? ' ' }}</p>
                            </div>
                       </div>
                   @endif
                @endforeach
          </div>
          <div id="services-content" class="d-blobk">
              @foreach($company->companyproductandservices as $companyproduct)
                   @if($companyproduct->type_of_offering == 'service')
                        <div class="row mt-4">
                            <div class="col-md-1">
                                 <img src="{{ asset($companyproduct->product_images)}}" style="height:50px; width: 60px;">
                            </div>
                            <div class="col-md-11">
                                 <h6>{{ $companyproduct->product_name ?? ' ' }}</h6>
                                 <p>{{ $companyproduct->product_description ?? ' ' }}</p>
                            </div>
                       </div>
                   @endif
                @endforeach
          </div>

          <!--<div class="row mt-4">-->
          <!--     <div class="col-md-6">-->
          <!--          <a href="{{ route('company.profile.view_product_catelog') }}" class="btn btn-outline-dark">View Product Catalog</a>-->
          <!--     </div>-->
          <!--     <div class="col-md-6">-->
          <!--          <nav aria-label="Page navigation example">-->
          <!--               <ul class="pagination">-->
          <!--                    <li class="page-item"><a class="page-link text-dark" href="#">&lt;</a></li>-->
          <!--                    <li class="page-item"><a class="page-link text-dark" href="#">1</a></li>-->
          <!--                    <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>-->
          <!--                    <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>-->
          <!--                    <li class="page-item"><a class="page-link text-dark" href="#">&gt;</a></li>-->
          <!--               </ul>-->
          <!--          </nav>-->
          <!--     </div>-->
          <!--</div>-->
     </div>
     <!--- close product services facilities--->

      <!--  <div class="container-fluid bg-white p-4 mt-4">-->
      <!--    <h6>Customer Testimonials</h6>-->
      <!--    <hr>-->
      <!--    <div id="myCarousel" class="carousel slide" data-ride="carousel">-->
      <!--        <div class="carousel-inner">-->
      <!--            <div class="carousel-item active">-->
      <!--                <div class="row">-->
      <!--                    @foreach($company->companyprofilecustomerandclients as $testimonials)-->
      <!--                    <div class="col-md-6">-->
      <!--                        <p>ATG provides guidance and execution across our client’s most complex and-->
      <!--                            vital-->
      <!--                            business-->
      <!--                            processes. comprehensive CRM, CPQ, CLM, SPM, Commerce, and Billing-->
      <!--                            expertise-->
      <!--                            creates-->
      <!--                            game-changing efficiency and advantages for our clients.-->
      <!--                        </p>-->
      <!--                        <div class="row mt-4">-->
      <!--                            <div class="col-md-6">-->
      <!--                                <p>{{$testimonials->client_company_name ?? ' '}}</p>-->
      <!--                                <p class="mt-2">{{$testimonials->client_product_or_service ?? ' '}}</p>-->
      <!--                            </div>-->
      <!--                            <div class="col-md-6">-->
      <!--                                <span class="rounded-circle p-2 text-white" style="background-color: gray;">AB</span>-->
      <!--                                <span>Jason Rogers</span>-->
      <!--                            </div>-->
      <!--                        </div>-->
      <!--                    </div>-->
      <!--                    @endforeach-->
      <!--                    <div class="mt-4">-->
      <!--                        <span id="carouselNext" style="cursor: pointer;">o o o</span>-->
      <!--                    </div>-->
      <!--                </div>-->
      <!--            </div>-->
      <!--        </div>-->
      <!--    </div>-->
      <!--</div>-->
     <!--- close Customer Testmonials--->

     <!--<div class="container-fluid bg-white p-4 mt-4">-->
     <!--     <h6>Contact Atg Group</h6>-->
     <!--     <hr />-->
     <!--     <form method="" action="">-->
     <!--          <div class="form-group">-->
     <!--               <textarea class="form-control custom-textarea" rows="4"></textarea>-->
     <!--          </div>-->
     <!--          <button type="submit" class="mt-4 btn btn-outline-dark"> Contact Supplier </button>-->
     <!--          <p class="float-end mt-4"><i class="fas fa-circle"></i> Usually responds within 24-48 hours</p>-->
     <!--     </form>-->
     <!--</div>-->
     <!--- Contact Atg Group--->

</div>
<!--- ajax--->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
     var xValues = ["Laptop", "Monitor", "Projector"];
     var yValues = [55, 49, 44,];
     var barColors = [
          "#b91d47",
          "#00aba9",
          "#2b5797",
          "#e8c3b9",
          "#1e7145"
     ];

     new Chart("myChart", {
          type: "doughnut",
          data: {
               labels: xValues,
               datasets: [{
                    backgroundColor: barColors,
                    data: yValues
               }]
          },
          options: {
               title: {
                    display: true,
                    text: ""
               }
          }
     });
</script>


<script>
     $(document).ready(function () {
          $("#services-content").hide();
          $("#facilities-content").hide();

          $("#products").click(function () {
               $("#services-content").hide();
               $("#facilities-content").hide();
               $("#products-content").show();
               $("#services").removeClass("text-primary");
               $("#facilities").removeClass("text-primary");
               $("#products").addClass("text-primary");
          });

          $("#services").click(function () {
               $("#products-content").hide();
               $("#facilities-content").hide();
               $("#services-content").show();
               $("#services").addClass("text-primary");
               $("#facilities").removeClass("text-primary");
               $("#products").removeClass("text-primary");
          });

          $("#facilities").click(function () {
               $("#products-content").hide();
               $("#services-content").hide();
               $("#facilities-content").show();
               $("#services").removeClass("text-primary");
               $("#facilities").addClass("text-primary");
               $("#products").removeClass("text-primary");
          });

          $("#products").trigger("click");
     });
</script>


<script>
$(document).ready(function() {
  $("#carouselNext").click(function() {
    $("#myCarousel").carousel("next");
  });
});
</script>



@endsection