<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="row gap-3 gap-xl-0 ">
        <div class="col-12 col-xl-12 mb-0 mb-xl-3">
            <div id="error-messages" class="alert alert-danger" style="display: none;">
                <!-- Error messages will be displayed here -->
            </div>
            <div class="input-wrapper">
                <div class="team-edit-text">
                    <b>Requested Company</b>
                    <div class="team-view-pro">
                        <p><span></span> {{$supply->company->company_name??''}}</p>
                        <!--<a href="">View Company Profile</a>-->
                        <a href="{{route('company.profile.show',['id'=>$supply->company->id])}}" target="_blank">View Company Profile</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-12 mb-0 mb-xl-3">
            <div class="input-wrapper">
                <div class="team-edit-text">
                    <b>Group Name</b>
                    <p>{{ucfirst($supply->name??'')}}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-12 mb-0 mb-xl-3">
            <div class="input-wrapper">
                <div class="team-edit-text">
                    <b>Description <em>Lorem Ipsum is simply dummy text of the printing and</em></b>
                    <p>{{$supply->description??''}}</p>
                </div>
            </div>
        </div>
        <form id="accept-supplier-form" method="POST" action="{{ route('admin.save.supplier.team',['id'=>$supply->id??'']) }}">
            @csrf
            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                <div class="input-wrapper click-relative">
                    <div class="team-edit-text">
                        <b>Assign Team Member <em>Lorem Ipsum is simply dummy text of the printing and</em></b>
                        <div class="input-wrapper click-relative">
                            <input placeholder="Enter Member Name" type="text" class="team-click-one" id="team-member-search" />
                            <div class="team-select team-select-po show-list" id="team-member-results">
                            </div>
                            <div class="team-select team-select-po show-list" id="selected-team-members">
                                <h3><span id="team-member-count">0</span> Members Selected </h3>
                                <div class="team-select-one no-team-member-section">
                                    <p>Plese Select Team Members</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-12 col-xl-12 mb-0 mb-xl-3 tx-right">
            <a id="accept-submit-form" href="" class="btn btn btn-primary">Accept</a>
            <a href="{{ route('admin.group.supplier.reject', ['id' => $supply->id ?? '']) }}" class="btn btn btn-outline-secondary" onclick="return confirm('Are you sure you want to reject this group?')">Reject</a>
        </div>

    </div>
</div>