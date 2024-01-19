<div class="accordion accordion-flush" id="accordionFlushExample">
    <form action="{{ route('admin.save.supplier.team',['id' => $supply->id]) }}" method="POST">
        @csrf
        <input type="hidden" value="{{$supply->id}}" id="supply_group_id" />
        <div class="row gap-3 gap-xl-0 ">
            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                <div class="input-wrapper">
                    <div class="team-edit-text">
                        <b>Requested Company</b>
                        <div class="team-view-pro">
                            <p><span></span> {{$supply->company->company_name??''}}</p>
                            <a href="{{route('company.profile.show',['id'=>$supply->company->id])}}" target="_blank">View Company Profile</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                <div class="input-wrapper">
                    <div class="team-edit-text">
                        <b>Group Name</b>
                        <p>{{$supply->name??''}}</p>
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

            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                <div class="input-wrapper click-relative">
                    <div class="team-edit-text">
                        <b>Assign Team Member <em>Lorem Ipsum is simply dummy text of the printing and</em></b>
                        <div class="input-wrapper click-relative">
                            <input placeholder="Enter Member Name" type="text" class="team-click-one" id="edit-team-member-search" />
                            <div class="team-select team-select-po show-list" id="edit-team-member-results" style="display: none;">
                            </div>
                            <div class="team-select team-select-two team-edit edit-selected-team-members">
                                <h3><span id="team-member-count">{{$supply->supplierTeamMembers->count()??0}}</span> Members Selected</h3>
                                @foreach($supply->supplierTeamMembers as $member)
                                <div class="team-select-one team_member-selected" id="team-member-{{$member->id}}">
                                    <span></span>
                                    <p>{{$member->firstname ?? ''}} {{$member->lastname??''}}</p>
                                    <div class="team-btn-two">
                                        <a onclick="removeMember(event, '{{$member->id}}')" href="#" class="team-btn-red"><svg width="800px" height="800px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                                                <path fill="#000000" d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z"></path>
                                            </svg> Remove</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <!-- <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                <div class="input-wrapper click-relative">
                    <div class="team-edit-text">
                        <b>Buyer Team Member <em>Lorem Ipsum is simply dummy text of the printing and</em></b>
                        <div class="team-select team-select-two team-edit">
                            @foreach($buyer_team_member as $member)
                            <div class="team-select-one">
                                <span></span>
                                <p>{{$member->teamMembers->firstname ?? ''}} {{$member->teamMembers->lastname??''}} <b>({{$member->teamMembers->companyName->company_name??''}})</b></p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div> -->
            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                <div class="input-wrapper click-relative">
                    <div class="team-edit-text">
                        <b>Exit Supplier Networ Group</b>
                        <p>Lorem Ipsum is simply dummy text of the printing and <br>
                            <a href="{{route('admin.supplier.exit',['id'=>$supply->id])}}" onclick="return confirm('Are you sure you want to exit this group?')" class="btn btn btn-primary">Exit Group</a>
                            <button type="submit" class="btn btn btn-primary supplier-save-button" disabled>Save</button>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </form>

</div>