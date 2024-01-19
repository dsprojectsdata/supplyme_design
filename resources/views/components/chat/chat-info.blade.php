<?php
$profileImg7 = '';
if($group->partner_id == auth()->user()->company_id) {
    $partner =  $group->partner1;
} else {
    $partner = $group->partner;
}
$displayName = $partner->company_name;
if (is_null($partner->companyprofile)) {
    $profileImg7 = asset('Admin/assets/dist/images/table-iconOne.png');
} else {
    $profileImg7 = url()->asset($partner->companyprofile->Organisational_image);
}
 
if (!file_exists($profileImg7)) {
    $profileImg7 = asset('Admin/assets/dist/images/table-iconOne.png');
}
?>

<style>
    
    .dropdown-members{
        padding: 8px;
        max-height: 400px;
        overflow-y: auto;
    }
    
    .dropdown-members p{
        padding: 8px 0;
    }
    
    .dropdown-members img{
        width: 30px;
        border-radius: 50%;
    }
    
    .chat-view-circle span img{
        border-radius: 50%;
    }
    
</style>
<div class="chat-view-top">
    <div class="chat-view-top-l" id="group-display-name">
    <h2>
        <img src="{{ $profileImg7 }}" alt="icon">
        @php
            
        @endphp
        {{ $displayName }}
    </h2>
    </div>
    <div class="chat-view-top-r">
    <p>Collaborators</p>
    <div class="chat-view-circle" id="chat-collaborators">
        @php $userCount = 0; @endphp
        @forelse($group->users as $user)
            @if($userCount <3 )
                <span><img src="{{asset($user->img_path ?? 'Admin/assets/dist/images/profile.png')}}"></span>
            @else
                @php break; @endphp
            @endif
            @php $userCount++; @endphp
        @empty
        @endforelse
        <!-- <span><img src="assets/dist/images/profile.png"></span>
        <span><img src="assets/dist/images/profile.png"></span>
        <span><img src="assets/dist/images/profile.png"></span> -->
    </div>
    @if($group->users->count() > 3)
        <a href="javascript::void(0)" id="dropdownMenuButton" data-bs-toggle="dropdown">+ {{$group->users->count()-3}} More</a>
        @php $remainingUsers = $group->users->slice(2); @endphp
        <div class="dropdown-menu dropdown-members" aria-labelledby="dropdownMenuButton">
            @foreach ($remainingUsers as $remainingUser)
                <p><img src="{{asset($remainingUser->img_path ?? 'Admin/assets/dist/images/profile.png')}}" style="margin-right: 4px"> {{$remainingUser->firstname . ' ' . $remainingUser->lastname??''}}</p>
            @endforeach
        </div>
    @endif
    </div>
</div>