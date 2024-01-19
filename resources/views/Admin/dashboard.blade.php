@extends('Admin.layout.app')
@section('admincontent')
<div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">
                <!-- Welcome -->
                <div class="d-block flex-wrap gap-3 welcomeBox">
                    <div class="title pb-2 pb-md-4 d-flex flex-column w-100 gap-2">
                      <h2>Welcome back, {{\Auth::guard('web')->user()->firstname}}</h2>
                    </div>  
                    <div class="row">
                      <div class="col-12 col-md-6 col-lg-4 mb-3 mb-md-0" style="z-index: -999;">
                       <div class="border bg-white" style="border-color:#B4B6BD;">
                        <div class="d-flex justify-content-between align-items-center px-3 py-3 border-bottom" style="border-color:#B4B6BD;">
                         <h4>Company Profile</h4>
                         <a href="#">More details</a>
                        </div>
                        <div class="d-flex gap-3 align-items-center px-3 py-3">
                          <figure><img src="{{asset('Admin/assets/dist/images/sun.png')}}" alt="icon" class="img-fluid"></figure>
                          <div class="d-block" style="font-size:14px; font-weight:600;">
                            @php 
                              $user_id = \Auth::guard('web')->user()->id;
                              $company = App\Models\Company::where('user_id',$user_id)->first();
                            @endphp
                            <h1>{{$company ? $company->company_name : ' '}}</h1>
                            <i class="bi bi-bar-chart"></i> Rank <b>15</b> <i class="bi bi-arrow-up-short" style="color:#26C24C;"></i>
                          </div>
                        </div>
                        <div class="d-block px-3 ">
                          <p class="text-uppercase" style="font-weight:600; color:#415662;">Collaborators</p> 
                          <ul class="d-flex pt-2">
                            <li><a href="#" class="d-block"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></a></li>
                            <li class="position-relative border-2 border-white rounded-circle" style="left:-6px"><a href="#" class="d-block"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></a></li>
                            <li class="position-relative border-2 border-white rounded-circle" style="left:-12px"><a href="#" class="d-block"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></a></li>
                          </ul>
                        </div>
                        <div class="d-flex align-items-center justify-content-around py-3 mt-3 border-top" style="border-color:#B4B6BD;">
                          <div class="flex-column text-center">
                            <p class="text-uppercase" style="font-weight:600; color: #415662;">Following</p>
                            <strong style="font-weight: 700;" class="pt-1 d-block">1,923</strong>
                          </div>
                          <div class="flex-column text-center">
                            <p class="text-uppercase" style="font-weight:600; color: #415662;">Followers</p>
                            <strong style="font-weight: 700;" class="pt-1 d-block">560</strong>
                          </div>
                        </div>
                      </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-8" style="z-index: -999;">
                          <div class="border bg-white" style="border-color:#B4B6BD;">
                            <div class="d-flex justify-content-between align-items-center px-3 py-3 border-bottom" style="border-color:#B4B6BD;">
                              <h4>Recent Activity</h4>
                              <a href="#">View All</a>
                             </div>
                             <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                  <button class="accordion-button collapsed d-flex gap-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <span class="border rounded-circle">2</span> Feedback requests are pending completion
                                  </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                                </div>
                              </div>
                              <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                  <button class="accordion-button collapsed d-flex gap-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    <span class="border rounded-circle">1</span> You have 1 new RFQ Event invite pending response
                                  </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                                </div>
                              </div>
                              <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                  <button class="accordion-button collapsed d-flex gap-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    <span class="border rounded-circle">5</span> Companies viewed your profile recently
                                  </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>  
                </div>
                <!-- Table -->
                <div class="border bg-white my-4 dropdown" style="border-color:#B4B6BD; z-index: -999;" >
                  <div class="d-flex justify-content-between align-items-center px-3 border-bottom" style="border-color:#B4B6BD;z-index: -999;" >
                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active py-3 " id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">RFQ Received</button>
                        <button class="nav-link py-3 " id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">RFQ Sent</button>
                      </div>
                    <a href="#" style="font-size:14px; font-weight:600; color: #4574DD;">View All Events</a>
                   </div>
                   <h5 class="px-3 pt-3">4 Ongoing Events</h5>
                   <div class="tab-content px-3 py-3" id="nav-tabContent">  
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                      <div class="table-responsive">
                      <table class="table table-striped table-hover my-0 border" style="border-color:#B4B6BD;">
                        <thead style="background: #E2E8EA;">
                          <tr>
                            <th>Title</th>
                            <th >Sent By</th>
                            <th >Recevied on</th>
                            <th >Deadline</th>
                            <th >Collaborators</th>
                            <th >Sattus</th>
                            <th ></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Led IPS Monitors</td>
                            <td class="d-xl-table-cell">
                              <div class="d-sm-flex align-items-center gap-2">
                                <img src="{{asset('Admin/assets/dist/images/table-iconOne.png')}}" alt="icon" class="w-auto img-fluid">
                                <p class="fw-bold">ATG Group</p>
                              </div>
                            </td> <td class=" d-xl-table-cell">12/07/2022</td>
                            <td class="d-xl-table-cell">02/08/2022</td>
                            <td class="d-md-table-cell" style="cursor: pointer;">  
                              <span class="nav-icon dropdown-toggle" id="dropdownMenu4" data-bs-toggle="dropdown" aria-expanded="false">4 Members </span>
                              <ul class="dropdown-menu position-absolute end-0 border bg-white " aria-labelledby="dropdownMenu4" style="left:auto; border-color:#B4B6BD; width: 283px; max-width:100%;">
                              <li class="py-3 px-3"> <h6 class="text-uppercase">2 New Notifications</h6>   </li>
                              <li class="d-flex gap-2 border-bottom py-3 px-3">
                                <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                <div>
                                  <h5>Ashish Kumar</h5>
                                  <p>ashish@ashis.com</p>
                                </div>
                              </li>
                              <li class="d-flex gap-2 border-bottom py-3 px-3">
                                <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                <div>
                                  <h5>Umesh Sharma</h5>
                                  <p>Umesh@Umesh.com</p>
                                </div>
                              </li>
                              <li class="d-flex gap-2 border-bottom py-3 px-3">
                                <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                <div>
                                  <h5>Jamesh Fransic</h5>
                                  <p>Jamesh@Jamesh.com</p>
                                </div>
                              </li>
                              <li class="d-flex gap-2 border-bottom py-3 px-3">
                                <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                <div>
                                  <h5>Ashish Kumar</h5>
                                  <p>ashish@ashis.com</p>
                                </div>
                              </li>
                              </ul>
                            </td>
                            <td class="d-md-table-cell"><span class="badge border border-primary text-primary" style="background: #0d6efd14;">NDA Signed</span></td>
                            <td class="d-md-table-cell"><i class="bi bi-chevron-right text-primary"></i></td>
                          </tr>  
                          <tr>
                            <td>Health Monitors</td>
                            <td class=" d-xl-table-cell">
                              <div class="d-sm-flex align-items-center gap-2">
                                <img src="{{asset('Admin/assets/dist/images/table-iconTwo.png')}}" alt="icon" class="w-auto img-fluid">
                                <p class="fw-bold">TLC Pvt Ltd</p>
                              </div>
                            </td>
                            <td class=" d-xl-table-cell">12/07/2022</td>
                            <td class=" d-xl-table-cell">02/08/2022</td>
                            <td class="d-md-table-cell" style="cursor: pointer;">  
                              <span class="nav-icon dropdown-toggle" id="dropdownMenu4" data-bs-toggle="dropdown" aria-expanded="false">4 Members </span>
                              <ul class="dropdown-menu position-absolute end-0 border bg-white " aria-labelledby="dropdownMenu4" style="left:auto; border-color:#B4B6BD; width: 283px; max-width:100%;">
                                <li class="py-3 px-3"> <h6 class="text-uppercase">2 New Notifications</h6>   </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Ashish Kumar</h5>
                                    <p>ashish@ashis.com</p>
                                  </div>
                                </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Umesh Sharma</h5>
                                    <p>Umesh@Umesh.com</p>
                                  </div>
                                </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Jamesh Fransic</h5>
                                    <p>Jamesh@Jamesh.com</p>
                                  </div>
                                </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Ashish Kumar</h5>
                                    <p>ashish@ashis.com</p>
                                  </div>
                                </li>
                                </ul>
                            </td>
                            <td class=" d-md-table-cell"><span class="badge border border-warning  text-warning " style="background: #ffc10712;">Acknowledged</span></td>
                            <td class=" d-md-table-cell"><i class="bi bi-chevron-right text-primary"></i></td>
                          </tr>
                          <tr>
                            <td>Led IPS Monitors</td>
                            <td class="d-xl-table-cell">
                              <div class="d-sm-flex align-items-center gap-2">
                                <img src="{{asset('Admin/assets/dist/images/table-iconOne.png')}}" alt="icon" class="w-auto img-fluid">
                                <p class="fw-bold">ATG Group</p>
                              </div>
                            </td>
                            <td class=" d-xl-table-cell">12/07/2022</td>
                            <td class=" d-xl-table-cell">02/08/2022</td>
                            <td class="d-md-table-cell" style="cursor: pointer;">  
                              <span class="nav-icon dropdown-toggle" id="dropdownMenu4" data-bs-toggle="dropdown" aria-expanded="false">4 Members </span>
                              <ul class="dropdown-menu position-absolute end-0 border bg-white " aria-labelledby="dropdownMenu4" style="left:auto; border-color:#B4B6BD; width: 283px; max-width:100%;">
                                <li class="py-3 px-3"> <h6 class="text-uppercase">2 New Notifications</h6>   </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Ashish Kumar</h5>
                                    <p>ashish@ashis.com</p>
                                  </div>
                                </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Umesh Sharma</h5>
                                    <p>Umesh@Umesh.com</p>
                                  </div>
                                </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Jamesh Fransic</h5>
                                    <p>Jamesh@Jamesh.com</p>
                                  </div>
                                </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Ashish Kumar</h5>
                                    <p>ashish@ashis.com</p>
                                  </div>
                                </li>
                                </ul>
                            </td>
                            <td class=" d-md-table-cell"><span class="badge border border-primary text-primary" style="background: #0d6efd14;">NDA Signed</span></td>
                            <td class=" d-md-table-cell"><i class="bi bi-chevron-right text-primary"></i></td>
                          </tr>
                          <tr>
                            <td>MacBook Displays</td>
                            <td class=" d-xl-table-cell">
                              <div class="d-sm-flex align-items-center gap-2">
                              <img src="{{asset('Admin/assets/dist/images/table-iconThree.png')}}" alt="icon" class="w-auto img-fluid">
                              <p class="fw-bold">Paramount Displays</p>
                            </div>
                          </td>
                            <td class=" d-xl-table-cell">12/07/2022</td>
                            <td class=" d-xl-table-cell">02/08/2022</td>
                            <td class="d-md-table-cell" style="cursor: pointer;">  
                              <span class="nav-icon dropdown-toggle" id="dropdownMenu4" data-bs-toggle="dropdown" aria-expanded="false">4 Members </span>
                              <ul class="dropdown-menu position-absolute end-0 border bg-white " aria-labelledby="dropdownMenu4" style="left:auto; border-color:#B4B6BD; width: 283px; max-width:100%;">
                                <li class="py-3 px-3"> <h6 class="text-uppercase">2 New Notifications</h6>   </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Ashish Kumar</h5>
                                    <p>ashish@ashis.com</p>
                                  </div>
                                </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Umesh Sharma</h5>
                                    <p>Umesh@Umesh.com</p>
                                  </div>
                                </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Jamesh Fransic</h5>
                                    <p>Jamesh@Jamesh.com</p>
                                  </div>
                                </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Ashish Kumar</h5>
                                    <p>ashish@ashis.com</p>
                                  </div>
                                </li>
                                </ul>
                            </td>
                            <td class=" d-md-table-cell"><span class="badge border border-success text-success" style="background: #19875414;">NDA Signed</span></td>
                            <td class=" d-md-table-cell"><i class="bi bi-chevron-right text-primary"></i></td>
                          </tr>       
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
                              <th >Sent By</th>
                              <th >Recevied on</th>
                              <th >Deadline</th>
                              <th >Collaborators</th>
                              <th >Sattus</th>
                              <th ></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Led IPS Monitors</td>
                              <td class="d-xl-table-cell">
                                <div class="d-sm-flex align-items-center gap-2">
                                  <img src="{{asset('Admin/assets/dist/images/table-iconOne.png')}}" alt="icon" class="w-auto img-fluid">
                                  <p class="fw-bold">ATG Group</p>
                                </div>
                              </td> <td class=" d-xl-table-cell">12/07/2022</td>
                              <td class="d-xl-table-cell">02/08/2022</td>
                              <td class="d-md-table-cell" style="cursor: pointer;">  
                                <span class="nav-icon dropdown-toggle" id="dropdownMenu4" data-bs-toggle="dropdown" aria-expanded="false">4 Members </span>
                                <ul class="dropdown-menu position-absolute end-0 border bg-white " aria-labelledby="dropdownMenu4" style="left:auto; border-color:#B4B6BD; width: 283px; max-width:100%;">
                                <li class="py-3 px-3"> <h6 class="text-uppercase">2 New Notifications</h6>   </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Ashish Kumar</h5>
                                    <p>ashish@ashis.com</p>
                                  </div>
                                </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Umesh Sharma</h5>
                                    <p>Umesh@Umesh.com</p>
                                  </div>
                                </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Jamesh Fransic</h5>
                                    <p>Jamesh@Jamesh.com</p>
                                  </div>
                                </li>
                                <li class="d-flex gap-2 border-bottom py-3 px-3">
                                  <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                  <div>
                                    <h5>Ashish Kumar</h5>
                                    <p>ashish@ashis.com</p>
                                  </div>
                                </li>
                                </ul>
                              </td>
                              <td class="d-md-table-cell"><span class="badge border border-primary text-primary" style="background: #0d6efd14;">NDA Signed</span></td>
                              <td class="d-md-table-cell"><i class="bi bi-chevron-right text-primary"></i></td>
                            </tr>  
                            <tr>
                              <td>Health Monitors</td>
                              <td class=" d-xl-table-cell">
                                <div class="d-sm-flex align-items-center gap-2">
                                  <img src="{{asset('Admin/assets/dist/images/table-iconTwo.png')}}" alt="icon" class="w-auto img-fluid">
                                  <p class="fw-bold">TLC Pvt Ltd</p>
                                </div>
                              </td>
                              <td class=" d-xl-table-cell">12/07/2022</td>
                              <td class=" d-xl-table-cell">02/08/2022</td>
                              <td class="d-md-table-cell" style="cursor: pointer;">  
                                <span class="nav-icon dropdown-toggle" id="dropdownMenu4" data-bs-toggle="dropdown" aria-expanded="false">4 Members </span>
                                <ul class="dropdown-menu position-absolute end-0 border bg-white " aria-labelledby="dropdownMenu4" style="left:auto; border-color:#B4B6BD; width: 283px; max-width:100%;">
                                  <li class="py-3 px-3"> <h6 class="text-uppercase">2 New Notifications</h6>   </li>
                                  <li class="d-flex gap-2 border-bottom py-3 px-3">
                                    <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                    <div>
                                      <h5>Ashish Kumar</h5>
                                      <p>ashish@ashis.com</p>
                                    </div>
                                  </li>
                                  <li class="d-flex gap-2 border-bottom py-3 px-3">
                                    <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                    <div>
                                      <h5>Umesh Sharma</h5>
                                      <p>Umesh@Umesh.com</p>
                                    </div>
                                  </li>
                                  <li class="d-flex gap-2 border-bottom py-3 px-3">
                                    <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                    <div>
                                      <h5>Jamesh Fransic</h5>
                                      <p>Jamesh@Jamesh.com</p>
                                    </div>
                                  </li>
                                  <li class="d-flex gap-2 border-bottom py-3 px-3">
                                    <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                    <div>
                                      <h5>Ashish Kumar</h5>
                                      <p>ashish@ashis.com</p>
                                    </div>
                                  </li>
                                  </ul>
                              </td>
                              <td class=" d-md-table-cell"><span class="badge border border-warning  text-warning " style="background: #ffc10712;">Acknowledged</span></td>
                              <td class=" d-md-table-cell"><i class="bi bi-chevron-right text-primary"></i></td>
                            </tr>
                            <tr>
                              <td>Led IPS Monitors</td>
                              <td class="d-xl-table-cell">
                                <div class="d-sm-flex align-items-center gap-2">
                                  <img src="{{asset('Admin/assets/dist/images/table-iconOne.png')}}" alt="icon" class="w-auto img-fluid">
                                  <p class="fw-bold">ATG Group</p>
                                </div>
                              </td>
                              <td class=" d-xl-table-cell">12/07/2022</td>
                              <td class=" d-xl-table-cell">02/08/2022</td>
                              <td class="d-md-table-cell" style="cursor: pointer;">  
                                <span class="nav-icon dropdown-toggle" id="dropdownMenu4" data-bs-toggle="dropdown" aria-expanded="false">4 Members </span>
                                <ul class="dropdown-menu position-absolute end-0 border bg-white " aria-labelledby="dropdownMenu4" style="left:auto; border-color:#B4B6BD; width: 283px; max-width:100%;">
                                  <li class="py-3 px-3"> <h6 class="text-uppercase">2 New Notifications</h6>   </li>
                                  <li class="d-flex gap-2 border-bottom py-3 px-3">
                                    <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                    <div>
                                      <h5>Ashish Kumar</h5>
                                      <p>ashish@ashis.com</p>
                                    </div>
                                  </li>
                                  <li class="d-flex gap-2 border-bottom py-3 px-3">
                                    <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                    <div>
                                      <h5>Umesh Sharma</h5>
                                      <p>Umesh@Umesh.com</p>
                                    </div>
                                  </li>
                                  <li class="d-flex gap-2 border-bottom py-3 px-3">
                                    <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                    <div>
                                      <h5>Jamesh Fransic</h5>
                                      <p>Jamesh@Jamesh.com</p>
                                    </div>
                                  </li>
                                  <li class="d-flex gap-2 border-bottom py-3 px-3">
                                    <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                    <div>
                                      <h5>Ashish Kumar</h5>
                                      <p>ashish@ashis.com</p>
                                    </div>
                                  </li>
                                  </ul>
                              </td>
                              <td class=" d-md-table-cell"><span class="badge border border-primary text-primary" style="background: #0d6efd14;">NDA Signed</span></td>
                              <td class=" d-md-table-cell"><i class="bi bi-chevron-right text-primary"></i></td>
                            </tr>
                            <tr>
                              <td>MacBook Displays</td>
                              <td class=" d-xl-table-cell">
                                <div class="d-sm-flex align-items-center gap-2">
                                <img src="{{asset('Admin/assets/dist/images/table-iconThree.png')}}" alt="icon" class="w-auto img-fluid">
                                <p class="fw-bold">Paramount Displays</p>
                              </div>
                            </td>
                              <td class=" d-xl-table-cell">12/07/2022</td>
                              <td class=" d-xl-table-cell">02/08/2022</td>
                              <td class="d-md-table-cell" style="cursor: pointer;">  
                                <span class="nav-icon dropdown-toggle" id="dropdownMenu4" data-bs-toggle="dropdown" aria-expanded="false">4 Members </span>
                                <ul class="dropdown-menu position-absolute end-0 border bg-white " aria-labelledby="dropdownMenu4" style="left:auto; border-color:#B4B6BD; width: 283px; max-width:100%;">
                                  <li class="py-3 px-3"> <h6 class="text-uppercase">2 New Notifications</h6>   </li>
                                  <li class="d-flex gap-2 border-bottom py-3 px-3">
                                    <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                    <div>
                                      <h5>Ashish Kumar</h5>
                                      <p>ashish@ashis.com</p>
                                    </div>
                                  </li>
                                  <li class="d-flex gap-2 border-bottom py-3 px-3">
                                    <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                    <div>
                                      <h5>Umesh Sharma</h5>
                                      <p>Umesh@Umesh.com</p>
                                    </div>
                                  </li>
                                  <li class="d-flex gap-2 border-bottom py-3 px-3">
                                    <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                    <div>
                                      <h5>Jamesh Fransic</h5>
                                      <p>Jamesh@Jamesh.com</p>
                                    </div>
                                  </li>
                                  <li class="d-flex gap-2 border-bottom py-3 px-3">
                                    <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                    <div>
                                      <h5>Ashish Kumar</h5>
                                      <p>ashish@ashis.com</p>
                                    </div>
                                  </li>
                                  </ul>
                              </td>
                              <td class=" d-md-table-cell"><span class="badge border border-success text-success" style="background: #19875414;">NDA Signed</span></td>
                              <td class=" d-md-table-cell"><i class="bi bi-chevron-right text-primary"></i></td>
                            </tr>       
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

@endsection