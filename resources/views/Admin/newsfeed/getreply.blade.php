<style>
    .comments-comment-social-bar__vertical-divider {
    height: 16px;
    border-left: 1px solid black;
}
</style>
@foreach($replys as $key=>$reply)
@php
     $user = App\Models\user::where('id',$reply)->first();

     $Jobrole = App\Models\Jobrole::where('id',$user->Jobrole_id)->first();
     $user_id = Auth::user()->id;
     $Authuser = App\Models\user::where('id',$user_id)->first();

  @endphp
<div class="row comments-list" style=" position: relative; right: -91px; top: 26px;">
    <div class="col-sm-1 my-2">
        <img class="img-fluid img-responsive rounded-circle mr-2"  src="{{asset($user->img_path)}}" onerror="this.src='https://cdn-icons-png.flaticon.com/512/149/149071.png'"  alt="User 2">
    </div>
    <div class="col-sm-11" style=" background-color: #f2f2f2;">
        <div class="my-2 col-sm-6">
            <h3><strong>{{$user->firstname}} {{$user->lastname}}</strong> </h3>
            <p>{{$Jobrole == null ? ' '  : $Jobrole->role_name }}</p>
            <h6>{{$reply_text[$key]}} </h6>    
        </div>
        <div class ="col-sm-2">
            <p>{{ $comments->created_at->diffForHumans(null, true) }}</p>
        </div>
    </div>
</div>
<br>
@endforeach
