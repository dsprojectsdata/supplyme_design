@extends('Admin.layout.app')
@section('admincontent')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" />
<link href="{{asset('SuperAdmin/assets/libs/choices.js/public/assets/styles/choices.min.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('SuperAdmin/assets/js/pages/form-advanced.init.js')}}"></script>
<script src="{{asset('SuperAdmin/assets/libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>
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
  .input-wrapper {
      margin: 10px 0;
  }
</style>
        <div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">
          <!-- Welcome -->
          <div class="d-block flex-wrap gap-3 welcomeBox">
            <div class="title pb-4 d-flex flex-column w-100 gap-2">
              <h2 class=" position-relative"> New Request For Quote</h2>
               
              <div class="d-md-flex justify-content-between">
                <p class="pb-2">Complete all necessary steps to launch your new RFQ.</p>
                <span class="badge border border-success text-success " style="background: #19875414;">Avg.completion
                  time ~ 15mins</span>
              </div>
            </div>
       <form action="{{Route('RFQ.store')}}" id="rfqdata" enctype="multipart/form-data" method="POST">    
          @csrf
            <div class="row">
              <div class="col-12 col-md-5 col-xl-3 mb-3 mb-md-0">
                <div class="border bg-white compnay-tabs-ul" style="border-color:#B4B6BD;">
                  <ul class="d-flex flex-column nav nav-tabs listing nav-RFQ" id="nav-tabs" role="tablist">
                    <li class="rfq-details"><a id="nav-product-tab" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-product"
                        type="button" role="tab" aria-controls="nav-product" aria-selected="true" href="#"
                        class=" nav-link active py-3 px-4 d-block position-relative sh"><span
                          class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">1</span>Product
                        Detailes (RFQ Details)</a></li>
                    <li class="letter2"><a id="nav-contract-tab" data-bs-toggle="tab" data-bs-toggle="tab"
                        data-bs-target="#nav-contract" type="button" role="tab" aria-controls="nav-contract"
                        aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative sh"><span
                          class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">2</span>Cover letter</a></li>
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
                    <li class="conditionaloffers"><a id="nav-bid-tab" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-bid"
                        type="button" role="tab" aria-controls="nav-bid" aria-selected="false" href="#"
                        class="nav-link py-3 px-4 d-block position-relative sh"><span
                          class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">5</span>Conditional
                        Offers</a></li>
                    <li class="navquestionairtab"><a id="nav-questionair-tab" data-bs-toggle="tab" data-bs-toggle="tab"
                        data-bs-target="#nav-questionair" type="button" role="tab" aria-controls="nav-questionair"
                        aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative sh"><span
                          class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">6</span>Questionnaire</a>
                    </li>
                    <li class="navsuppliertab"><a id="nav-supplier-tab" data-bs-toggle="tab" data-bs-toggle="tab"
                        data-bs-target="#nav-supplier" type="button" role="tab" aria-controls="nav-supplier"
                        aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative sh"><span
                          class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3 ">7</span>Supplier
                        Selection</a></li>

                    <li class="navfinalizetab"><a id="nav-finalize-tab"  data-bs-toggle="tab" data-bs-toggle="tab"
                        data-bs-target="#nav-finalize" type="button" role="tab" aria-controls="nav-finalize"
                        aria-selected="false" href="#" class="nav-link py-3 px-4 d-block position-relative Finalize"><span
                          class="d-inline-flex justify-content-center align-items-center rounded-circle text-center me-3">8</span>Finalize</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-12 col-md-7 col-xl-9 ">
                <div class="border bg-white p-3 px-sm-4 py-sm-4 tab-content" id="nav-tabContent" style="border-color:#B4B6BD;">
                    <!--product-->
                  <div class="tab-pane fade show active" id="nav-product" role="tabpanel"
                    aria-labelledby="nav-home-tab">
                    <div class="d-flex flex-column pb-3">
                      <h2 class="pb-2">1. RFQ Details   </h2>
                      <p>A short description about the Product Details required.</p>
                    </div>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="flush-headingOne">
                          <button class="accordion-button  d-flex gap-3 rfq-type" style="background:#EAEFF0;"type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne"> About RFQ</button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show"aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">
                              <div class="row gap-3 gap-xl-0 ">
                              <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                  <div class="input-wrapper">
                                    <b>RFQ Type - Product / Services <span class="text-danger">*</span> </b>
                                    <div class="radio-custme">
                                      <div class="radio-custme-in">
                                        <input type="radio" id="product" name="rfq_type" value="product" > 
                                        <label for="product">Product </label>
                                      </div>
                                      <div class="radio-custme-in">
                                        <input type="radio" id="services" value="services" name="rfq_type" >
                                        <label for="services">Services</label>
                                      </div>
                                    </div>
                                    @error('rfq_type')
                                      <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                  <div class="input-wrapper">
                                    <b>RFQ Name <span class="text-danger">*</span></b>
                                     <input type="text" id="rfq_name" name="rfq_name" placeholder="RFQ Name" >
                                  </div>
                                  @error('rfq_name')
                                      <div class="alert alert-danger mt-1">{{ $message }}</div>
                                  @enderror
                                </div>
                                <div class="col-12 col-xl-6 mb-0 mb-xl-3">
                                  <div class="input-wrapper">
                                    <b>Category <span class="text-danger">*</span></b>
                                    <select id="category" name="category_id" >
                                        <option value="">Category</option>
                                        @foreach($category as $key=>$cat)
                                           <option value="{{$cat->id}}" data-cat_id="">{{$cat->name}}</option>
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
                                    <select id="subcategory" name="subcategory_id" >
                                      <option value=" ">Sub-Category</option>
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
                                        <input type="radio" id="test1" name="demandtype" value="One Time" >
                                        <label for="test1">One Time</label>
                                      </div>
                                      <div class="radio-custme-in">
                                        <input type="radio" id="test2" value="Recurring" name="demandtype">
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
                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="headingTwo">
                          <button class="accordion-button collapsed" style="background:#EAEFF0;" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseTwo12" aria-expanded="false"
                            aria-controls="collapseTwo12">
                            Location
                          </button>
                        </h2>
                        <div id="collapseTwo12" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
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
                                              </div>
                                          </td>
                                        <td class="locationboard" >
                                            <a style="position: relative; top: 11px;" class="btn btn-outline-primary add-icon" id="add-location"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                  </tbody>
                                </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                   <!--contract-->
                  <div class="tab-pane fade" id="nav-contract" role="tabpanel" aria-labelledby="nav-contract-tab">
                    <div class="d-flex flex-column pb-3">
                      <h2 class="pb-2">2. Cover Letter <span class="text-danger">*</span></h2>
                      <p>A short description about the Product Details required.</p>
                    </div>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="flush-headingOne">
                          <button class="accordion-button  d-flex gap-3" style="background:#EAEFF0;"type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Cover Letter
                          </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show"
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
                                         <textarea placeholder="Write Comment" class="cover_letter" cols="30" rows="10"  name="cover_letter" id="cover_letter"></textarea>
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
                                          <figcaption class="text-center py-3" style="font-size:16px; font-weight:600; color:#000;">{{$coverletter->title}} </figcaption>
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
                            data-bs-toggle="collapse" data-bs-target="#collapseTwo45" hjkjharia-expanded="false"
                            aria-controls="collapseTwo45">
                            NDA (Optional)
                          </button>
                        </h2>
                        <div id="collapseTwo45" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                          data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            <div class="row">
                              <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>NDA File - Word & PDF</b>
                                    <input type="file"   id="upload-img-nda" name="nda_file"  accept=".pdf,.doc,.docx">
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
                              <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                <div class="row gap-3 gap-md-0">
                                  @foreach($ndas as $key=>$nda)
                                  <div class="col-sm-12 nda-cont">
                                    {{$key+1}} . <a href="{{asset($nda->nda_file_name)}}" download><i class="fa fa-download" aria-hidden="true"></i>{{$nda->nda_file_title}}</a>
                                  </div>
                                  @endforeach
                                </div>
                              </div>
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
                              <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                                <div class="row gap-3 gap-md-0">
                                  @foreach($contracts as $key=>$contract)
                                    <div class="col-sm-12">
                                        {{$key+1}}. <a href="{{asset($contract->contract_img)}}" download><i class="fa fa-download" aria-hidden="true"></i>{{$contract->file_name}} </a>
                                    </div>
                                  @endforeach
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                    <!--add-->
                  <div class="tab-pane fade" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tab">
                    <div class="d-flex flex-column pb-4">
                      <h2 class="pb-2">3. Add Bid Sheet</h2>
                      <p>Pick an off the shelf bid sheet to get started or download and customise your own bid sheet</p>
                    </div>
                      <div class="row">
                        <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                        <div class="input-wrapper">
                        <b>Bid Sheet - Excel <span class="text-danger">*</span></b>
                          <!-- <input type="file" id="upload-img-Sheet" name="bidsheet_file[]" accept=".xls" multiple> -->
                          <input type="file"  id="upload-img-Sheet" name="bidsheet_file[]" accept=".xls, .xlsx" multiple >
                          @error('bidsheet_file')
                              <div class="alert alert-danger mt-1">{{ $message }}</div>
                          @enderror
                      </div>
                        </div>
                           <div class="clearfix"></div>
                          <div class="row" id="img-preview-Sheet">

                          </div>
                        <div class="col-12 col-xl-12">
                          <div class="input-wrapper">
                            <b> Sample Bid Sheet</b>
                          </div>
                        </div>
                        <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                          <div class="row gap-3 gap-md-0">
                          @foreach($bidsheets as $bidsheet)  
                            <div class="col-12 col-md-6 col-lg-3">
                              <figure><iframe src="{{asset($bidsheet->bidsheet_img)}}" class="img-fluid mx-auto w-100" alt="page"></iframe></figure>
                              <figcaption class="text-center py-3" style="font-size:16px; font-weight:600; color:#000;">{{$bidsheet->name}} <a href="{{asset($bidsheet->bidsheet_img)}}" download><i class="fa fa-download" aria-hidden="true"></i></a></figcaption>
                            </div>
                          @endforeach  
                          </div>
                       
                        </div>
                      </div>
                  </div>
                  <!--conditional-->
                  <div class="tab-pane fade" id="nav-conditional" role="tabpanel" aria-labelledby="nav-conditional-tab">
                    <div class="d-flex flex-column pb-4">
                      <h2 class="pb-2">Bid Instruction</h2>
                      <!--- <p>Pick an off the shelf bid sheet to get started or download and customise your own bid sheet</p> --->
                    </div>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="bid-currency">
                          <button class="accordion-button  d-flex gap-3" style="background:#EAEFF0;" type="button" data-bs-toggle="collapse" data-bs-target="#bid-currency-one"  aria-expanded="false" aria-controls="bid-currency-one">
                            Bid Currency
                          </button>
                        </h2>
                        <div id="bid-currency-one" class="accordion-collapse collapse show" aria-labelledby="bid-currency"
                          data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">
                              <div class="form-group " x-data="{ fileName: '' }">
                                <div class="row">
                                  <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                      <b>RFQ Bid Currency <span class="text-danger">*</span></b>
                                        <select name="rfq_bid_currency" value="" require>
                                          <option >Select</option>
                                          @foreach($countries as $key=>$country)
                                           <option value="{{$country->currency}}({{$country->name}})" >{{$country->currency}}({{$country->name}})</option>
                                          @endforeach
                                        </select>
                                  </div>
                                    </div>
                                  <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                    <div class="input-wrapper">
                                      <b>Exchange Rate Refrence <span class="text-danger">*</span> </b>
                                      <input type="date" name="exchange_rate_refrence" id="exchange_rate_refrence">
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
                            <div class="row" id="accordion-body-Materials">
                              <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>Raw Materials Name <span class="text-danger">*</span></b>
                                  <input type="text" name="raw_materials_name[]" placeholder="Raw Materials Name">
                                  @error('raw_materials_name')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                      @enderror
                                </div>
                              </div>
                              <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>Refrence Date <span class="text-danger">*</span></b>
                                  <input type="date" name="refrence_date[]" placeholder="Sample NDA (2-3)">
                                  @error('refrence_date')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                      @enderror
                                </div>
                              </div>
                            </div>
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
                                  <b>Add Team members  <span class="text-danger">*</span></b>
                                  <select name="add_tem_member[]" class="form-select" data-trigger id="add_tem_member" multiple="multiple">
                                    @foreach($members as $member)
                                      <option value="{{$member->id}}" >{{$member->firstname}} {{$member->lastname}}</option>
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
                            Terms
                          </button>
                        </h2>
                        <div id="point-terms-three" class="accordion-collapse collapse" aria-labelledby="point-terms"
                          data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            <div class="row">
                              <div class="col-6 col-xl-6 mb-0 mb-xl-3" id="recurr">
                                <div class="input-wrapper">
                                  <b>Recurrening - Cycle </b>
                                  <select name="recurrening">
                                   <option value="" >select</option>
                                  <option value="Month" >Month</option>
                                    <option  value="Daily" >Daily</option>
                                    <option  value="Every Monday">Every Monday</option>
                                  </select>
                                  @error('recurrening')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                      @enderror
                                </div>
                              </div>


                              <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>Delivery/Packing Standard </b>
                                  <input type="text" name="delivery" class="input-wrapper" >
                                  @error('delivery')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                  @enderror
                                </div>
                              </div>
                              <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>Import Terms </b>
                                  <input type="text" name="import_terms">
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
                                  <b>Days to make Payment After Delivery </b>
                                  <input type="text" name="payment_after_delivery">
                                    @error('payment_after_delivery')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                      @enderror
                                </div>
                              </div>
                              <div class="col-6 col-xl-6 mb-0 mb-xl-3">
                                <div class="input-wrapper">
                                  <b>Payment Terms<span class="text-danger">*</span></b>
                                  <input type="file" name="payment_after_delivery_file">
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
                  <!--bid-->
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
                                        <input type="radio" id="test11" name="demand_type" value="1">
                                        <label for="test11">Yes</label>
                                      </div>
                                      <div class="radio-custme-in">
                                        <input type="radio" id="test22" name="demand_type" value="0">
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
                                        <input type="radio" id="test3" name="year_discount_terms" value="1">
                                        <label for="test3">Yes</label>
                                      </div>
                                      <div class="radio-custme-in">
                                        <input type="radio" id="test4" name="year_discount_terms" value="0">
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
                                        <input type="radio" id="test5" name="contract_duration_terms" value="1">
                                        <label for="test5">Yes</label>
                                      </div>
                                      <div class="radio-custme-in">
                                        <input type="radio" id="test6" name="contract_duration_terms" value="0">
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
                              <input type="text" id="questionair-input" name="form_name" placeholder="Form Description" />
                            </div>
                          </div>
                          <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                            <div class="input-wrapper">
                              <b>Form Description</b>
                              <textarea class="Form Description" name="questionair_description" placeholder="Form Description"></textarea>
                            </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                              <div class="input-wrapper">
                                  <b>Question 1</b>
                                  <input type="text" name="questiona[]" id="questionair-input-1" placeholder="Question" />
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
                          <div class="col-12 col-xl-12 mb-0 mb-xl-3" id="inputFields-1">
                                
                          </div>
                      </div>
                      <div id="movepage">
                        
                      </div>
                      <div>
                         <a class="btn btn-info" id="AddQuestion" style="float: right;position: relative;/* margin-bottom: -48px; */top: -19px; color: black">Question Add</a>
                      </div>
                       
                    </div>
                    <!--supplier-->
                  <div class="tab-pane fade" id="nav-supplier" role="tabpanel" aria-labelledby="nav-supplier-tab">
                  <div class="d-flex flex-column pb-4">
                      <h2 class="pb-2">Supplier Selection <span class="text-danger">*</span></h2>
                      <p>Add Suppliers From Your Saved Shortlists Or discover New Companies</p>
                    </div>
                    <div class="row ">
                    <h1 class="text-center my-2">How do you want add companies to your RFQ ?</h1>
                       <!-- Search Supplier model button open -->
                       <div class="col-12 col-xl-12 mb-0 mb-xl-6 text-center">
                        <button type="button"  class="btn btn-outline-primary add-icon mt-30  select_model" data-first_index_id ="{{count($suppliergroups) > 0 ? $suppliergroups[0]->id : ''}}" value="{{ auth()->user()->id }})" style=" width:35% " data-bs-toggle="modal" data-bs-target="#add-brand"  >
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
                      </div>
                    </div>
                  </div>
                  <!--finalize-->
                  <div class="tab-pane fade" id="nav-finalize" role="tabpanel" aria-labelledby="nav-finalize-tab">
                    <div class="d-flex flex-column pb-4">
                      <h2 class="pb-2">Finalize your RFQ</h2>
                    </div>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                      <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="deal-info-one">
                          <button class="accordion-button d-flex gap-3 " style="background:#EAEFF0;" type="button" data-bs-toggle="collapse" data-bs-target="#deal-info-collapseTwo" aria-expanded="false" aria-controls="deal-info-collapseTwo" fdprocessedid="ev9nth">
                            Dealines
                          </button>
                        </h2>
                        <div id="deal-info-collapseTwo" class="accordion-collapse collapse show"
                          aria-labelledby="deal-info-one" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">
                           
                              <div class="row gap-3 gap-xl-0">
                                <div class="col-12 col-xl-6 mt-0 mt-xl-3">
                                  <div class="input-wrapper">
                                    <b>Acknowledgement Deadline </b>
                                    <input type="date" name="acknowledgement_deadline" id="acknowledgement-deadline-input" min="<?php echo date('Y-m-d') ?>">
                                        @error('acknowledgement_deadline')
                                          <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                  </div>
                                </div>
                                <div class="col-12 col-xl-6 mt-0 mt-xl-3">
                                  <div class="input-wrapper">
                                    <b>Query Deadline </b>
                                    <input type="date" name="query_deadline" min="<?php echo date('Y-m-d') ?>">
                                        @error('query_deadline')
                                          <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                  </div>
                                </div>
                                <div class="col-12 col-xl-6 mt-0 mt-xl-3">
                                  <div class="input-wrapper">
                                    <b>Bid Submission Deadline <span class="text-danger">*</span></b>
                                    <input type="date" name="bid_submission_deadline" min="<?php echo date('Y-m-d') ?>" >
                                        @error('bid_submission_deadline')
                                          <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                  </div>
                                </div>
                              </div>

                          </div>

                        </div>
                       
                      </div>

                      <!-- <div class="accordion-item border mb-3">
                        <h2 class="accordion-header" id="adi-info-one">
                          <button class="accordion-button d-flex gap-3 collapsed" style="background:#EAEFF0;"
                            type="button" data-bs-toggle="collapse" data-bs-target="#adi-info-collapseTwo"
                            aria-expanded="false" aria-controls="adi-info-collapseTwo" fdprocessedid="ev9nth">
                            Additional Information
                          </button>
                        </h2>
                        <div id="adi-info-collapseTwo" class="accordion-collapse collapse"
                          aria-labelledby="adi-info-one" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">
                           
                              <div class="row gap-3 gap-xl-0">
                                <div class="col-12 col-xl-6 mt-0 mt-xl-3">
                                  <div class="input-wrapper">
                                    <b>Upload File <span class="text-danger">*</span></b>
                                    <div class="form-group" x-data="{ fileName: '' }">
                                      <div class="input-group">
                                        <input type="file" x-ref="file" @change="fileName = $refs.file.files[0].name" name="additional_file[]" multiple class="d-none" id="upload-img-additional" accept=".doc,.docx">
                                        <input type="text" class="form-control form-control-lg" placeholder="Your Files" name="additional_file[]" multiple id="upload-img-additional"  x-model="fileName">
                                        <button class="browse btn btn-primary px-4" type="button" x-on:click.prevent="$refs.file.click()">Browse</button>
                                      </div>
                                    </div>
                                   
                                  </div>
                                  @error('additional_file')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror 
                                </div>
                                <div class="col-12 col-xl-12 mt-0 mt-xl-3">
                                    <div class="row" id="img-preview-additional">
                                    </div>
                                </div>
                                <div class="col-12 col-xl-12 mt-0 mt-xl-3">
                                  <div class="input-wrapper">
                                    <b>Additional Information</b>
                                    <textarea name="additional_information"></textarea>
                                  </div>
                                
                                </div>
                              </div>

                          </div>

                        </div>
                       
                      </div> -->

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
<div class="modal fade like-list2" id="add-brand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="saved-suppliers">
          <h4>Your Saved Suppliers </h4>
           <button type="button" class="close like-close" data-dismiss="modal" aria-label="Close">X</button>
          <!-- Suppliers Group -->
            <div class="row">
                <div class="col-12 col-md-5 col-xl-3 mb-3 mb-md-0">
                    <div class="border bg-white compnay-tabs-ul" style="border-color:#B4B6BD; margin-top: 22px">
                        <div class="tabs-ac">
                            <!-- Group Links Here -->
                        </div>
                        <ul class="d-flex flex-column nav nav-tabs listing" id="nav-tabs" role="tablist">
                            @if($suppliergroups->count() == 0)
                                <div class="text-center">
                                    <img style="max-width: 250px" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror="img_onError(this)">
                                </div>
                            @endif
                            @foreach($suppliergroups as $key => $buyer)
                                <li>
                                    <a id="nav-buyer-{{$loop->iteration}}-tab" href="#" class="nav-link py-3 px-4 d-block position-relative buyer-group-link {{$key == '0' ? 'active' : ' '}} " data-group-tab-section="accordion-flush-{{$buyer->id}}  " >
                                        <div class="tab-text">
                                            <b class="group-name">{{$buyer->name ?? ''}}</b>
                                            <p>{{count(explode(',', $buyer->supplier_id)) ?? 0}} Supplier</p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-7 col-xl-9">
                    <div class="tabs-buyer">
                        @foreach($suppliergroups as $key => $groupWithSupplier)
                            @php
                                $suppli = explode(',', $groupWithSupplier['supplier_id']);
                                $Company = App\Models\Company::whereIn('id', $suppli)->get();
                            @endphp
                            <div class="accordion accordion-flush accordion-content" id="accordion-flush-{{$groupWithSupplier->id}}">
                                   <div class="d-flex flex-column pb-4">
                                        <h2 class="pb-2">{{$groupWithSupplier ? $groupWithSupplier->name : ' '}}</h2>
                                            <p>{{count($suppli) ?? 0}}  Companies</p>
                                    </div>
                                <div class="row gap-3 gap-xl-0 " style="height: 300px; overflow-x: auto;">
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
                                    @php
                                       $user = \Auth::User();
                                       $companyprofile = App\Models\Companyprofilebrandlogo::where('company_id',$data->id)->first();
                                    @endphp
                                        @if(($user ? $user->company_id : '0') != $data->id )
                                        <div class="col-12 col-xl-12 mb-0 mb-xl-3 company-list">
                                            <div class="addded-team add-slip">
                                                <input type="checkbox" value="{{$data->id}}" id="companySelect" name="checkout[]" data-name="{{$data->company_name}}" data-id="{{$data->id}}" data-category-id="{{$data->company_category}}" data-profile="{{$data->company_category}}" data-city="{{$data->City ? $data->City->name : ' '}}" data-state="{{$data->State ? $data->State->name : ' '}}" data-image="{{$companyprofile ? $companyprofile->company_logo : ''}}">
                                                <span>
                                                    
                                                    @if($companyprofile) 
                                                    <img src="{{asset('storage/company-logo/',$companyprofile->company_logo)}}" alt="icon" class="w-auto img-fluid">
                                                    @else
                                                    <img src="{{asset('Admin/assets/dist/images/sun.png')}}" alt="icon" class="w-auto img-fluid">
                                                    @endif
                                                </span>
                                                <div class="addded-iner">
                                                    <a href="{{ route('company.profile.show', ['id' => $data->id]) }}"> <h2>{{$data->company_name}}</h2></a>
                                                    <label class="addded-text">
                                                        <b>City: {{$data->City ? $data->City->name : ' '}}  , State: {{$data->State ? $data->State->name : ' '}}</b>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-12" style="text-align: end;">
                            <input type="button" id="addCompanyButton" value="Add" class="btn btn-success" data-bs-dismiss="modal">
                            <!-- <input type button value="cancel" class="btn btn-danger"  class="btn btn-default" data-bs-dismiss="modal"> -->
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
    $(document).ready(function () {
        $(".like-close").click(function () {
            $(".like-list2").modal("hide");
        });
    });
</script>
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

  
$(".delete-location").hide();
//when the Add Field button is clicked
   var country_id = 2;

  $("#add-location").click(function(e) {
      $(".delete-location").fadeIn("1500");
      var location_id = "accordion-body-location-" + country_id;
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
                      <input type="text" name="zipcode[]" placeholder="">
                    </div>
                </td>
              <td class="locationboard">
                   <a href="#" style="position: relative;top: 12px;" class="close-icon  delete-location btn btn-danger text-dark" data-member-id="-${country_id}"><img src="https://updateproject.com/supplyme/public/Admin/assets/dist/images/trash-icon1.svg" style="width: 20px;height: 20px;"></a>
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
    //   var memberImage =  $(this).data('image'); 
      var memberRoles = ' '; 
      var defaultImage = "{{asset('Admin/assets/dist/images/user-img.jpg')}}";
      
      var cardHtml = `
        <div class="col-6 col-xl-6 mb-0 mb-xl-3 teamMemb">
          <div class="addded-team">
            <span><img src="{{asset('Admin/assets/dist/images/user-img.jpg')}}"></span>
            <div class="addded-iner">
              <h2>${memberName}</h2>
              <label class="addded-text">
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
        var companyId = $(this).data('id');
            
            // Check if a card for this company is already displayed
            var existingCard = $('.removesame[data-removesame="' + companyId + '"]');
            
            if (existingCard.length) {
                existingCard.remove();
                addedCompanies = addedCompanies.filter(company => company.id !== companyId);
            }
        var companyName = $(this).data('name');
        var companyProfile = $(this).data('profile');  
        var url = "{{ url('admin/company-profile-show/') }}/"+companyId;
        if (!addedCompanies.includes(companyName)) {
        var cardHtml = `
            <div class="col-4 col-xl-4 mb-0 mb-xl-3 removesame "  data-removesame ="${companyId}">
                <div class="addded-team add-slip" data-card-id="${companyId}">
                    <a href="#" class="close-icon delete-company"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                    <span><img src="{{asset('Admin/assets/dist/images/table-iconOne.png')}}" alt="icon" class="w-auto img-fluid"></span>
                    <div class="addded-iner">
                    <a href="${url}"> <h2>${companyName}</h2></a>
                        <label class="addded-text">
                            <b>Company Profile :- <em>${companyProfile}</em></b>
                            <input type="hidden" name="supplier_add[]" class="search_company_id" value="${companyId}">
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
          }
      });
  })
</script>


<!-- autocomplete open -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  
function getCurrency(currency,currency_name) {
  var autoCompleteResult = currency;
  document.getElementById("currency-options").innerHTML = "";
  for (var i = 0, limit = 5, len = autoCompleteResult.length; i < len  && i < limit; i++) {
    document.getElementById("currency-options").innerHTML += "<a class='list-group-item list-group-item-action' href='#' onclick='setSearch(\"" + autoCompleteResult[i] + "("+currency_name+")\")'>" + autoCompleteResult[i]+ " ("+currency_name+")</a>";
  }
}

function setSearch(currency,currency_name) {
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
                      console.log('0',data[0]);
                      console.log('1',data[1]);
                  if (data.length === 0) {
                        // response(["currency not available"]);
                    } else {
                      getCurrency(data[0],data[1]) 
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
    $('.accordion-content').hide();
    var first_index_id = $('.select_model').data('first_index_id');
    console.log('first_index_id',first_index_id);
    $('#accordion-flush-'+ first_index_id).show();
    $('.buyer-group-link').click(function(e) {
        e.preventDefault();
        

        $('.buyer-group-link').removeClass('active');
        $(this).addClass('active');

        var target = $(this).data('group-tab-section');
       
         
        $('.accordion-content').hide();

        $('#' + target).show();
        
    });

    
});
</script>
<script>
$(document).ready(function() {
    var addedCompanies = [];
    $('#addCompanyButton').on('click', function() {
        $('#companySelect:checked').each(function() {
            var AddcompanyId = $(this).data('id');
            
            console.log('AddcompanyId',AddcompanyId);
            var existingCard = $('.removesame[data-removesame="' + AddcompanyId + '"]');
            
            if (existingCard.length) {
                existingCard.remove();
                addedCompanies = addedCompanies.filter(company => company.id !== AddcompanyId);
            }

            var AddcompanyName = $(this).data('name');
            var comCatg = $(this).data('category-id');
            var city = $(this).data('city');
            var state = $(this).data('state');
            var image = $(this).data('image');
             var defaultImage = "{{asset('Admin/assets/dist/images/sun.png')}}";
            var imaheurl = image  ? "{{ asset('storage/company-logo/','."+image+"') }}" : defaultImage;
            
            var AddcompanyProfile = $(this).data('profile');
            url = "{{ url('admin/company-profile-show/') }}/" + AddcompanyId;

            if (!addedCompanies.some(company => company.name === AddcompanyName)) {
                var cardHtml = `
                    <div class="col-4 col-xl-4 mb-0 mb-xl-3 removesame" data-removesame ="${AddcompanyId}">
                        <div class="addded-team add-slip" data-card-id="${AddcompanyId}">
                            <a href="#" class="close-icon adddelete-company" data-card-id="${AddcompanyId}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                            <span><img src="${imaheurl}" alt="icon" class="w-auto img-fluid"></span>
                            <div class="addded-iner">
                                <a href="${url}"><h2>${AddcompanyName}</h2></a>
                                <label class="addded-text">
                                    <b>City: ${city}  , State: ${state}</b>
                                    <input type="hidden" name="supplier_add[]"  value="${AddcompanyId}">
                                </label>
                            </div>
                        </div>
                    </div>`;

                $('#card-container').append(cardHtml);

                addedCompanies.push({
                    name: AddcompanyName,
                    catg: comCatg,
                    profile: AddcompanyProfile,
                    id: AddcompanyId,
                });
            }

            // Uncheck the corresponding checkbox
            $(this).prop('checked', false);
        });
    });

    $("body").on("click", ".adddelete-company", function(e) {
        e.preventDefault();
        $(this).closest(".col-4").remove();
    });
});
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
                        console.log('category');
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
</script>
<script>
   $("body").on("click", "#test2", function (e) {
       var maleRadio = document.getElementById('test2');
       var test1 = document.getElementById('test1');
       var MaleSelected = maleRadio.checked;
       var test1Selected = test1.checked;
       $('#recurr').show();

    });
    $("body").on("click", "#test1", function (e) {
       var test1 = document.getElementById('test1');
       var maleRadio = document.getElementById('test2');
       var test1Selected = test1.checked;
       var MaleSelected = maleRadio.checked;
       if(test1Selected == true){
           $('#recurr').hide();
       }
    });
</script>
</body>
</html>

    </script>

<style>
  .input-wrapper input[type="text"] {
    width: 100% !important;
  }
  .bootstrap-tagsinput {
    width: 80%; 
    padding: 0;
    margin: 0;
  }
</style>




@endsection