@extends('Admin.layout.app')
@section('admincontent')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" />
<link href="{{asset('SuperAdmin/assets/libs/choices.js/public/assets/styles/choices.min.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('SuperAdmin/assets/js/pages/form-advanced.init.js')}}"></script>
<script src="{{asset('SuperAdmin/assets/libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
  <script src="{{asset('Admin/assets/dist/js/Rfq.js')}}"></script>
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
.locationboard{
     border: 1px #ccd0d3 solid;
     width: 163px;
}


.searchResults {
    /* height: 300px; */
    overflow-y: auto;
    overflow-x: auto;
    background-color: #fff;
    border: 1px solid #dfe6ec;
    box-shadow: 0 0.125rem 0.375rem rgb(0 0 0 / 10%);
    z-index: 10;
}
.searchResults__list {
    margin: 0;
    padding: 0;
    list-style: none;
}
.cyc-searchResultsCTA {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
    box-shadow: 0 -0.25rem 0.25rem rgb(0 0 0 / 5%);
    border-top: 1px solid #dfe6ec;
    border-bottom: 1px solid #dfe6ec;
}

.searchResults__list {
    margin: 0;
    padding: 0;
    list-style: none;
}
 
.cyc-searchResultsItem {
    align-items: center;
    background-color: #fff;
    display: flex;
    flex-wrap: nowrap;
    list-style-type: none;
    padding: 0.75rem;
    position: relative;
}
.cyc-searchResultsItem__logo {
    border-radius: 50%;
    height: 100%;
    margin-right: 0.5rem;
    max-height: 3.125rem;
    max-width: 3.125rem;
    width: 100%;
}
.cyc-searchResultsItem__titleWrapper {
    flex-grow: 1;
}
.cyc-searchResultsItem__title {
    margin-top: 0;
    margin-bottom: 0;
}
.cyc-searchResultsItem__subTitle {
    color: #616668;
    margin-top: 0;
    margin-bottom: 0;
}
.btn-sm {
    padding: 0.5rem;
    font-size: .875rem;
    line-height: 1;
    border-radius: 0.2rem;
}
.cyc-searchResultsItem__claimed {
    color: #a4acb3;
}
.icon {
    display: inline-block;
    width: 1em;
    height: 1em;
    vertical-align: -0.125em;
    fill: currentColor;
}
.cyc-searchResultsCTA {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
    box-shadow: 0 -0.25rem 0.25rem rgb(0 0 0 / 5%);
    border-top: 1px solid #dfe6ec;
    border-bottom: 1px solid #dfe6ec;
}
.login-page {
  max-width: 450px;
  width: 95%;
  background: #fff;
  padding: 50px;
  border-radius: 10px;
  max-height: calc(100vh - 50px);
}
input.choices__input.choices__input--cloned {
    height: 0;
    width: 0;
    padding: 0;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    background: transparent;
    bottom: 0;
    color: transparent;
    cursor: pointer;
    height: auto;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: auto;
}
/* CSS for the loader */
.loader-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent background */
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999; /* Ensure the loader stays on top */
}

.loader {
  border: 5px solid #f3f3f3; /* Light grey */
  border-top: 5px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 50px;
  height: 50px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div id="loader" class="loader-container">
  <div class="loader"></div>
</div>
        <div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">
          <!-- Welcome -->
          <div class="d-block flex-wrap gap-3 welcomeBox">
            <div class="title pb-4 d-flex flex-column w-100 gap-2">
              <h2 class=" position-relative"> New Request For Quote</h2>
               
              <div class="d-md-flex justify-content-between">
                <p class="pb-2">Complete all necessary steps to launch your new RFQ.</p>
                
              </div>
            </div>
       <form action="{{Route('RFQ.update',$rfqdetail->id)}}" id="rfqdata" enctype="multipart/form-data" method="POST">    
          @csrf 
          @method('PUT')
            <div class="row">
              <div class="col-12 col-md-5 col-xl-3 mb-3 mb-md-0">
                <div class="border bg-white compnay-tabs-ul" style="border-color:#B4B6BD;">
                  <ul class="d-flex flex-column nav nav-tabs listing nav-RFQ" id="nav-tabs" role="tablist">
                    <li class="rfq-details"><a id="nav-product-tab" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-product"
                        type="button" role="tab" aria-controls="nav-product" aria-selected="true" href="#"
                        class=" nav-link active py-3 px-4 d-block position-relative sh"><span
                          class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">1</span>Product
                        Detailes (RFQ Details)</a></li>
                    <li class="letter"><a id="nav-contract-tab" data-bs-toggle="tab" data-bs-toggle="tab"
                        data-bs-target="#nav-contract" type="button" role="tab" aria-controls="nav-contract"
                        aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative sh"><span
                          class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">2</span>Cover
                        letter</a></li>
                    <li class="sheet"><a id="nav-add-tab" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-add"
                        type="button" role="tab" aria-controls="nav-add" aria-selected="false" href="#"
                        class="nav-link py-3 px-4 d-block position-relative sh"><span
                          class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">3</span>Bid
                        Sheet</a></li>
                    <li class="instruction"><a id="nav-conditional-tab" data-bs-toggle="tab" data-bs-toggle="tab"
                        data-bs-target="#nav-conditional" type="button" role="tab" aria-controls="nav-conditional"
                        aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative sh"><span
                          class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">4</span>Bid
                        Instruction</a></li>
                    <li><a id="nav-bid-tab" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-bid"
                        type="button" role="tab" aria-controls="nav-bid" aria-selected="false" href="#"
                        class="nav-link py-3 px-4 d-block position-relative sh"><span
                          class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">5</span>Conditional
                        Offers</a></li>
                    <li><a id="nav-questionair-tab" data-bs-toggle="tab" data-bs-toggle="tab"
                        data-bs-target="#nav-questionair" type="button" role="tab" aria-controls="nav-questionair"
                        aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative sh"><span
                          class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">6</span>Questionnaire </a>
                    </li>
                    <li><a id="nav-supplier-tab" data-bs-toggle="tab" data-bs-toggle="tab"
                        data-bs-target="#nav-supplier" type="button" role="tab" aria-controls="nav-supplier"
                        aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative sh"><span
                          class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3 ">7</span>Supplier
                        Selection</a></li>

                    <li><a id="nav-finalize-tab"  data-bs-toggle="tab" data-bs-toggle="tab"
                        data-bs-target="#nav-finalize" type="button" role="tab" aria-controls="nav-finalize"
                        aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative Finalize"><span
                          class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">8</span>Finalize</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-12 col-md-7 col-xl-9 ">
                <div class="border bg-white p-3 px-sm-4 py-sm-4 tab-content" id="nav-tabContent"
                  style="border-color:#B4B6BD;">
                  <div class="tab-pane fade show active" id="nav-product" role="tabpanel"
                    aria-labelledby="nav-home-tab">
                    <div class="d-flex flex-column pb-3">
                      <h2 class="pb-2">1. RFQ Details   </h2>
                      <p>A short description about the Product Details required.</p>
                    </div>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <!--About-->
                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="flush-headingOne">
                          <button class="accordion-button collapsed d-flex gap-3 rfq-type" style="background:#EAEFF0;"
                            type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                            aria-expanded="false" aria-controls="flush-collapseOne"> About RFQ</button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                          aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">
                              <div class="row gap-3 gap-xl-0 ">
                              <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                      <b>RFQ Type - Product / Services </b>
                                      <div class="radio-custme">
                                        <div class="radio-custme-in">
                                          <input type="radio" id="product" name="rfq_type" value="product" {{$rfqdetail->rfq_type == 'product' ?  'checked' : ' '}} >
                                          <label for="product">Product</label>
                                        </div>
                                        <div class="radio-custme-in">
                                          <input type="radio" id="services" value="services" name="rfq_type" {{$rfqdetail->rfq_type == 'services' ?  'checked' : ' '}}>
                                          <label for="services">Services</label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                      <b>RFQ Name <span class="text-danger">*</span></b>
                                      <input type="text" id="rfq_name" name="rfq_name" placeholder="RFQ Name" value="{{$rfqdetail->rfq_name}}" required>
                                    </div>
                                    @error('rfq_name')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                  </div>
                                  <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                      <b>Category <span class="text-danger">*</span></b>
                                      <select id="category" name="category_id" required>
                                          <option>Category</option>
                                          @foreach($category as $key=>$cat)
                                            <option {{$rfqdetail->category_id == $cat->id ?  'selected' : ' '}} value="{{$cat->id}}" data-cat_id="">{{$cat->name}}</option>
                                          @endforeach
                                      </select>
                                      @error('category_id')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                          @enderror
                                    </div>
                                  </div>
                                  <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                      <b>Sub-Category <span class="text-danger">*</span></b>
                                      <select id="subcategory" name="subcategory_id" required>
                                        <option>Sub-Category</option>
                                        <option  value="{{$subcategory ? $subcategory->id : ' '}}" selected  data-cat_id="">{{$subcategory ? $subcategory->name : ' '}}</option>
                                      </select>
                                      @error('subcategory_id')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                          @enderror
                                    </div>
                                  </div>
                                  <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                      <b>Demand type <span class="text-danger">*</span></b>
                                      <div class="radio-custme">
                                        <div class="radio-custme-in">
                                        <input type="radio" id="test1" name="demandtype" value="One Time" {{$rfqdetail->demandtype == 'One Time' ?  'checked' : ' '}} > 
                                          <label for="test1">One Time</label>
                                        </div>
                                        <div class="radio-custme-in">
                                        <input type="radio" id="test2" value="Recurring" name="demandtype" {{$rfqdetail->demandtype == 'Recurring' ?  'checked' : ' '}}>
                                          <label for="test2">Recurring</label>
                                        </div>
                                      </div>
                                      @error('demandtype')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                          @enderror
                                    </div>
                                  </div>
                                </div>
                          </div>
                        </div>
                      </div>
                      <!--Location-->
                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="flush-headingOne">
                          <button class="accordion-button collapsed d-flex gap-3 rfq-type" style="background:#EAEFF0;"
                            type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne-2"
                            aria-expanded="false" aria-controls="flush-collapseOne-2">Location</button>
                        </h2>
                        <div id="flush-collapseOne-2" class="accordion-collapse collapse"
                          aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">
                              <table class="table table-bordered">
                                  <thead>
                                    <tr class="locationboard">
                                      <th class="locationboard" scope="col">Country</th>
                                      <th class="locationboard" scope="col">State</th>
                                      <th class="locationboard" scope="col">City</th>
                                      <th class="locationboard" scope="col">Zip Code</th>
                                      <th class="locationboard" scope="col">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody id="accordion-body-location">
                                      @if(count($rfqlocation)>0)
                                          @foreach($rfqlocation as $index=>$location)
                                             @php
                                                $state = App\Models\State::where('id',$location->state_id)->first();
                                                $city = App\Models\City::where('id',$location->city_id)->first();
                                             @endphp
                                              <tr class="locationboard remove-location" >
                                                <td class="locationboard " >
                                                    <div class="input-wrapper">
                                                        <select id="country" class="country_1" name="country_id[]" data-country_id="1" require>
                                                          <option >Select</option>
                                                          @foreach($countries as $key=>$country)
                                                           <option {{$location->countrie_id == $country->id ?  'selected' : ' '}} value="{{$country->id}}" >{{$country->name}}</option>
                                                          @endforeach
                                                        </select>
                                                      </div>
                                                </td>
                                                <td class="locationboard" >
                                                      <div class="input-wrapper">
                                                        <select id="state_1" class="state" name="state_id[]" data-state_id="1" require>
                                                            @if($state)
                                                              <option value="{{$location->state_id}}">{{$state->name}}</option> 
                                                            @endif  
                                                        </select>
                                                      </div>
                                                  </td>
                                                <td class="locationboard" >
                                                      <div class="input-wrapper">
                                                        <select id="city_1" name="city_id[]" require>
                                                            @if($city)
                                                              <option value="{{$location->city_id}}">{{$city->name}}</option> 
                                                            @endif 
                                                        </select>
                                                      </div> 
                                                  </td>
                                                <td class="locationboard" >
                                                      <div class="input-wrapper">
                                                        <input type="number" name="zipcode[]" value="{{$location->zipcode}}" placeholder="" require>
                                                        <input type="hidden" name="rfqlocation_id[]" value="{{$location->id}}" placeholder="" require>
                                                      </div>
                                                  </td>
                                                    @if($rfqlocation)
                                                        @if($index == '0')
                                                        
                                                        <td class="locationboard row" >
                                                            <a style="position: relative; " class="btn btn-outline-primary add-icon col-sm-4" id="add-location"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                              <a href="#" style="border-radius: 5px;" class="close-icon  delete-location  btn-danger text-dark  location_remove col-sm-4" data-location_id="{{$location->id}}" data-member-id="-${country_id}"><img src="https://updateproject.com/supplyme/public/Admin/assets/dist/images/trash-icon1.svg" style="width: 50px; height: 35px"></a>
                                                        </td>
                                                        @else
                                                         <td class="locationboard">
                                                               <a href="#" style="position: relative" class="close-icon  delete-location btn btn-danger text-dark  location_remove" data-location_id="{{$location->id}}" data-member-id="-${country_id}"><img src="https://updateproject.com/supplyme/public/Admin/assets/dist/images/trash-icon1.svg" style="width: 20px;height: 20px;"></a>
                                                          </td>
                                                        @endif 
                                                    @else
                                                    <td class="locationboard" >
                                                            <a style="position: relative; " class="btn btn-outline-primary add-icon" id="add-location"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                        </td>
                                                    @endif 
                                            </tr>
                                          @endforeach
                                        @else
                                          <tr class="locationboard " >
                                            <td class="locationboard" >
                                                <div class="input-wrapper">
                                                    <select id="country" class="country_1" name="country_id[]" data-country_id="1" require>
                                                      <option value=" ">Select</option>
                                                      @foreach($countries as $key=>$country)
                                                       <option value="{{$country->id}}" >{{$country->name}}</option>
                                                      @endforeach
                                                    </select>
                                                  </div>
                                            </td>
                                            <td class="locationboard" >
                                                  <div class="input-wrapper">
                                                    <select id="state_1" class="state" name="state_id[]" data-state_id="1" require>
                                                        <option value=" ">Select</option> 
                                                    </select>
                                                  </div>
                                              </td>
                                            <td class="locationboard" >
                                                  <div class="input-wrapper">
                                                    <select id="city_1" name="city_id[]" require>
                                                        <option value=" ">Select</option> 
                                                    </select>
                                                  </div> 
                                              </td>
                                            <td class="locationboard" >
                                                  <div class="input-wrapper">
                                                    <input type="number" name="zipcode[]" placeholder="" require>
                                                    <input type="hidden" name="rfqlocation_id[]" value="0" >
                                                  </div>
                                              </td>
                                            <td class="locationboard" >
                                                <a style="position: relative; ;" class="btn btn-outline-primary add-icon" id="add-location"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                      @endif
                                  </tbody>
                                </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="nav-contract" role="tabpanel" aria-labelledby="nav-contract-tab">
                    <div class="d-flex flex-column pb-3">
                      <h2 class="pb-2">2. Cover Letter <span class="text-danger">*</span></h2>
                      <p>A short description about the Product Details required.</p>
                    </div>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="flush-headingOne">
                          <button class="accordion-button collapsed d-flex gap-3" style="background:#EAEFF0;"
                            type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                            aria-expanded="false" aria-controls="flush-collapseOne">
                            Cover Letter
                          </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                          aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">
                            <p class="note px-3 py-3 rounded-3 d-flex gap-2"><i
                                class="bi bi-exclamation-circle-fill"></i> <span> Nondisclosure agreements (also called
                                NDAs) have become increasingly important for businesses of all sizes, serving as the
                                first line of defense in protecting inventions, trade secrets, and hard work.</span></p>
                              <div class="form-group " x-data="{ fileName: '' }">
                                <div class="input-group pt-3">

                                  <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                      <b>Cover Letter</b>
                                         <textarea placeholder="Write Comment" class="cover_letter" cols="30" rows="10"  name="cover_letter" id="cover_letter" required>{{$rfqdetail->cover_letter}}</textarea>
                                    </div>
                                  </div>
                                  <div class="col-12 col-xl-12">
                                    <div class="input-wrapper">
                                      <b>Sample Cover Letter </b>
                                    </div>
                                  </div>
                                  <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                    <div class="row gap-3 gap-md-0">
                                      @foreach($coverletters as $key=>$coverletter)
                                        <div class="col-12 col-md-6 col-lg-3">
                                          <figure><img src="{{asset('Admin/assets/dist/images/page.png')}}" class="img-fluid mx-auto w-100" alt="page" data-cover_id="{{$coverletter->id}}" id="coverimg"></figure>
                                          <figcaption class="text-center py-3" style="font-size:16px; font-weight:600; color:#000;">{{$coverletter->title}} {{$key+1}} </figcaption>
                                        </div>
                                      @endforeach
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- <button class="btn btn-outline-primary text-uppercase  py-md-3 py-2 border-2 d-flex gap-2 my-3 justify-content-center align-items-center" style="font-size: 16px; font-weight: bold;"><i class="bi bi-box-arrow-down d-none d-md-block"></i> Download Cotract Template</button>-->
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="headingTwo">
                          <button class="accordion-button collapsed" style="background:#EAEFF0;" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseTwo45" aria-expanded="false"
                            aria-controls="collapseTwo45">
                            NDA 
                          </button>
                        </h2>
                        <div id="collapseTwo45" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                          data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            <div class="row">
                              <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>NDA File - Word & PDF</b>
                                    <input type="file"  multiple id="upload-img-nda" name="nda_file[]"  accept=".pdf,.doc,.docx">
                                </div>
                              </div>
                              <div class="col-sm-2"></div>
                               <div class="col-4 col-xl-4 mb-0 mb-xl-3" style=" position: relative;top: 48px;">
                                  <b>NDA Auto Approval </b>
                                  <input name="nda_auto_approval"  type="checkbox"   id="flexCheckDefault" >
                                </div>
                              <div class="clearfix"></div>
                              <div class="row" id="img-preview-nda">

                               
                              </div>
                              @foreach($rfqnda as $nda)
                                <div class="col-6 col-xl-6 mb-3">
                                    <div class="upload-view-file">
                                    <span><img src="{{asset('Admin/assets/dist/images/page.png')}}" ></span>
                                    <div class="upload-nda-text">
                                        <h2>{{$nda->nda_name}}</h2>
                                        <p>Size : <b>25 KB</b></p>
                                        <p>Date & Time : <b>{{$nda->created_at}}</b></p>
                                    </div>
                                    <a class="trash-img  remove_nda" data-nda_id="{{$nda->id}}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                    </div>
                                </div>
                              @endforeach 
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="headingThree">
                          <button class="accordion-button collapsed" style="background:#EAEFF0;" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                            aria-controls="collapseThree">
                            Contract (Optional)
                          </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                          data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            <div class="row">
                              <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>Contract File - Word, PDF</b>
                                     <input type="File" name="contract_file[]" id="upload-img-contract" multiple accept=".pdf,.doc,.docx" placeholder="NDA File - Word & PDF">
                                </div>
                              </div>
                              <div id="img-preview-contract"> 

                              </div>
                              @foreach($rfqcontract as $contract)
                                <div class="col-12 col-xl-12 mb-3">
                                    <div class="upload-view-file">
                                    <span><img src="{{asset('Admin/assets/dist/images/page.png')}}"></span>
                                    <div class="upload-nda-text">
                                        <h2>{{$contract->contract_name}}</h2>
                                        <p>Size : <b>25 KB</b></p>
                                        <p>Date & Time : <b>{{$contract->created_at}}</b></p>
                                    </div>
                                    <a  class="trash-img contract_remove" data-contract_id="{{$contract->id}}" id="image-delect-contract"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                    </div>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="tab-pane fade" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tab">
                    <div class="d-flex flex-column pb-4">
                      <h2 class="pb-2">3. Add Bid Sheet</h2>
                      <p>Pick an off the shelf bid sheet to get started or download and customise your own bid sheet</p>
                    </div>
                   
                     
                      <div class="row">
                        <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                        <div class="input-wrapper">
                        <b>Bid Sheet - Word & PDF <span class="text-danger">*</span></b>
                          <input type="file" id="upload-img-Sheet" name="bidsheet_file[]" accept=".xls,.pdf" multiple>
                          @error('bidsheet_file')
                              <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                      </div>
                        </div>
                           <div class="clearfix"></div>
                          <div class="row" id="img-preview-Sheet">

                          </div>
                          @foreach($rfqbidsheet as $bidsheet)
                                <div class="col-12 col-xl-12 mb-3">
                                    <div class="upload-view-file">
                                    <span><img src="{{asset('Admin/assets/dist/images/page.png')}}"></span>
                                    <div class="upload-nda-text">
                                        <h2>{{$bidsheet->bidsheet_name}}</h2>
                                        <p>Size : <b>25 KB</b></p>
                                        <p>Date & Time : <b>{{$bidsheet->created_at}}</b></p>
                                    </div>
                                    <a  class="trash-img bidsheet_remove" data-bidsheet_id="{{$bidsheet->id}}" id="image-delect-Sheet"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                    </div>
                                </div>
                            @endforeach 
                        <div class="col-12 col-xl-12">
                          <div class="input-wrapper">
                            <b> Sample Bid Sheet</b>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="nav-conditional" role="tabpanel" aria-labelledby="nav-conditional-tab">
                    <div class="d-flex flex-column pb-4">
                      <h2 class="pb-2">Bid Instruction</h2>
                      <p>Pick an off the shelf bid sheet to get started or download and customise your own bid sheet</p>
                    </div>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="bid-currency">
                          <button class="accordion-button collapsed d-flex gap-3" style="background:#EAEFF0;"
                            type="button" data-bs-toggle="collapse" data-bs-target="#bid-currency-one"
                            aria-expanded="false" aria-controls="bid-currency-one">
                            Bid Currency
                          </button>
                        </h2>
                        <div id="bid-currency-one" class="accordion-collapse collapse" aria-labelledby="bid-currency"
                          data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">
                              <div class="form-group " x-data="{ fileName: '' }">
                                <div class="row">
                                  <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                      <b>RFQ Bid Currency <span class="text-danger">*</span></b>
                                      <select name="rfq_bid_currency"> 
                                          <option>Select</option>
                                          @foreach($countries as $currency)
                                             <option {{$rfqdetail->rfq_bid_currency === $currency->currency.'('.$currency->currency_name.')' ? 'selected' : ''}} value="{{ $currency->currency.'('.$currency->currency_name.')' }}">{{ $currency->currency.'('.$currency->currency_name.')' }}</option>
                                          @endforeach   
                                      </select>
                                      <div id="currency-options" class="list-group"></div> 
                                      @error('rfq_bid_currency')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
                                  </div>
                                    </div>
                                   
                                  <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                      <b>Exchange Rate Refrence <span class="text-danger">*</span> </b>
                                      <input type="date" name="exchange_rate_refrence" value="{{$rfqdetail->exchange_rate_refrence}}" id="exchange_rate_refrence">
                                      @error('exchange_rate_refrence')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                      @enderror
                                    </div>

                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="raw-materials">
                          <button class="accordion-button collapsed" style="background:#EAEFF0;" type="button"
                            data-bs-toggle="collapse" data-bs-target="#raw-materials-two" aria-expanded="false"
                            aria-controls="raw-materials-two">
                            Raw Materials
                          </button>
                        </h2>
                        <div id="raw-materials-two" class="accordion-collapse collapse" aria-labelledby="raw-materials"
                          data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                          @foreach(explode(',', $rfqdetail->raw_materials_name) as $index => $raw_material)
                            <div class="row" id="accordion-body-Materials">
                              <div class="col-4 col-xl-4 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>Raw Materials Name</b>
                                  <input type="text" name="raw_materials_name[]" value="{{$raw_material}}" placeholder="Raw Materials Name">
                                </div>
                              </div>
                              <div class="col-4 col-xl-4 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>Reference Date</b>
                                  @if(isset(explode(',', $rfqdetail->refrence_date)[$index]))
                                  <input type="date" name="refrence_date[]" value="{{ explode(',', $rfqdetail->refrence_date)[$index] }}" placeholder="Sample NDA (2-3)">
                                  @else
                                  <input type="date" name="refrence_date[]" value="" placeholder="Sample NDA (2-3)">
                                  @endif
                                </div>
                              </div>
                              <div class="col-2 col-xl-2 mb-0 mb-xl-3 mt-4">
                                <div class="input-wrapper">
                                    <td>
                                        <button type="button" class="btn btn-danger mt-1 remove-tr2"><i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                 </div>
                              </div>
                            </div>
                            @endforeach

                            <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <a class="btn btn-outline-primary add-icon" id="add-Materials"> + Add Materials</a>
                                  
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="point-contact">
                          <button class="accordion-button collapsed" style="background:#EAEFF0;" type="button"
                            data-bs-toggle="collapse" data-bs-target="#point-contact-three" aria-expanded="false"
                            aria-controls="point-contact-three">
                            Point of Contact
                          </button>
                        </h2>
                        <div id="point-contact-three" class="accordion-collapse collapse"
                          aria-labelledby="point-contact" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            <div class="row">
                              <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>Add Team members <span class="text-danger">*</span></b>
                                  <select name="add_tem_member[]" data-trigger id="add_tem_member" multiple="multiple">
                                    @foreach($members as $key=>$member)
                                        <option {{ in_array($member->id, explode(',', $rfqdetail->add_tem_member)) ? 'selected' : '' }} value="{{$member->id}}">{{$member->firstname}} {{$member->lastname}}</option>
                                    @endforeach 
                                  </select>
                                  <input type="hidden" name="add_tem_member[]" value="{{Auth::User()->id}}" >
                                  @error('add_tem_member')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                      @enderror
                                </div>
                              </div><br><br>
                                <div class="row" id="member-cards-container" style="display: none;"></div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="point-terms">
                          <button class="accordion-button collapsed" style="background:#EAEFF0;" type="button"
                            data-bs-toggle="collapse" data-bs-target="#point-terms-three" aria-expanded="false"
                            aria-controls="point-terms-three">
                            Delivery Terms
                          </button>
                        </h2>
                        <div id="point-terms-three" class="accordion-collapse collapse" aria-labelledby="point-terms"
                          data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            <div class="row">
                              <!-- <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>One Time  <span class="text-danger">*</span> </b>
                                  <input type="date" name="one_time">
                                    @error('one_time')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                      @enderror
                                </div>
                              </div> -->

                              <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>Recurrening - Cycle <span class="text-danger">*</span></b>
                                  <select name="recurrening">
                                      <option value="" >select</option>
                                    <option {{$rfqdetail->recurrening == 'Month' ? 'selected' : ' '}} value="Month" >Month</option>
                                    <option {{$rfqdetail->recurrening == 'Daily' ? 'selected' : ' '}} value="Daily" >Daily</option>
                                    <option {{$rfqdetail->recurrening == 'Every Monday' ? 'selected' : ' '}} value="Every Monday">Every Monday</option>
                                  </select>
                                  @error('recurrening')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                      @enderror
                                </div>
                              </div>

                              <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>Delivery/Packing Standrad <span class="text-danger">*</span></b>
                                   <input type="text" name="delivery" class="input-wrapper"  value="{{$rfqdetail->delivery}}">
                                     @error('delivery')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                      @enderror
                                </div>
                              </div>
                               
                              <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>Import Terms <span class="text-danger">*</span></b>
                                  <input type="text" name="import_terms" value="{{$rfqdetail->import_terms}}">
                                  @error('import_terms')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                      @enderror
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="point-payment">
                          <button class="accordion-button collapsed" style="background:#EAEFF0;" type="button"
                            data-bs-toggle="collapse" data-bs-target="#point-payment-three" aria-expanded="false"
                            aria-controls="point-payment-three">
                            Payment Terms
                          </button>
                        </h2>
                        <div id="point-payment-three" class="accordion-collapse collapse"
                          aria-labelledby="point-payment" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            <div class="row">
                              <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>Days to make Payment After Delivery <span class="text-danger">*</span></b>
                                  <input type="text" name="payment_after_delivery" value="{{$rfqdetail->payment_after_delivery}}">
                                    @error('payment_after_delivery')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                      @enderror
                                </div>
                              </div>
                              <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>Payment Terms<span class="text-danger">*</span></b>
                                  <input type="file" name="payment_after_delivery_file" value="{{$rfqdetail->payment_after_delivery_file}}">
                                    @if ($rfqdetail->payment_after_delivery_file)
                                        <p>Current file: {{ basename($rfqdetail->payment_after_delivery_file) }}</p>
                                    @endif
                                  <small>Upload only pdf file</small>
                                    @error('payment_after_delivery')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                      @enderror
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                   <div class="tab-pane fade" id="nav-bid" role="tabpanel" aria-labelledby="nav-bid-tab">
                        <div class="d-flex flex-column pb-4">
                          <h2 class="pb-2">Conditional Offers & Discount</h2>
                          <p>Pick an off the shelf bid sheet to get started or download and customise your own bid sheet</p>
                        </div>
                            <div class="row ">
                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                  <div class="input-wrapper">
                                    <b>Year on year benefit</b>
                                    <div class="radio-custme">
                                      <div class="radio-custme-in">
                                        <input type="radio" id="test11" {{$rfqdetail->demand_type == '1' ? 'checked' : ' '}} name="demand_type" value="1">
                                        <label for="test11">Yes</label>
                                      </div>
                                      <div class="radio-custme-in">
                                        <input type="radio" id="test22" {{$rfqdetail->demand_type == '0' ? 'checked' : ' '}} name="demand_type" value="0">
                                        <label for="test22">No</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                  <div class="input-wrapper">
                                    <b>Contract duration discount</b>
                                    <div class="radio-custme">
                                      <div class="radio-custme-in">
                                        <input type="radio" id="test3" {{$rfqdetail->year_discount_terms == '1' ? 'checked' : ' '}} name="year_discount_terms" value="1">
                                        <label for="test3">Yes</label>
                                      </div>
                                      <div class="radio-custme-in">
                                        <input type="radio" id="test4" {{$rfqdetail->year_discount_terms == '0' ? 'checked' : ' '}} name="year_discount_terms" value="0">
                                        <label for="test4">No</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                  <div class="input-wrapper">
                                    <b> Payment term</b>
                                    <div class="radio-custme">
                                      <div class="radio-custme-in">
                                        <input type="radio" id="test5" name="contract_duration_terms" value="1" {{$rfqdetail->contract_duration_terms == '1' ? 'checked' : ' '}}>
                                        <label for="test5">Yes</label>
                                      </div>
                                      <div class="radio-custme-in">
                                        <input type="radio" id="test6" name="contract_duration_terms" value="0" {{$rfqdetail->contract_duration_terms == '0' ? 'checked' : ' '}}>
                                        <label for="test6">No</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                             </div>
                    </div>
                  
                  <!-- questionair -->
                    <div class="tab-pane fade" id="nav-questionair" role="tabpanel" aria-labelledby="nav-questionair-tab">
                      <div class="d-flex flex-column pb-4">
                        <h2 class="pb-2">Questionnaire </h2>
                      </div>
                      <div class="row ">
                          <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                            <div class="input-wrapper">
                              <b>Questionnaire form</b>
                              <input type="text" id="questionair-input" name="form_name" value="{{count($questionas) > 0 ? $questionas[0]->form_name : ''}}" placeholder="Form Description" />
                            </div>
                          </div>
                          <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                            <div class="input-wrapper">
                              <b>Form Description</b>
                              <textarea class="Form Description" name="questionair_description" value="{{count($questionas) > 0 ? $questionas[0]->description : ''}}" placeholder="Form Description">{{count($questionas) > 0 ? $questionas[0]->description : ''}}</textarea>
                            </div>
                          </div>
                      </div>
                      @foreach($questionas as $questiona)
                        <div class="row">
                          <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                              <div class="input-wrapper">
                                  <b>Question 1</b>
                                   <a  class="trash-img remove-question" style="float: right; margin-bottom: 10px;cursor: pointer"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                  <input type="text" name="questiona[]" id="questionair-input-1" value="{{$questiona->questiona}}" placeholder="Question" />
                                  <input type="hidden" name="questiona_id[]" id="questionair-i2nput-1" value="{{$questiona->id }}" placeholder="Question" />
                              </div>
                          </div>
                          <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                              <div class="input-wrapper">
                                  <b>Answer Type</b>
                                  <select class="form-select answar-type" name="answer_type[]" aria-label="Default select example">
                                      <option>Answer Type</option>
                                      <option {{$questiona->answer_type == 'single text' ? 'selected' : ' '}} value="single text">Single Text</option>
                                      <option  {{$questiona->answer_type == 'single choice' ? 'selected' : ' '}} value="single choice">Single Choice</option>
                                      <option  {{$questiona->answer_type == 'multiple choice' ? 'selected' : ' '}} value="multiple choice">Multiple Choice</option>
                                      <option  {{$questiona->answer_type == 'drop-down' ? 'selected' : ' '}} value="drop-down">Drop-Down</option>
                                      <option  {{$questiona->answer_type == 'file upload' ? 'selected' : ' '}} value="file upload">File Upload</option>
                                      <option  {{$questiona->answer_type == 'date' ? 'selected' : ' '}} value="date">Date</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-12 col-xl-12 mb-0 mb-xl-3" id="inputFields-1">
                              @if($questiona->answer_type == 'single text')
                                <div class="input-wrapper">
                                    <input type="hidden" name="option_name[{{$questiona->id}}][]" value="{{$questiona->questiona}}" class="option-name" placeholder="Label Name" />
                                </div>
                              @endif    
                              @if($questiona->answer_type == 'single choice'  || $questiona->answer_type == 'multiple choice' || $questiona->answer_type == 'drop-down')
                                @foreach(explode(',', $questiona->option_name) as $index=>$optionname)
                                    <div class="input-wrapper" style="position: relative; display: flex;">
                                        <b>Option Name</b>
                                        <input type="text" name="option_name[{{$questiona->id}}][]" class="option-name" value="{{$optionname}}" placeholder="Option Name" />
                                        @if($index == '0')
                                          <a class="btn btn-info add-option" style="height: 40px; margin-left: 10px; color: black">Add</a>
                                        @else
                                         <a  class="trash-img  remove-option" style="height: 39px; margin-left: 20px;color: #eeeeee;cursor: pointer"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                        @endif
                                        
                                    </div>
                                @endforeach   
                              @endif
                          </div>
                      </div>
                      @endforeach
                      <div id="movepage">
                        
                      </div>
                      <div>
                         <a class="btn btn-info" id="AddQuestion" style="float: right;position: relative;/* margin-bottom: -48px; */top: -19px; color: black">Question Add</a>
                      </div>
                       
                    </div>
                 <!-- questionair end -->
                  
                  <div class="tab-pane fade" id="nav-supplier" role="tabpanel" aria-labelledby="nav-supplier-tab">
                  <div class="d-flex flex-column pb-4">
                      <h2 class="pb-2">Supplier Selection</h2>
                      <p>Add Suppliers From Your Saved Shortlists Or discover New Companies</p>
                    </div>
                    <div class="row ">
                    <h1 class="text-center my-2">How do you want add companies to your RFQ ?</h1>
                       <!-- Search Supplier model button open -->
                       <div class="col-12 col-xl-12 mb-0 mb-xl-6 text-center">
                        <button type="button"  class="btn btn-outline-primary add-icon mt-30"  
                         value="{{ auth()->user()->id }})" style=" width:35% " data-bs-toggle="modal" data-bs-target="#add-brand">
                            Add Supplier Name
                        </button>
                      </div>
                       <h2 class="text-center my-4">Or</h2>
                       <!-- Search Supplier model button close -->
                      <div class="col-12 col-xl-12 mb-0 mb-xl-6 " style="position: relative;left:25%; width:50% ">
                        <div class="input-wrapper">
                            <input type="search" placeholder="Search Supplier" id="searchautocomplete">
                            <div class="searchResults" >
                                
                            </div>
                        </div>
                      </div>
                     
                      <div class="row my-4">
                          <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                            <div class="row supplierCardContainer" id="card-container">
                          </div>
                      </div>
                      <div class="row ">
                        <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                          <div class="row ">
                          @foreach($suppliersData as $supplier)
                                  <div class="col-4 col-xl-4 mb-0 mb-xl-3">
                                      <div class="addded-team add-slip" data-card-id="{{$supplier->id}}">
                                          <a href="#" class="close-icon adddelete-company" data-card-id="{{$supplier->id}}"  data-card_id="{{$supplier->id}}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                                          <span><img src="{{asset('Admin/assets/dist/images/table-iconOne.png')}}" alt="icon" class="w-auto img-fluid"></span>
                                          <div class="addded-iner">
                                              <h2>{{$supplier->company_name}}</h2>
                                              <label class="addded-text">
                                                  <b>Company Profile :-{{$supplier->company_category}}</b>
                                                  <input type="hidden" name="supplier_add[]" value="{{$supplier->id}}">
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                          @endforeach
                        </div>
                        </div>
                      </div>

                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="nav-finalize" role="tabpanel" aria-labelledby="nav-finalize-tab">
                    <div class="d-flex flex-column pb-4">
                      <h2 class="pb-2">Finalize your RFQ</h2>

                    </div>

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="deal-info-one">
                          <button class="accordion-button d-flex gap-3 collapsed" style="background:#EAEFF0;"
                            type="button" data-bs-toggle="collapse" data-bs-target="#deal-info-collapseTwo"
                            aria-expanded="false" aria-controls="deal-info-collapseTwo" fdprocessedid="ev9nth">
                            Dealines
                          </button>
                        </h2>
                        <div id="deal-info-collapseTwo" class="accordion-collapse collapse"
                          aria-labelledby="deal-info-one" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">
                              <div class="row gap-3 gap-xl-0">
                                <div class="col-12 col-xl-6 mt-0 mt-xl-3">
                                  <div class="input-wrapper">
                                    <b>Acknowledgement Deadline <span class="text-danger">*</span></b>
                                    <input type="date" name="acknowledgement_deadline" min="<?php echo date('Y-m-d') ?>" value="{{$rfqdetail->acknowledgement_deadline}}">
                                    @error('acknowledgement_deadline')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-12 col-xl-6 mt-0 mt-xl-3">
                                  <div class="input-wrapper">
                                    <b>Query Deadline <span class="text-danger">*</span></b>
                                    <input type="date" name="query_deadline" min="<?php echo date('Y-m-d') ?>" value="{{$rfqdetail->query_deadline}}">
                                    @error('query_deadline')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-12 col-xl-6 mt-0 mt-xl-3">
                                  <div class="input-wrapper">
                                    <b>Bid Submission Deadline <span class="text-danger">*</span></b>
                                    <input type="date" name="bid_submission_deadline" min="<?php echo date('Y-m-d') ?>" value="{{$rfqdetail->bid_submission_deadline}}">
                                    @error('bid_submission_deadline')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                          </div>

                        </div>
                       
                      </div>

                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
           

        <div class="d-none d-md-flex py-3 border bg-white justify-content-between position-fixed bottom-0 w-100 px-5" style="border-color:#B4B6BD;">
          <div class="col-12 col-md-4 ">
            <button class="btn px-4 text-white" id="formid"  type="submit" name="preview" value="0" style="background: #D39D36;">Save as Draft</button>
          </div>
          <div class="col-12 col-md-8 text-center">
          <button class="btn btn-outline-secondary px-4 me-2" id="prev"><i class="bi bi-chevron-left"></i> Previous</button>
            <button class="btn btn-primary px-4" id="next">Next <i class="bi bi-chevron-right"></i></button>
          <button class="btn btn-success px-4" type="submit"  id="send" name="preview" value="0">preview <i class="bi bi-send"></i></button>
      </form>

            
          </div>
        </div>
      

<!-- Modal Supplier Selection open -->
<div class="modal fade" id="add-brand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="saved-suppliers">
          <h4>Your Saved Suppliers </h4>
           <!-- Suppliers Group -->
           <div class="row">
            <div class="col-12 col-md-5 col-xl-3 mb-3 mb-md-0">
                <div class="border bg-white compnay-tabs-ul" style="border-color:#B4B6BD; margin-top: 22px">
                    <div class="tabs-ac">
                        <!--- <a href="#" class="active">As Buyer</a>
                        <a href="{{route('admin.supplier')}}">As Supplier</a>--->
                    </div>
                    <ul class="d-flex flex-column nav nav-tabs listing" id="nav-tabs" role="tablist">
                        @if($suppliergroups->count()==0)
                        <div class="text-center">
                            <img style="max-width: 250px" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror="img_onError(this)">
                        </div>
                        @endif
                        @foreach($suppliergroups as $key=>$buyer)
                        <li>
                            <a id="nav-buyer-{{$loop->iteration}}-tab" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-buyer-{{$loop->iteration}}" type="button" role="tab" aria-controls="nav-buyer-{{$loop->iteration}}" aria-selected="true" href="#" class="nav-link py-3 px-4 d-block position-relative buyer-group-link data-group-tab-section-{{$buyer->id}}  {{$key == '0' ? 'active' : ' '}} " data-group-id="{{$buyer->id}}">
                                <div class="tab-text">
                                    @php 
                                        $suppli =  explode(',',$buyer->supplier_id);
                                    @endphp
                                    <b class="group-name">{{$buyer->name ?? ''}}</b>
                                    <p>{{count($suppli) ?? 0}} Supplier</p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-7 col-xl-9 ">
                <div class="tabs-buyer">
                </div>
                <div class="border bg-white p-3 px-sm-4 py-sm-4 tab-content" id="nav-tabContent" style="border-color:#B4B6BD;">
                    @foreach($suppliergroups as $buyer)
                    <div class="tab-pane fade" id="nav-buyer-{{$loop->iteration}}" role="tabpanel" aria-labelledby="nav-buyer-{{$loop->iteration}}-tab">
                    </div>
                    @endforeach
                      <div class="tab-pane fade show active" id="nav-product" role="tabpanel" aria-labelledby="nav-product-tab">
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div id="error-messages" class="alert alert-danger" style="display: none;">
                                  <!-- Error messages will be displayed here -->
                              </div>
                          </div>
                          @php
                            $groupWithSuppliers = App\Models\SupplierGroup::where('id',$suppliergroups[0]->id)->first();
                              $suppli = explode(',',$groupWithSuppliers['supplier_id']);
                              $Company = App\Models\Company::whereIn('id', $suppli)->paginate(3); 
                          @endphp
                          <div class="d-flex flex-column pb-4">
                              <h2 class="pb-2">{{$groupWithSuppliers ? $groupWithSuppliers->name : ' '}}</h2>
                              <p>{{count($suppli) ?? 0}}  Companies</p>
                              </div>
                              <div class="accordion accordion-flush" id="accordionFlushExample">
                              <form id="companyForm" enctype="multipart/form-data" method="POST">
                                 @csrf
                                  <div class="row gap-3 gap-xl-0 ">
                                  <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                      <div class="saved-com">
                                      <h3>{{count($suppli) ?? 0}} Saved Companies</h3>
                                      <div class="saved-com-r">
                                          <div class="saved-com-serach">
                                          <img src="{{asset('Admin/assets/dist/images/search-icon.svg')}}" style=" width: 20px;">
                                          <input type="text" placeholder="Search this list" />
                                          </div>
                                      </div>
                                      </div>
                                  </div>
                                  @foreach($Company as $data)
                                  <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                      <div class="addded-team add-slip">
                                      <input type="checkbox" value="{{$data->id}}" id="companySelect" name="checkout[]" data-name="{{$data->company_name}}" data-id="{{$data->id}}" data-category-id="{{$data->company_category}}" data-profile="{{$data->company_category}}">
                                      <span><img src="{{ asset('Admin/assets/dist/images/table-iconOne.png') }}" alt="icon" class="w-auto img-fluid"></span>
                                      <div class="addded-iner">
                                      <h2>{{$data->company_name}}</h2>
                                      <label class="addded-text">
                                          <b>Distributor</b>
                                          <b><em><img src="{{ asset('Admin/assets/dist/images/television-icon.svg') }}" style=" width: 20px;"> Detroit, MI 53226 </em><em><img src="{{ asset('Admin/assets/dist/images/user-icon.svg')}}" style=" width: 20px;"> 150 - 200</em><em><img src="{{ asset('Admin/assets/dist/images/report-icon.svg')}}" style=" width: 20px;"> 24</em></b>
                                      </label>
                                      </div>
                                      </div>
                                  </div>
                                  @endforeach
                                  </div>
                                  <div class="col-12" style=" text-align: end;">
                                      <input type="button" id="addCompanyButton" value="Add" class="btn btn-success " data-bs-dismiss="modal" >
                                      <!-- <input type="button" value="cancel" class="btn btn-danger"  class="btn btn-default" data-bs-dismiss="modal"> -->
                                  </div>
                              </form>
                              </div>
                    </div>
                </div>
            </div>
          </div>
          <!-- Suppliers Group -->
        </div>
      </div>
      
    </div>
  </div>
</div>

<!-- Modal Supplier Selection close -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" ></script> 
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js" ></script>
<script src="{{asset('Admin/assets/dist/js/Rfq.js')}}"></script>
<script>
$(document).ready(function() {
   $(document).on('change','#category', function() {
        var category =  $("#category").val();
        var url ="{{Route('admin.SelectSubCategory')}}";
          $.ajax({
              url: url, 
              method:"GET",
              data:{'category':category},
              success: function(result){
                  $("#subcategory").html(result);
              }
          });
     })

    
    
  $(document).on('click','#coverimg', function() {
      var coverimg_id =  $(this).data('cover_id');
      var url ="{{Route('admin.SelectCoverImg')}}";
        $.ajax({
            url: url, 
            method:"GET",
            data:{'coverimg_id':coverimg_id},
            success: function(result){
              console.log(result);
              // var html =result;
              // var div = document.createElement("div");
              // div.innerHTML = html;
              // var text = div.textContent || div.innerText || "";
              // console.log(text)
              $(".note-editable").html(result);
            }
        });
   })
    

//when the Add Field button is clicked
   var country_id = 2;
  $("#add-location").click(function(e) {
    $(".delete-location").fadeIn("1500");
    //Append a new row of code to the "#items" div
   $("#accordion-body-location").append(`<tr class="locationboard remove-location" id="accordion-body-location-remo-${country_id}">
              <td class="locationboard" >
                  <div class="input-wrapper">
                      <select id="country" class="country_${country_id}" name="country_id[]" data-country_id="${country_id}" >
                        <option >Select</option>
                        @foreach($countries as $key=>$country)
                          <option value="{{$country->id}}" >{{$country->name}}</option>
                        @endforeach
                      </select>
                    </div>
              </td>
              <td class="locationboard" >
                    <div class="input-wrapper">
                      <select id="state_${country_id}" name="state_id[]" data-state_id="${country_id}" >
                          <option selected>Select</option> 
                      </select>
                    </div>
                </td>
              <td class="locationboard" >
                    <div class="input-wrapper">
                      <select id="city_${country_id}" name="city_id[]">
                          <option selected>Select</option> 
                      </select>
                    </div> 
                </td>
              <td class="locationboard" >
                    <div class="input-wrapper">
                      <input type="number" name="zipcode[]" placeholder="">
                      <input type="hidden" name="rfqlocation_id[]" value="0" placeholder="" >
                    </div>
                </td>
              <td class="locationboard">
                   <a href="#" style="position: relative;" class="close-icon  delete-location btn btn-danger text-dark" data-member-id="-${country_id}"><img src="https://updateproject.com/supplyme/public/Admin/assets/dist/images/trash-icon1.svg" style="width: 20px;height: 20px;"></a>
              </td>
          </tr>`
    );
    country_id++;
  });
   $("body").on("click", ".delete-location", function (e) {
      // Find the parent element of the clicked "Delete" button
      var locationToRemove = $(this).closest(".remove-location");
      
      // Remove the corresponding location element
      locationToRemove.remove();
      country_id --;
  });

  })



  $(document).on('change','#country', function() {
      var country_id = $(this).data('country_id');
      console.log('country_id',country_id);
    $(document).on('change','.country_'+country_id, function() {
        var country =  $(".country_"+country_id).val();
        var url ="{{Route('auth.SearchState')}}";
          $.ajax({
              url: url, 
              method:"GET",
              data:{'country':country},
              success: function(result){
                  console.log(result);
                  $("#state_"+country_id).html(result);
              }
          });

          $(document).on('change','#state_'+country_id, function() {
            var state_id = $(this).data('state_id');
            var state =  $("#state_"+state_id).val();
            console.log('state_id',state_id);
            console.log('state',state);
            var url ="{{Route('auth.SearchCity')}}";
              $.ajax({
                  url: url, 
                  method:"GET",
                  data:{'state':state},
                  success: function(result){
                      $("#city_"+state_id).html(result);
                  }
              });
        })
    })
  })

</script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
    $('.editControls').summernote({
        placeholder: 'enter value',
        tabsize: 2,
        height: 120,
        toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

</script>
<script>
  $('.cover_letter').summernote({
        tabsize: 2,
        height: 120,
        toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>
<script>
$(document).ready(function() {
  $('#add_tem_member').on('change', function() {
    $('#member-cards-container').empty();
    $('#add_tem_member option:selected').each(function() {
      var memberId = $(this).val();
      var memberName = $(this).text();
      var memberPosition = ''; // Replace this with the actual position value of the member
      var memberRoles = ''; // Replace this with the actual roles value of the member
      var cardHtml = `
        <div class="col-6 col-xl-6 mb-0 mb-xl-3 teamMemb">
          <div class="addded-team">
            <span><img src="{{asset('Admin/assets/dist/images/user-img.jpg')}}"></span>
            <div class="addded-iner">
              <h2>${memberName}</h2>
              <label class="addded-text">
                <b>Position - <em>${memberPosition}</em></b>
                <b>Roles <em>${memberRoles}</em></b>
              </label>
            </div>
          </div>
        </div>`;
      $('#member-cards-container').append(cardHtml);
    });
    $('#member-cards-container').show();

    // Add Team members delete open
    $("body").on("click", ".deleteTeamMemb", function(e) {
      e.preventDefault();
      var memberIdToRemove = $(this).data("member-id");
      var memberNameToRemove = $(this).data("member-name");

      // Find the Choices.js instance and remove the item by value
      var choicesInstance = new Choices('#add_tem_member');
      choicesInstance.removeItemsByValue([memberIdToRemove]);

      // Remove the card
      $(this).closest(".teamMemb").remove();
    });
    // Add Team members delete close
  });
});
</script>
<script>

$(document).ready(function() {
  var addedCompanies = [];
    $(document).on('click', '.company-add-card', function(event) {
        event.preventDefault();
        var companyName = $(this).data('name');
        var companyProfile = $(this).data('profile');  
        var companyId = $(this).data('id');
        if (!addedCompanies.includes(companyName)) {
        var cardHtml = `
            <div class="col-4 col-xl-4 mb-0 mb-xl-3">
                <div class="addded-team add-slip">
                    <a href="#" class="close-icon delete-company"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                    <span><img src="{{asset('Admin/assets/dist/images/table-iconOne.png')}}" alt="icon" class="w-auto img-fluid"></span>
                    <div class="addded-iner">
                        <h2>${companyName}</h2>
                        <label class="addded-text">
                            <b>Company Profile :- <em>${companyProfile}</em></b>
                            <input type="hidden" name="supplier_add[]" value="${companyId}">
                        </label>
                    </div>
                </div>
            </div>`;
        
        $('#card-container').append(cardHtml);

           // Add the company name to the addedCompanies array
            addedCompanies.push(companyName);
            $(".searchResults").html(' ');
        }
    });
    
    $("body").on("click", ".delete-company", function(e) {
        $(this).closest(".col-4").remove();
    });
});

$(document).on('keyup','#searchautocomplete', function() {
        var searchautocomplete =  $("#searchautocomplete").val();
        
        var url ="{{Route('admin.SelectCompanys')}}";
          $.ajax({
              url: url, 
              method:"GET",
              data:{'searchautocomplete':searchautocomplete},
              success: function(result){
                $(".searchResults").html(result);
                console.log('result',result)
              }
          });
     })
</script>


<!-- autocomplete open -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  
function getCurrency(currency) {
  var autoCompleteResult = currency;
  document.getElementById("currency-options").innerHTML = "";
  for (var i = 0, limit = 5, len = autoCompleteResult.length; i < len  && i < limit; i++) {
    document.getElementById("currency-options").innerHTML += "<a class='list-group-item list-group-item-action' href='#' onclick='setSearch(\"" + autoCompleteResult[i] + "\")'>" + autoCompleteResult[i] + "</a>";
  }
}

function setSearch(currency) {
  document.getElementById('bidautocomplete-input').value = currency;
  document.getElementById("currency-options").innerHTML = "";
}

jQuery.noConflict();
jQuery(function($) {
  $('#bidautocomplete-input').autocomplete({
          source: function(request, response) {
          console.log('Autocomplete triggered');
            $.ajax({
                url: "{{route('autocomplete.bidcurrency')}}",
                method: 'GET',
                data: {
                    currency: request.term 
                },

                success: function(data) {
                      console.log(data);
                  if (data.length === 0) {
                        // response(["currency not available"]);
                    } else {
                      console.log("data->",data);
                      getCurrency(data) 
                    }
                }
            });
        },
    }).on('keyup', function (event) {
        var inputVal = $(this).val();        
        if (inputVal === '') {
          document.getElementById("currency-options").innerHTML = "";
        }
}); 
});
</script>
<!--============================ autocomplete close ==================-->


<!--============= supplier popup open =======================================-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize an array to keep track of added companies
    var addedCompanies = [];

    $('#addCompanyButton').on('click', function() {
        // Find all checkboxes with class 'companySelect' that are checked
        $('#companySelect:checked').each(function() {
            var AddcompanyName = $(this).data('name');
            var comCatg = $(this).data('category-id');
            var AddcompanyProfile = $(this).data('profile');
            var AddcompanyId = $(this).data('id');
            
            // Check if the company name is not already in the addedCompanies array
            if (!addedCompanies.includes(AddcompanyName)) {
                var cardHtml = `
                    <div class="col-4 col-xl-4 mb-0 mb-xl-3">
                        <div class="addded-team add-slip" data-card-id="${AddcompanyId}">
                            <a href="#" class="close-icon adddelete-company" data-card-id="${AddcompanyId}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                            <span><img src="{{asset('Admin/assets/dist/images/table-iconOne.png')}}" alt="icon" class="w-auto img-fluid"></span>
                            <div class="addded-iner">
                                <h2>${AddcompanyName}</h2>
                                <label class="addded-text">
                                    <b>Company Profile :-${AddcompanyProfile}</b>
                                    <input type="hidden" name="supplier_add[]" value="${AddcompanyId}">
                                </label>
                            </div>
                        </div>
                    </div>`;
                
                $('.supplierCardContainer').append(cardHtml);
                
                // Add the company name to the addedCompanies array
                addedCompanies.push(AddcompanyName);
            }
            
            // Uncheck the corresponding checkbox
            $(this).prop('checked', false);
        });
    });

    $("body").on("click", ".adddelete-company", function(e) {
        e.preventDefault();
        var $card = $(this).closest(".addded-team");
        var cardId = $card.data('card-id');

        // Remove the company name from the addedCompanies array
        addedCompanies = addedCompanies.filter(name => name !== AddcompanyName);

        // Remove the card based on the card ID
        $card.remove();
    });
});
</script>

<script>

$(document).on('click','.buyer-group-link', function() {
      var tabId = $(this).data('bs-target');
      var group_id = $(this).data('group-id');
 
    var url ="{{Route('admin.rfqSupplerGroup')}}";
      $.ajax({
          url: url, 
          method:"GET",
          data:{'group_id':group_id},
          success: function(response) {
            console.log(response);
              $('#accordionFlushExample').remove();
              $(tabId).html(response.html);
          },
          error: function(xhr, status, error) {
              console.error('AJAX request failed:', error);
          }
      });
  })
</script>

<!--============= supplier popup close =======================================-->

<!-- product and services open -->


<script>
    $(document).ready(function() {
        $('input[name="rfq_type"]').on('click', function() {
            var selectedValue = $(this).val();
            console.log('Selected Value: ' + selectedValue);
            $.ajax({
                url: '{{ route('product.and.service') }}', 
                type: 'GET',
                data: { rfq_type: selectedValue },
                success: function(response) {
                    console.log('Response Data:', response.data);
                    var selectElement = $('#category');
                    selectElement.empty(); 
                    selectElement.append($('<option>', {
                        value: '',
                        text: 'Category'
                    }));
                    response.data.forEach(function(category) {
                        selectElement.append($('<option>', {
                            value: category.id,
                            text: category.name
                        }));
                    });
                }
            });
        });
    });
</script>


  
<script>
  $(document).ready(function() {
    // Add a click event handler to the button
    $("#next").click(function() {
      // Perform your desired action here
     

      // If you want to prevent the form submission, you can return false
      return false;
    });

    $("#prev").click(function() {
      // Perform your desired action here
      // If you want to prevent the form submission, you can return false
      return false;
    });
  });


  $(document).ready(function() {
      $("#rfq_name").on("input", function() {
          checkForm();
      });
      $("#category, #subcategory").on("change", function() {
          checkForm();
      });
      $("#country_1, #state_1, #city_1").on("change", function() {
          checkForm();  
      });
      $(".note-codable").on("keyup", function() {
            notecodable();  
      });
      $("#upload-img-Sheet").on("click", function() {
          sheet();  
      });

      $("#exchange_rate_refrence").on("input", function() {
           bidins();  
      });

      function checkForm() {
          var rfq_name = $("#rfq_name").val();
          var category = $("#category").val();
          var subcategory = $("#subcategory").val();
          var country_1 = $(".country_1").val();
          var state_1 = $("#state_1").val();
          var city_1 = $("#city_1").val();



          if (rfq_name && category && subcategory && country_1 && state_1 && city_1) {
              $(".rfq-details").css('background-color', '#9ce19c');
          } else {
              $(".rfq-details").css('background-color', '#eb5c5c'); 
          }

          

      }
      function notecodable() {

          var note_codable = $(".note-editable").text();
          console.log(note_codable);
            if (note_codable) {
                $(".letter").css('background-color', '#9ce19c');
            } 
            else {
                $(".letter").css('background-color', '#eb5c5c'); 
            }
      }


      function sheet() {
        $(".sheet").css('background-color', '#9ce19c');
      }
      function bidins() {
          var note_codable = $("#exchange_rate_refrence").val();
          if(note_codable){
            $(".instruction").css('background-color', '#9ce19c');
          }
          else {
              $(".instruction").css('background-color', '#eb5c5c'); 
          }
      }
      function sheet() {
        $(".sheet").css('background-color', '#9ce19c');
      }
         
      checkForm();
      
  });
  
</script>
<script>
     $(document).on('click', '.remove-tr2', function(){  
    console.log('sigle remove');
    $(this).parents('#accordion-body-Materials').remove();
});
</script>

<script>
$(document).ready(function() {
    var country_id = 2;

    // Event delegation for adding questions
    $("body").on("click", "#AddQuestion", function(e) {
        $("#movepage").append(`
            <div class="row">
                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                    <div class="input-wrapper">
                        <b>Question</b>
                        <button class="btn btn-danger remove-question" style="float: right; margin-bottom: 10px;">Remove</button>
                        <input type="text" name="questiona[]" id="questionair-input-${country_id}" placeholder="Question" />
                        <input type="hidden" name="questiona_id[]" id="questionair-i2nput-${country_id}" value="0" placeholder="Question" />
                    </div>
                </div>
                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                    <div class="input-wrapper">
                        <b>Answer Type</b>
                        <select class="form-select answar-type" name="answer_type[]" aria-label="Default select example">
                                <option>Answer Type</option>
                                <option value="single text">Single Text</option>
                                <option value="single choice">Single Choice</option>
                                <option value="multiple choice">Multiple Choice</option>
                                <option value="drop-down">Drop-Down</option>
                                <option value="file upload">File Upload</option>
                                <option value="date">Date</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-xl-12 mb-0 mb-xl-3" id="inputFields-${country_id}">
                </div>
            </div>
        `);
        country_id++;
    });

    // Event delegation for removing questions
    $("body").on("click", ".remove-question", function (e) {
        $(this).closest(".row").remove();
        country_id--;
    });

    // Event delegation for handling answer type change
    $("body").on("change", ".answar-type", function () {
        showInputFields(this);
    });

    function showInputFields(selectElement) {
        const answerType = $(selectElement).val();
        const inputFields = $(selectElement).closest(".row").find(`[id^='inputFields-']`);
        inputFields.html(''); // Clear the input fields

        if (answerType === "single text" || answerType === "file upload" || answerType === "date") {
            inputFields.html(`<div class="input-wrapper">
                <input type="hidden" name="option_name[${country_id}][]" value="${answerType}" class="option-name" placeholder="Label Name" />
            </div>`);
        } else if (answerType === "single choice" || answerType === "multiple choice" || answerType === "drop-down") {
            inputFields.html(`<div class="input-wrapper " style=" position: relative;display: flex;">
                <b>Option Name</b>
                    <input type="text" name="option_name[${country_id}][]" class="option-name" placeholder="Option Name" />
                    <a class="btn btn-info add-option" style="height: 40px;margin-left: 10px; color: black">Add</a>
            </div>`);
        }
    }

    // Event delegation for adding options
    $("body").on("click", ".add-option", function () {
        const inputFields = $(this).closest(".row").find(`[id^='inputFields-']`);
        addOption(inputFields);
    });

    function addOption(inputFields) {
        const optionWrapper = document.createElement("div");
        optionWrapper.classList.add("input-wrapper");
        console.log(optionWrapper);
        optionWrapper.innerHTML = `
            <div class="input-wrapper " style=" position: relative; display: flex;">
                <b>Option Name</b>
                    <input type="text" name="option_name[${country_id}][]" class="option-name" placeholder="Option Name" />
                    <a class="btn btn-danger remove-option" style=" height: 39px; margin-left: 20px;color: #eeeeee">Remove</a>
            </div>`;
        inputFields.append(optionWrapper);
    }

    // Event delegation for removing options
    $("body").on("click", ".remove-option", function () {
        $(this).closest(".input-wrapper").remove();
    });
});


// NDA REmove
$(document).on('click','.remove_nda', function() {
      var nda_id =  $(this).data('nda_id');
      console.log(nda_id,nda_id);
      var url ="{{Route('nda.nda_remove.delete')}}";
        $.ajax({
            url: url, 
            method:"GET",
            data:{'nda_id':nda_id},
            success: function(result){
                location.reload();
              console.log(result);
            }
        });
   })
   
   
   $(document).on('click','.contract_remove', function() {
      var contract_id =  $(this).data('contract_id');
      console.log(contract_id,contract_id);
      var url ="{{Route('nda.contractRmove.delete')}}";
        $.ajax({
            url: url, 
            method:"GET",
            data:{'contract_id':contract_id},
            success: function(result){
                location.reload();
              console.log(result);
            }
        });
   })
   
   
   $(document).on('click','.bidsheet_remove', function() {
      var bidsheet_id =  $(this).data('bidsheet_id');
      console.log(bidsheet_id,bidsheet_id);
      var url ="{{Route('nda.bidsheet_remove.delete')}}";
        $.ajax({
            url: url, 
            method:"GET",
            data:{'bidsheet_id':bidsheet_id},
            success: function(result){
                location.reload();
              console.log(result);
            }
        });
   })
   
   
     $(document).on('click','.location_remove', function() {
      var location_id =  $(this).data('location_id');
      console.log(location_id,location_id);
      var url ="{{Route('nda.location_remove.delete')}}";
        $.ajax({
            url: url, 
            method:"GET",
            data:{'location_id':location_id},
            success: function(result){
                location.reload();
              console.log(result);
            }
        });
   })
   
//   $(document).on('click','.adddelete-company', function() {
//       var card_id =  $(this).data('card_id');
//       console.log(card_id,card_id);
//       var url ="{{Route('nda.adddelete_company.delete')}}";
//         $.ajax({
//             url: url, 
//             method:"GET",
//             data:{'card_id':card_id},
//             success: function(result){
//                 location.reload();
//               console.log(result);
//             }
//         });
//   })
</script>
<script>
  // Function to hide the loader
  function hideLoader() {
    document.getElementById('loader').style.display = 'none';
  }

  // Event listener to hide the loader when the page has fully loaded
  window.addEventListener('load', function() {
    hideLoader();
  });
</script>


@endsection
