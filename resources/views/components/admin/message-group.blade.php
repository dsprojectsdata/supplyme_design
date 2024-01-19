<style>
    .chat-small .d-flex.flex-row{
        width: 100%;
    }
    
    .chat-list-l .list-unstyled a .img-list img{
        margin: 0;
    }
    
    .chat-small .d-flex.flex-row .group-name{
        width: 100%;
    }
</style>

@forelse($chatGroups as $group)
<?php
    $profileImg7 = '';
    if($group->partner_id == auth()->user()->company_id && !$toOthers) {
        $partner =  $group->partner1;
    } else {
        $partner = $group->partner;
    }
    $displayName = $partner->company_name ?? "";
    if (is_null($partner->companyprofile ?? "")) {
        $profileImg7 = asset('Admin/assets/dist/images/table-iconOne.png');
    } else {
        $profileImg7 = url()->asset($partner->companyprofile->Organisational_image ?? "");
    }
    
    if (!file_exists($profileImg7)) {
        $profileImg7 = asset('Admin/assets/dist/images/table-iconOne.png');
    }
?>
<li class="border-bottom" id="{{$group->identifier}}" data-id="{{$group->id}}" onclick="loadGroup(`{{$group->id}}`)">
    <a href="#!" class="d-flex justify-content-between">
        <div class="d-flex flex-row">
            <div class="img-list">
                <img src="{{ $profileImg7 }}" alt="avatar">
            </div>
            <div class="pt-1 group-name">
                @if(is_null($group->rfq_id))
                    <p class="fw-bold mb-0">{{ $displayName }}</p>
                @else
                    <p class="fw-bold mb-0"> {{ $displayName }} <span class="bid-btn">Bid Accepted</span></p>
                @endif
            </div>
        </div>
    </a>
</li>
@empty
@endforelse