@extends('Auth.layout')
@section('content')
  <div class="login claim-payment">
    <div class="login-page">
      <div class="login-logo"><a href=""><img src="{{asset('Admin/assets/dist/images/login-logo.png')}}"></a></div>
      <h3>Payment Details<span>ABC Pty Ltd</span></h3>
      <form>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="biling-cycle">
                      <h3>Billing Cycle</h3>
                      <label><input type="radio" /> Monthly</label>
                      <label><input type="radio" /> Annually</label>
                      <span>Save 33%</span>
                      <p>Monthly payments of $75 - 12 Month Subscription</p>
                  </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="input-wrapper">
                  <b>Billing Address 1</b>
                  <input type="text" placeholder="Billing Address" />
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="input-wrapper">
                  <b>Billing Address 2 (Optical)</b>
                  <input type="text" placeholder="Billing Address" />
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="input-wrapper">
                  <b>City</b>
                  <input type="text" placeholder="Enter City" />
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="input-wrapper">
                  <b>Country</b>
                  <select>
                    <option>Select Country</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="input-wrapper">
                  <b>State/Province</b>
                  <select>
                    <option>Select State/Province</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="input-wrapper">
                  <b>Zip Code</b>
                  <input type="text" placeholder="Enter Zip Code" />
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="input-wrapper">
                  <b>Zip Code</b>
                  <input type="text" placeholder="Enter Zip Code" />
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="input-wrapper mt-25">
                  <button class="btn btn-green w100">Apply</button>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="input-wrapper">
                  <button class="btn btn-primary w100">Complete Payment</button>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <span class="signup-text text-center mt-0">By Completing payment, I agree to the <a href="">Terms of Service</a></span>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="payment-right">
              <h4><b>Supply Me Registered</b> - Supplier Tier Badge</h4>
              <ul>
                <li>
                  <b><img src="{{asset('Admin/assets/dist/images/check.svg')}}" /> Improve your positionning in category search results.</b>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface 
                </li>
                <li>
                  <b><img src="{{asset('Admin/assets/dist/images/check.svg')}}" /> Display a Supply Me Badge on your company</b>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface 
                </li>
                <li>
                  <b><img src="{{asset('Admin/assets/dist/images/check.svg')}}" /> Conduct business directly on the platform</b>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface 
                </li>
                <li>
                  <b><img src="{{asset('Admin/assets/dist/images/check.svg')}}" /> Protect your fiancial processes</b>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface 
                </li>
                <li>
                  <b><img src="{{asset('Admin/assets/dist/images/check.svg')}}" /> Improve your positionning in category search results.</b>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface 
                </li>
                <li>
                  <b><img src="{{asset('Admin/assets/dist/images/check.svg')}}" /> Display a Supply Me Badge on your company</b>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface 
                </li>
              </ul>
              <div class="payment-show">
                <h5>Supply Me Registered
                  <span>Monthly Plan</span>
                </h5>
                <p>$75.00 <span>/Month</span></p>
              </div>
              <div class="payment-show">
                <h5>Total</h5>
                <p>$75.00</p>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!--  Javascript file  link here -->
@endsection