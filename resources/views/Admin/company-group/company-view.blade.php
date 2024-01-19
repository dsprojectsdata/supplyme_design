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
     <div class="alert alert-warning">
          {{Session::get('error')}}
     </div>
     @endif
  
  	<h4 class="mb-4"> &lt; Company Profile </h4>

     <div class="container-fluid">
          <!---  ATG Group --->
          <div class="row bg-white p-4">
               <div class="col-md-1">
                    <img src="{{ asset('Admin/assets/dist/images/table-iconOne.png') }}"
                         style="height: 60px; width:100px;">
               </div>
               <div class="col-md-8">
                    <strong>{{$company->company_name ?? ' '}}</strong><br>
                    <i class="fa-solid fa-display mt-2"></i> <span>Display Manufactures</span><br>
                    <i class="fas fa-map-marker mt-2"></i> <span class="text-secondary">{{$company->address}},
                         {{$company->address2}}, {{$company->zipcode}} |</span>
                    <i class="fas fa-user-friends mt-2"></i> <span class="text-secondary">300 followers |</span> <i
                         class="fa-solid fa-ranking-star"></i> <span class="text-secondary">Rank 24 </span> <br>
                    <i class="fas fa-phone-alt mt-2"></i> <span><a href="#" class="text-dark">{{$company->contact_number
                              ?? '1234567890'}}</a></span>
                    <i class="fas fa-envelope mt-2"></i> <span><a href="#"
                              class="text-dark">{{$company->company_emailsend ?? 'test@gmail.com'}}</a></span>
               </div>
               <div class="col-md-3">
                    <button class="btn btn-primary">Add To Existing RFQ</button>
                    <button class="btn btn-outline-dark m-1 p-1 mt-2" style="height: 40px;">+ Save
                         Supplier</button><span>
                         <button class="btn btn-outline-dark m-1 p-1 mt-2" style="height: 40px;">+Follow</button></span>
               </div>
          </div>
     </div>

     <!--- About ATG Group --->
     <div class="container-fluid bg-white p-4 mt-4">
          <div class="mt-4" id="about-atg-group">
               <b> About ATG Group</b>
               <hr>
               <p>ATG provides guidance and execution across our client’s most complex and vital business processes.
                    <br />Our
                    comprehensive CRM, CPQ, CLM, SPM, Commerce, and Billing expertise creates game-changing efficiency
                    and
                    advantages for our clients.
               </p>
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
                    <strong>{{$company->annual_revenue ?? ' '}}</strong>
               </div>
          </div>

          <div class="row mt-4">
               <div class="col-md-3">
                    <p>NO OF EMPLOYEES</p>
                    <strong>{{$company->number_of_employee ?? ' '}}</strong>
               </div>
               <div class="col-md-3">
                    <p>CEO/OWNER</p>
                    <strong>Jacob Goodman</strong>
               </div>
               <div class="col-md-3">
                    <p>HEAD OFFICE ADDRESS</p>
                    <strong>{{$company->address ?? ' '}}</strong>
               </div>
               <div class="col-md-3">
                    <p>KEY PERSONNEL</p>
                    <strong>Brad Events , sajdra, jsdsa, sars</strong>
               </div>
          </div>

          <div class="row mt-4">
               <div class="col-md-3">
                    <p>LANGUAGES SPOKEN</p>
                    <strong>English and Spanish</strong>
               </div>
               <div class="col-md-3">
                    <p>PUBLICLY TRADED?</p>
                    <strong>Yes</strong>
               </div>
               <div class="col-md-3">
               </div>
               <div class="col-md-3">
               </div>
          </div>

          <div class="row mt-4">
               <div class="col-md-4">
                    <p>Production Distribution</p>
                    <div class="line w-50">
                         <hr>
                    </div>
                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

               </div>
               <div class="col-md-4">
                    <p>Annual Revenue?</p>
                    <div class="line w-50">
                         <hr>
                    </div>
                    <div class="revenue-list">
                         <p>{{ $company->created_at->format('Y') ?? '' }}</p>
                         <b>{{ $company->annual_revenue ?? ' ' }}</b>
                    </div>
                    <div class="mt-4" id="revenue-list">
                         <p>2019</p>
                         <b>$1.2 Million</b>
                    </div>
                    <div class="mt-4" id="revenue-list">
                         <p>2018</p>
                         <b>$1.1 Million</b>
                    </div>
               </div>
               <div class="col-md-4">
                    <p>Certifications</p>
                    <div class="line w-50">
                         <hr>
                    </div>
                    <div id="Certification-list">
                          <p>{{ $company->created_at->format('Y') ?? '' }}</p>
                          <b>{{ $company->certification ?? ' ' }}</b>
                    </div>
                    <div id="Certification-list" class="mt-4">
                         <p>{{ $company->created_at->format('Y') ?? '' }}</p>
                         <b>{{ $company->certification ?? ' ' }}</b>
                    </div>
               </div>
          </div>
     </div>
     <!--- close about Atg group--->

     <div class="container-fluid bg-white p-4 mt-4">
          <h6>Latest Posts</h6>
          <hr />
          <div class="row">
               <div class="col-md-6">
                    <div class="card" style="width: 32rem;">
                         <div class="card-body">
                              <div class="row">
                                   <div class="col-md-2">
                                        <img src="{{ asset('Admin/assets/dist/images/table-iconOne.png') }}"
                                             style="height: 60px; width:100px;">
                                   </div>
                                   <div class="col-md-9">
                                        <span>
                                             <h5 class="card-title">ATG Group</h5>
                                        </span>
                                        <p class="card-text">Display Manufactures</p>
                                        <p class="card-text">11hrs ago</p>
                                   </div>
                                	<div class="col-md-1">
                                        <i class="bi bi-three-dots-vertical" id="icon"></i>
                                   </div>
                              </div>
                         </div>
                         <div class="card-body">
                              <p class="card-text">
                                   ATG provides guidance and execution across our client’s most complex and vital
                                   business processes.
                              </p>
                             <div class="mt-4">
                                <img src="https://img.freepik.com/free-photo/urban-traffic-with-cityscape_1359-324.jpg?size=626&ext=jpg&ga=GA1.1.1069424914.1697709075&semt=sph">
                             </div>
                         </div>
                         <div class="card-body">
                              <a href="#" class="text-dark"><i class="fa-solid fa-thumbs-up"></i> 25Likes</a>
                              <a href="#" class="text-dark float-end"><i class="fa-solid fa-message"></i> 15Comments</a>
                         </div>
                         <hr />
                         <div class="card-body">
                              <div class="row">
                                   <div class="col-md-4">
                                        <a href="#" class="text-dark"><i class="fa-solid fa-thumbs-up"></i> Likes</a>
                                   </div>
                                   <div class="col-md-4">
                                        <a href="#" class="text-dark text-center"><i class="fa-solid fa-message"></i>
                                             Comments</a>
                                   </div>
                                   <div class="col-md-4">
                                        <a href="#" class="text-dark float-end"><i class="fa-solid fa-share-nodes"></i>
                                             Share</a>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="card" style="width: 32rem;">
                         <div class="card-body">
                              <div class="row">
                                   <div class="col-md-2">
                                        <img src="{{ asset('Admin/assets/dist/images/table-iconOne.png') }}"
                                             style="height: 60px; width:100px;">
                                   </div>
                                   <div class="col-md-9">
                                        <span>
                                             <h5 class="card-title">ATG Group</h5>
                                        </span>
                                        <p class="card-text">Display Manufactures</p>
                                        <p class="card-text">11hrs ago</p>
                                   </div>
                                	<div class="col-md-1">
                                       <i class="bi bi-three-dots-vertical" id="icon"></i>
                                   </div>
                              </div>
                           </div>
                         <div class="card-body">
                              <p class="card-text">
                                   ATG provides guidance and execution across our client’s most complex and vital
                                   business processes.
                              </p>
                           	  <div class="mt-4">
                              <img src="https://img.freepik.com/premium-photo/plaza-modern-skyscrapers-xiamen-cbd-fujian_11208-2435.jpg?																		size=626&ext=jpg&ga=GA1.1.1069424914.1697709075&semt=sph">
                              </div>
                         </div>
                         <div class="card-body">
                              <a href="#" class="text-dark"><i class="fa-solid fa-thumbs-up"></i> 25Likes</a>
                              <a href="#" class="text-dark float-end"><i class="fa-solid fa-message"></i> 15Comments</a>
                         </div>
                         <hr />
                         <div class="card-body">
                              <div class="row">
                                   <div class="col-md-4">
                                        <a href="#" class="text-dark"><i class="fa-solid fa-thumbs-up"></i> Likes</a>
                                   </div>
                                   <div class="col-md-4">
                                        <a href="#" class="text-dark text-center"><i class="fa-solid fa-message"></i>
                                             Comments</a>
                                   </div>
                                   <div class="col-md-4">
                                        <a href="#" class="text-dark float-end"><i class="fa-solid fa-share-nodes"></i>
                                             Share</a>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="text-center mt-4" id="post-btn">
                    <button type="button" class="btn btn-outline-dark">View All Post</button>
               </div>
          </div>
     </div>
     <!--- close Latest post--->


     <div class="container-fluid bg-white p-4 mt-4">
          <div class="row">
               <div class="col-md-2">
                    <p id="products">Products(5)</p>
               </div>
               <div class="col-md-2">
                    <p id="services">Services(3)</p>
               </div>
               <div class="col-md-2">
                    <p id="facilities">Facilities(2)</p>
               </div>
          </div>
          <hr />
          <div id="products-content">
               <div class="row mt-4">
                    <div class="col-md-1">
                         <img src="" style="height:50px; width: 60px;">
                    </div>
                    <div class="col-md-11">
                         <h6>Products Grade Moonitors</h6>
                         <p>Medical Grade Moonitors comprehensive CRM, CPQ, CLM, SPM, Commerce, and Billing expertise
                              creates
                         </p>
                    </div>
               </div>

               <div class="row mt-4">
                    <div class="col-md-1">
                         <img src="" style="height:50px; width: 60px;">
                    </div>
                    <div class="col-md-10">
                         <h6>Products Grade Moonitors</h6>
                         <p>Medical Grade Moonitors comprehensive CRM, CPQ, CLM, SPM, Commerce, and Billing expertise
                              creates
                         </p>
                    </div>
               </div>

               <div class="row mt-4">
                    <div class="col-md-1">
                         <img src="" style="height:50px; width: 60px;">
                    </div>
                    <div class="col-md-10">
                         <h6>Products Grade Moonitors</h6>
                         <p>Medical Grade Moonitors comprehensive CRM, CPQ, CLM, SPM, Commerce, and Billing expertise
                              creates
                         </p>
                    </div>
               </div>
          </div>
          <div id="services-content" class="d-blobk">
               <div class="row mt-4">
                    <div class="col-md-1">
                         <img src="" style="height:50px; width: 60px;">
                    </div>
                    <div class="col-md-11">
                         <h6>Services Grade Moonitors</h6>
                         <p>Medical Grade Moonitors comprehensive CRM, CPQ, CLM, SPM, Commerce, and Billing expertise
                              creates
                         </p>
                    </div>
               </div>

               <div class="row mt-4">
                    <div class="col-md-1">
                         <img src="" style="height:50px; width: 60px;">
                    </div>
                    <div class="col-md-10">
                         <h6>Services Grade Moonitors</h6>
                         <p>Medical Grade Moonitors comprehensive CRM, CPQ, CLM, SPM, Commerce, and Billing expertise
                              creates
                         </p>
                    </div>
               </div>

               <div class="row mt-4">
                    <div class="col-md-1">
                         <img src="" style="height:50px; width: 60px;">
                    </div>
                    <div class="col-md-10">
                         <h6>Services Grade Moonitors</h6>
                         <p>Medical Grade Moonitors comprehensive CRM, CPQ, CLM, SPM, Commerce, and Billing expertise
                              creates
                         </p>
                    </div>
               </div>
          </div>
          <div id="facilities-content" class="d-blobk">
               <div class="row mt-4">
                    <div class="col-md-1">
                         <img src="" style="height:50px; width: 60px;">
                    </div>
                    <div class="col-md-11">
                         <h6>Facilities Grade Moonitors</h6>
                         <p>Medical Grade Moonitors comprehensive CRM, CPQ, CLM, SPM, Commerce, and Billing expertise
                              creates
                         </p>
                    </div>
               </div>

               <div class="row mt-4">
                    <div class="col-md-1">
                         <img src="" style="height:50px; width: 60px;">
                    </div>
                    <div class="col-md-10">
                         <h6>Facilities Grade Moonitors</h6>
                         <p>Medical Grade Moonitors comprehensive CRM, CPQ, CLM, SPM, Commerce, and Billing expertise
                              creates
                         </p>
                    </div>
               </div>

               <div class="row mt-4">
                    <div class="col-md-1">
                         <img src="" style="height:50px; width: 60px;">
                    </div>
                    <div class="col-md-10">
                         <h6>Facilities Grade Moonitors</h6>
                         <p>Medical Grade Moonitors comprehensive CRM, CPQ, CLM, SPM, Commerce, and Billing expertise
                              creates
                         </p>
                    </div>
               </div>
          </div>

          <div class="row mt-4">
               <div class="col-md-6">
                    <button class="btn btn-outline-dark">View Product Catalog</button>
               </div>
               <div class="col-md-6">
                    <nav aria-label="Page navigation example">
                         <ul class="pagination">
                              <li class="page-item"><a class="page-link text-dark" href="#">&lt;</a></li>
                              <li class="page-item"><a class="page-link text-dark" href="#">1</a></li>
                              <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                              <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                              <li class="page-item"><a class="page-link text-dark" href="#">&gt;</a></li>
                         </ul>
                    </nav>
               </div>
          </div>
     </div>
     <!--- close product services facilities--->

      <div class="container-fluid bg-white p-4 mt-4">
          <h6>Customer Testimonials</h6>
          <hr>
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                  <div class="carousel-item active">
                      <div class="row">
                          <div class="col-md-6">
                              <p>ATG provides guidance and execution across our client’s most complex and
                                  vital
                                  business
                                  processes. comprehensive CRM, CPQ, CLM, SPM, Commerce, and Billing
                                  expertise
                                  creates
                                  game-changing efficiency and advantages for our clients.
                              </p>
                              <div class="row mt-4">
                                  <div class="col-md-6">
                                      <p>Jason Rogers</p>
                                      <p class="mt-2">Product 1</p>
                                  </div>
                                  <div class="col-md-6">
                                      <span class="rounded-circle p-2 text-white" style="background-color: gray;">AB</span>
                                      <span>Jason Rogers</span>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <p>ATG provides guidance and execution across our client’s most complex and
                                  vital
                                  business
                                  processes. comprehensive CRM, CPQ, CLM, SPM, Commerce, and Billing
                                  expertise
                                  creates
                                  game-changing efficiency and advantages for our clients.</p>
                              <div class="row mt-4">
                                  <div class="col-md-6">
                                      <p>Jason Rogers</p>
                                      <p class="mt-2">Product 1</p>
                                  </div>
                                  <div class="col-md-6">
                                      <span class="rounded-circle p-2 text-white" style="background-color: gray;">AB</span>
                                      <span>Jason Rogers</span>
                                  </div>
                              </div>
                          </div>
                          <div class="mt-4">
                              <span id="carouselNext" style="cursor: pointer;">o o o</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
     <!--- close Customer Testmonials--->

     <div class="container-fluid bg-white p-4 mt-4">
          <h6>Contact Atg Group</h6>
          <hr />
          <form method="" action="">
               <div class="form-group">
                    <textarea class="form-control custom-textarea" rows="4"></textarea>
               </div>
               <button type="submit" class="mt-4 btn btn-outline-dark"> Contact Supplier </button>
               <p class="float-end mt-4"><i class="fas fa-circle"></i> Usually responds within 24-48 hours</p>
          </form>
     </div>
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