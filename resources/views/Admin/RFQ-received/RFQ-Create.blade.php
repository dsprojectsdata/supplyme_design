@extends('Admin.layout.app')
@section('admincontent')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<style>
   a#companyname {
    color: #444444;
}
a#companyname:hover {
    color: #2f2fff;
}
/* Disney-inspired DataTable styling */
.disney-table {
  border-collapse: collapse;
  width: 100%;
  border: 2px solid #f2f2f2;
  font-family: 'Arial', sans-serif;
}

.disney-table th {
  background-color: #0061b0;
  color: white;
  font-weight: bold;
  padding: 10px;
  text-align: left;
}

.disney-table th,
.disney-table td {
  border: 1px solid #f2f2f2;
  padding: 10px;
}

.disney-table tbody tr:nth-child(even) {
  background-color: #f2f2f2;
}

.disney-table tbody tr:hover {
  background-color: #e0e0e0;
}
</style>
      <section id="page">
         <section class="wrapper w-100 d-flex">
            <section id="main" class="d-flex flex-column">
               <div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">
               @if ($message = Session::get('success'))
                  <div class="alert alert-success alert-top-border alert-dismissible fade show my-4" role="alert">
                     <i class="mdi mdi-check-all me-3 align-middle text-success"></i><strong>Success</strong> - {{$message}}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
               @endif
                  <!-- Welcome -->
                  <div class="d-md-block d-none flex-wrap gap-3 welcomeBox">
                     <div class="title pb-4 d-flex flex-column w-50 gap-2 flr">
                        <h2>RFQ Supplier</h2> 
                     </div>
                     <!-- <div class="title pb-4 d-flex flex-column w-50 gap-2">
                        <form class="frompart">
                           <select class="">
                              <option>Show: RFQ  Received</option>
                              <option>Show: RFQ  Send</option>
                           </select>
                           <div class="plus-simble"><a href="{{Route('RFQ.create')}}"> <i class="bi bi-plus"></i> Launch New RFQ</a></div>
                        </form>
                     </div> -->
                     <div class="row">
                     </div>
                  </div>
                  <!-- Table -->
                  <div class="nav nav-tabs row newtab gap-3 gap-md-0 my-4" id="nav-tab" role="tablist">
                  @php
                        $rfqdetails_received_conut = $rfqdetails_received->count() ;
                     @endphp
                     <!-- <div class="col-12 col-md-4 "> <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All SENT EVENTS <span>{{$rfqdetails_received_conut}}</span></a></div> -->
                     <!-- <div class="col-12 col-md-4 "><a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">On Going <span>5</span></a></div>
                     <div class="col-12 col-md-4 ">
                        <a class="nav-link text-left" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Completed <span>10</span></a>
                     </div> -->
                  </div>
                  <div class="d-flex justify-content-between align-items-center px-3">
                  </div>
                  <div class="border bg-white my-4" style="border-color:#B4B6BD;">
                     <div class="tab-content px-3 py-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                           <div class="table-responsive">
                              <table class="table table-striped table-hover" style="border-color:#B4B6BD;padding-top: 10px;" id="myTable">  
                                 <thead style="background: #E2E8EA;">
                                    <tr>
                                       <th>Title</th>
                                       <th>Type</th>
                                       <th>Category</th>
                                       <th>Company Sender Name</th>
                                       <th>Bid Submission Date</th>
                                       <th>Activity</th>
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
                                       <td class=" d-md-table-cell"><a href="{{Route('RFQ.individualReceived',$rfqdetail->id)}}"><i class="fa fa-eye" aria-hidden="true" style="font-size: 22px; position: relative; right: -25px;"></i></td>
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
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
      <script>
         jQuery(document).ready(function() {
            jQuery('#myTable').DataTable({
              "pageLength": 50,
               "order": [[5, 'desc']] 
            });
          });
      </script>
   </body>
</html>
@endsection