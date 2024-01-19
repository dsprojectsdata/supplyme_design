@extends('Auth.layout')
@section('content')
<style>
    label#document-3-error {
    color: red;
}
</style>
    <div class="login claim-list">
      <div class="login-page">
        <div class="login-logo"><a href=""><img src="{{asset('Admin/assets/dist/images/login-logo.png')}}"></a></div>
        <h3>Company Documents Upload</h3>   
        @if ($message = Session::get('error'))
          <div class="alert alert-danger alert-top-border alert-dismissible fade show my-4" role="alert">
              <i class="mdi mdi-check-all me-3 align-middle text-danger"></i><strong>Error</strong> - {{$message}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <p>Join the Supply Me network, the leading on-demand manufacturing platform which connects the customer with suppliers to provide professional services and profitable work along every step in the supply chain.</p>
        <form action="{{Route('auth.company_document_add')}}" enctype="multipart/form-data" method="POST" id="supply-me-form">
           @csrf
           <div class="row">
          @foreach($document_manager as $document)  
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="input-wrapper">
                  <b>{{$document->document_name}}</b>
                  @if($document->document_required == 'Required')
                     <span style="color: red;">*</span>
                  @endif   
                      <input type="file" name="document[]" id="document-{{$document->id}}" data-id="{{$document->id}}" accept="{{$document->document_type}}" {{ $document->document_required == 'Required' ? 'required' : '' }}>
                     <input type="hidden" value="{{$document->document_name}}" name="document_name[]" >
                </div>
            </div>
           @endforeach 
           <input type="hidden" value="{{$company_id}}" name="company_id" >
           <input type="hidden" value="{{$user_id}}" name="user_id" >
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="input-wrapper search-input">
              <button class="btn btn-primary w100">Upload</button>
            </div>
          </div>
           </div>
        </form>
      </div>
    </div>

    @endsection