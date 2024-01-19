@extends('Admin.layout.app')
@section('admincontent')


<link rel="stylesheet" href="{{asset('Admin/assets/dist/css/custome-invite.css')}}">

<link rel="stylesheet" href="{{ asset('Admin/assets/dist/css/bootstrap-tagsinput.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<style>
    span.tag.label.label-info {
        color: black;
        background-color: #5bc0de;
        margin-right: 2px;
        color: white;
        display: inline;
        padding: 0.2em 0.6em 0.3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25em;
}

.dark{
    color:black !important;
}
.bootstrap-tagsinput input{
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    margin-top: 10px;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.memberImg{
    height:40px;
    width:45px;
    float:left;
    padding: 6px;
}



</style>
<!-- message close -->
<section id="page">
    <section class="wrapper w-100 d-flex">
        <section id="main" class="d-flex flex-column">
            <div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">
                <!-- Welcome -->
                <div class="d-md-block d-none flex-wrap gap-3 welcomeBox">
                    <!-- <div class="title pb-4 d-flex flex-column w-50 gap-2 flr">
                        <h2>Invites Members </h2>
                    </div> -->
                    <div class="title pb-4 d-flex flex-column w-100 gap-2">
                        <div class="text-btn">
                        <h2 class=" position-relative">Invites Members</h2>
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teamModal">Invites Members</a>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                </div>
                <!-- Table -->
                <div class="nav nav-tabs row newtab gap-3 gap-md-0" id="nav-tab" role="tablist">


                </div>
                <div class="d-flex justify-content-between align-items-center px-3">
                </div>
                <div class="border bg-white my-4" style="border-color:#B4B6BD;">
                    <h5 class="px-3 pt-3"> Invites Members LIst </h5>
                    <div class="tab-content px-3 py-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover " style="border-color:#B4B6BD;padding-top: 10px;" id="myTable">
                                 <thead style="background: #E2E8EA;">
                                    <tr>
                                       <th>S.No</th>
                                       <th>Name</th>
                                       <th>Email</th>
                                       <th>Profile</th>
                                       <th>Role</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <!--team momber-->
                                 <tbody>
                                    @foreach($teams as $key=>$team)
                                     <tr>
                                       <td>{{$key+1}}</td>
                                       <td>{{$team->firstname}} {{$team->lastname}}</td>
                                       <td>{{$team->email}}</td>
                                       <td>{{$team->jobrole_name}}</td>
                                       <td>{{$team->usertype == 'admin' ? $team->usertype : $team->userrole_name }}</td>
                                       <td class="{{$team->member_status == '1' ? 'text-success' : 'text-danger'}}">{{$team->member_status == '1' ? 'active' : ' inactive'}}</td>
                                       <td> 
                                            <a href="{{Route('invites.edit',$team->id)}}">
                                                <i class="fa fa-edit" aria-hidden="true" style="font-size: 22px; position: relative; right: -25px;"></i>
                                            </a>
                                       </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Upcoming -->

            </div>
            </div>
        </section>
    </section>
</section>
<!-- ===============================  model open  ================================ -->
 <!-- Modal -->
 <div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="teamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="team-member-box">
                    <div class="team-member-input">
                    <div class="row">
               <!-- form open -->
               <form action="{{Route('invites-members.invitesMembers')}}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="add-team-titile">
                        <h4>Team Member Details</h4>
                        <p>Add your Team Members to the team by email address to whom you would like to show the dashboards.</p>
                        </div>
                    </div>
                
                    <div class="col-lg-12 col-md-6 col-sm-12">
                         <label for="email" >Email</label>
                            <input type="" name="email" class="form-control" data-role="tagsinput" style=" width: 100%;">
                        </div>
                    <span id="processingMessage" class="text-success"></span>        
                    <div class="col-12 col-md-8 text-start mt-5">
                    
                    </div>
                
                  <!-- form close -->
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="add-team-titile">
                  <h4>Allow pages to monitor</h4>
                  <p>Allow your team members to view specific modules of your Shopify store.</p>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="p-l-modules">
                  <h3>P&L Modules</h3>

                  <div class="p-l-modules-box">
                    <label>P&L Insight Reports <input type="checkbox" /></label>
                    <label>Store Performance <input type="checkbox" /></label>
                    <label>Order Wise P&L <input type="checkbox" /></label>
                    <label>Update Products COGS <input type="checkbox" /></label>
                    <label>P&L Insight Reports <input type="checkbox" /></label>
                    <label>Store Performance <input type="checkbox" /></label>
                    <label>Order Wise P&L <input type="checkbox" /></label>
                    <label>Update Products COGS <input type="checkbox" /></label>
                  </div>
                </div>
              </div>
             
              <div class="col-12 col-md-8 text-start">
                    
                    <button type="submit" class="btn btn-primary px-4">Send</button>
                    <button class="btn btn-outline-secondary px-4 me-2" id="cancleModel">Cancel</button>

                    </form>
              </div>
            </div>
                        
                        
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>

  <!-- Modal -->
<!-- ===============================  model close ================================ -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js" ></script>

<!-- // email group  close -->

<script>
   
    $(document).ready(function () {
      
        $('#openModalBtn').on('click', function () {
             $('#myModal').modal('show');
        });
        $('#cancleModel').on('click', function() {
              console.log('cancel model clicked');
              $('#teamModal').modal('hide'); 
              $('#processingMessage').text('');
        });

    });
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
      <script>
          jQuery(document).ready(function() {
            jQuery('#myTable').DataTable({
               "pageLength": 50,
            });
          });
      </script>
@endsection
