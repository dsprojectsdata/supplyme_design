@extends('Admin.layout.app')
@section('admincontent')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<style>
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
                  <!-- Welcome -->
                  <div class="d-md-block d-none flex-wrap gap-3 welcomeBox">
                     <div class="title pb-4 d-flex flex-column w-50 gap-2 flr">
                        <h2>Role List</h2>
                     </div>
                     <div class="title pb-4 d-flex flex-column w-50 gap-2">
                        <form class="frompart">
                           <div class="plus-simble"><a href="{{Route('role.create')}}"> <i class="bi bi-plus"></i> Launch New Role</a></div>
                        </form>
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
                     <div class="tab-content px-3 py-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                           <div class="table-responsive">
                              <table class="table table-striped table-hover " style="border-color:#B4B6BD;padding-top: 10px;" id="myTable">
                                 <thead style="background: #E2E8EA;">
                                    <tr>
                                       <th>S.No</th>
                                       <th>Role Name</th>
                                       <th>Permission</th>
                                       <th >Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($roles as $key=>$role)
                                     <tr>
                                       <td>{{$key+1}}</td>
                                       <td>{{$role->role_name}}</td>
                                       <td>{{$role->permission}}</td>
                                        <td class=" d-md-table-cell">
                                            <a href="{{Route('role.edit',$role->id)}}">
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
            });
          });
      </script>
   </body>
</html>

@endsection