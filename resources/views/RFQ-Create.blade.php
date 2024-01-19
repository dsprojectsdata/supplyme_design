@extends('Admin.layout.app')
@section('admincontent')
      <section id="page">
         <section class="wrapper w-100 d-flex">
            <section id="main" class="d-flex flex-column">
               <div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">
                  <!-- Welcome -->
                  <div class="d-md-block d-none flex-wrap gap-3 welcomeBox">
                     <div class="title pb-4 d-flex flex-column w-50 gap-2 flr">
                        <h2>REQ Events / Draft</h2>
                     </div>
                     <div class="title pb-4 d-flex flex-column w-50 gap-2">
                        <form class="frompart">
                           <select class="">
                              <option>Show: RFQ  Received</option>
                              <option>Show: RFQ  Send</option>
                           </select>
                           <div class="plus-simble"><a href="{{Route('RFQ.create')}}"> <i class="bi bi-plus"></i> Launch New RFQ</a></div>
                        </form>
                     </div>
                     <div class="row">
                     </div>
                  </div>
                  <!-- Table -->
                  <div class="nav nav-tabs row newtab gap-3 gap-md-0" id="nav-tab" role="tablist">
                     @php
                        $rfqdetail_count = $rfqdetails->count() ;
                     @endphp
                     <div class="col-12 col-md-4 "> <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All SENT EVENTS <span>{{$rfqdetail_count}}</span></a></div>
                     <!-- <div class="col-12 col-md-4 "><a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">On Going <span>5</span></a></div>
                     <div class="col-12 col-md-4 ">
                        <a class="nav-link text-left" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Completed <span>10</span></a>
                     </div> -->
                  </div>
                  <div class="d-flex justify-content-between align-items-center px-3">
                  </div>
                  <div class="border bg-white my-4" style="border-color:#B4B6BD;">
                     <h5 class="px-3 pt-3">Showing 11 RFQ Events Sent</h5>
                     <div class="tab-content px-3 py-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                           <div class="table-responsive">
                              <table class="table table-striped table-hover my-0 border" style="border-color:#B4B6BD;" id="myTable">
                                 <thead style="background: #E2E8EA;">
                                    <tr>
                                       <th>Title</th>
                                       <th >Sent Date</th>
                                       <th >No. of suppliers</th>
                                       <th >Collabrorators</th>
                                       <th >Activity</th>
                                       <th ></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($rfqdetails as $rfqdetail)
                                       @php
                                        
                                          $memberData = $rfqdetail->add_tem_member;
                                          $memberArray = explode(',', $memberData);
                                          $count_member = count($memberArray);
                                        
                                          $supplierData = $rfqdetail->supplier_add;
                                          $supplierArray = explode(',', $supplierData);
                                          $count_supplier = count($supplierArray);

                                        @endphp

                                    <tr>
                                       <td>{{$rfqdetail->rfq_name}}</td>
                                       <td class=" d-xl-table-cell">{{date('d-m-Y', strtotime($rfqdetail->created_at)) }} </td>
                                       <td class=" d-md-table-cell">{{$count_supplier}}</td>
                                       <td class="d-md-table-cell onclick-popup" style="cursor: pointer;">  
                                          <span class="nav-icon dropdown-toggle" id="dropdownMenu4" data-bs-toggle="dropdown" aria-expanded="false">{{$count_member}} </span>
                                          <ul class="dropdown-menu position-absolute end-0 border bg-white " aria-labelledby="dropdownMenu4">
                                          <li class="py-2 px-3 pt-3"> <h6 class="">1 Collaborators</h6>   </li>
                                          <li class="d-flex gap-2 border-bottom py-3 px-3">
                                            <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"><span class="dot-green"></span></div>
                                            <div class="profile-text">
                                              <h5>Ashish Kumar</h5>
                                              <p>ashish@ashis.com</p>
                                            </div>
                                          </li>
                                          </ul>
                                        </td>
                                      
                                       <td class="d-xl-table-cell onclick-popup">
                                          <div class="d-flex align-items-center gap-2 nav-icon dropdown-toggle" id="dropdownMenu5" data-bs-toggle="dropdown" aria-expanded="false">
                                             <img src="{{asset('Admin/assets/dist/images/table-iconOne.png')}}" alt="icon" class="w-auto img-fluid">
                                             <p class="fw-bold"><a href="#">NDA Signed +more</a></p>
                                          </div>
                                          <ul class="dropdown-menu position-absolute end-0 border bg-white " aria-labelledby="dropdownMenu5">
                                          <li class="py-2 px-3 pt-3"> <h6 class="">RFQ Company Status</h6>   </li>
                                          <li class="d-flex gap-2 border-bottom py-3 px-3">
                                            <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                            <div class="profile-text">
                                              <h5>ATG Group <b>5h ago</b></h5>
                                              <p>Kota, Rajasthan</p>
                                              <button type="button" class="btn btn-outline-primary">NDA Signed</button>
                                            </div>
                                          </li>
                                          <li class="d-flex gap-2 border-bottom py-3 px-3">
                                            <div class="profile rounded-circle"><img src="{{asset('Admin/assets/dist/images/profile.png')}}" alt="img"></div>
                                            <div class="profile-text">
                                              <h5>TLC Pvt Ltd <b>2h ago</b></h5>
                                              <p>Ahmedabad, Gujarat</p>
                                              <button type="button" class="btn btn-outline-primary">RFQ Achnowleged</button>
                                            </div>
                                          </li>
                                          
                                          </ul>

                                       </td>
                                       <td class=" d-md-table-cell"><a href="{{Route('RFQ.show',$rfqdetail->id)}}"><i class="bi bi-chevron-right text-primary"></a></i></td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
               </div>
            </section>
         </section>
      </section>
       <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" defer>
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
      <script>
          jQuery(document).ready(function() {
            jQuery('#myTable').DataTable();
         });
      </script>
   </body>
</html>

@endsection