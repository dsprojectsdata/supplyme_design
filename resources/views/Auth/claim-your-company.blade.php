@extends('Auth.layout')
@section('content')
<style>
  .searchResults {
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
</style>
  <div class="login">
    <div class="login-page table_hidden">
      <div class="login-logo"><a href=""><img src="{{asset('Admin/assets/dist/images/login-logo.png')}}"></a></div>
      <h3>Claim Your Company</h3>
      <p>Find and manage your company on Supply me</p>
      <form>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-md-12 col-xs-12">
            <div class="input-wrapper search-input">
              <em><img src="{{asset('Admin/assets/dist/images/search-icon.svg')}}"></em>
               <input type="text" id="searchautocomplete" placeholder="Your company name" >
               <div class="searchResults" style="position: absolute; top: 100%; width: 100%; overflow: auto !important ;">

               </div>
              
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-md-12 col-xs-12">
            <span class="signup-text text-center mt-0">Can't find your company? <a href="{{Route('auth.list_your_company')}}"> List For
                Free</a></span>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" ></script>
<script>
 $(document).on('keyup','#searchautocomplete', function() {
        var searchautocomplete =  $("#searchautocomplete").val();
        var url ="{{Route('auth.company_search')}}";

          $.ajax({
              url: url, 
              method:"GET",
              data:{'searchautocomplete':searchautocomplete},
              success: function(result){
                  console.log(result);
                  $(".searchResults").html(result);
              }
          });
     })
</script>
@endsection