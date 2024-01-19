<div class="accordion accordion-flush" id="accordionFlushExample">
    <form action="{{ route('admin.group.buyer.update',['id' => $buyer->id]) }}" method="POST">
        @csrf
        <input type="hidden" value="{{$buyer->id}}" id="buyer_group_id" />
        <div class="row gap-3 gap-xl-0 ">
            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                <div class="input-wrapper">
                    <div class="team-edit-text" id="groupNameSection">
                        <b>Group Name</b>
                        <p id="group-name">{{$buyer->name??''}}</p>
                        <a href="javascript:void(0);" class="btn-edit-team" onclick="toggleEditMode('#groupNameSection','#inputGroupNameSection')">
                            <img id="editIcon" src="{{asset('Admin/assets/dist/images/edit-svg.svg')}}"> Edit
                        </a>
                    </div>
                    <div class="team-edit-text" id="inputGroupNameSection" style="display: none;">
                        <b>Group Name</b>
                        <div class="d-flex align-items-center">
                            <div class="input-group flex-grow-1">
                                <input class="form-control" type="text" id="groupNameInput" value="{{$buyer->name ?? ''}}" readonly>
                                <div class="input-group-append p-1">
                                    <span class="input-group-text bg-white border-0 gap-1">
                                        <i class="fas fa-check text-success" id="saveNameGroup" style="cursor: pointer;"></i>
                                        <i class="fas fa-times text-danger ml-2" id="cancelNameGroup" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                <div class="input-wrapper">
                    <div class="team-edit-text" id="groupDescSection">
                        <b>Description <em>Lorem Ipsum is simply dummy text of the printing and</em></b>
                        <p id="group-desc">{{$buyer->description??''}}</p>
                        <a href="javascript:void(0);" class="btn-edit-team" onclick="toggleEditMode('#groupDescSection','#inputGroupDescSection')">
                            <img id="editIcon" src="{{asset('Admin/assets/dist/images/edit-svg.svg')}}"> Edit
                        </a>
                    </div>
                    <div class="team-edit-text" id="inputGroupDescSection" style="display: none;">
                        <b>Description <em>Lorem Ipsum is simply dummy text of the printing and</em></b>
                        <div class="d-flex align-items-center">
                            <div class="input-group flex-grow-1">
                                <input class="form-control" type="text" id="groupDescInput" value="{{$buyer->description ?? ''}}" readonly>
                                <div class="input-group-append p-1">
                                    <span class="input-group-text bg-white border-0 gap-1">
                                        <i class="fas fa-check text-success" id="saveDescGroup" style="cursor: pointer;"></i>
                                        <i class="fas fa-times text-danger ml-2" id="cancelDescGroup" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-12">
                <div class="input-wrapper click-relative">
                    <div class="team-edit-text">
                        <b>Add Team Member <em>Lorem Ipsum is simply dummy text of the printing and</em></b>
                        <div>
                            <input placeholder="Enter Member Name" type="text" class="team-click-one" id="edit-team-member-search" />
                            <div class="team-select team-select-po show-list" id="edit-team-member-results" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-12 mb-0 mb-xl-3 new-team-member" style="display: none;">
                <div class="input-wrapper click-relative">
                    <div class="team-edit-text">
                        <b></b>
                        <div class="team-select team-select-po show-list" id="selected-team-members">
                            <h3><span id="team-member-count">0</span> Members Selected </h3>
                            <div class="team-select-one no-team-member-section">
                                <p>Plese Select Team Members</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                <div class="input-wrapper click-relative">
                    <div class="team-edit-text">
                        <b>Team Member <em>Lorem Ipsum is simply dummy text of the printing and</em></b>
                        <div class="team-select team-select-two team-edit">
                            @foreach($buyer->buyerTeamMembers as $member)
                            <div class="team-select-one team-member-{{$member->id}}">
                                <span></span>
                                <p>{{$member->firstname ?? ""}} {{$member->lastname ?? ""}}<b>(SVP Global Sales)</b></p>
                                <a href="javascript:void(0);" class="team-trash" onclick="deleteTeamMember('{{$member->id}}')"><img src="{{asset('Admin/assets/dist/images/trash-icon-white.svg')}}"></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                <div class="input-wrapper click-relative">
                    <div class="team-edit-text">
                        <b>Add More Supplier <em>Lorem Ipsum is simply dummy text of the printing and</em></b>
                        <div>
                            <input type="text" placeholder="Search Supplier Group" id="edit-supplier-search" />
                            <div class="team-select team-select-two show-list edit-supplier-results" style="display: none;">

                            </div>
                            <div class="team-select team-select-two show-list edit-supplier-list">
                                <h3>Selected Suppliers</h3>
                                <div class="team-select-one edit-no-supplier-section">
                                    <p>Plese Select Supplier's</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                <div class="input-wrapper click-relative">
                    <div class="team-edit-text">
                        <b>Pending Supplier <em>Lorem Ipsum is simply dummy text of the printing and</em></b>
                        <div class="team-select team-select-two team-edit">
                            @if($pendingSuppliers->count()==0)
                            <div class="team-select-one">
                                No Pending Suppliers
                            </div>
                            @endif
                            @foreach($pendingSuppliers as $supplier)
                            <div class="team-select-one edit-supplier-{{$supplier->id}}">
                                <span></span>
                                <p>{{$supplier->supplier->company_name??''}}</p>
                                <div class="team-btn-two">
                                    <a href="javascript:void(0);"><svg width="800px" height="800px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none">
                                            <path fill="#000000" d="M7.248 1.307A.75.75 0 118.252.193l2.5 2.25a.75.75 0 010 1.114l-2.5 2.25a.75.75 0 01-1.004-1.114l1.29-1.161a4.5 4.5 0 103.655 2.832.75.75 0 111.398-.546A6 6 0 118.018 2l-.77-.693z" />
                                        </svg> Send Again</a>
                                    <a href="javascript:void(0);" class="team-btn-red" onclick="deleteSupplier('{{$supplier->group_id}}','{{$supplier->id}}')"><svg width="800px" height="800px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                                            <path fill="#000000" d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z" />
                                        </svg> Delete</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                <div class="input-wrapper click-relative">
                    <div class="team-edit-text">
                        <b>Connected Supplier <em>Lorem Ipsum is simply dummy text of the printing and</em></b>
                        <div class="team-select team-select-two team-edit">
                            @if($approvedSuppliers->count()==0)
                            <div class="team-select-one">
                                No Connected Suppliers
                            </div>
                            @endif
                            @foreach($approvedSuppliers as $supplier)
                            <div class="team-select-one edit-supplier-{{$supplier->id}}">
                                <span></span>
                                <p>{{$supplier->supplier->company_name??''}}</p>
                                <a href="javascript:void(0);" class="team-trash" onclick="deleteSupplier('{{$supplier->group_id}}','{{$supplier->id}}')"><img src="{{asset('Admin/assets/dist/images/trash-icon-white.svg')}}"></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                <div class="input-wrapper click-relative">
                    <div class="team-edit-text">
                        <b>Rejected Supplier <em>Lorem Ipsum is simply dummy text of the printing and</em></b>
                        <div class="team-select team-select-two team-edit">
                            @if($rejectedSuppliers->count()==0)
                            <div class="team-select-one">
                                No Rejected Suppliers
                            </div>
                            @endif
                            @foreach($rejectedSuppliers as $supplier)
                            <div class="team-select-one edit-supplier-{{$supplier->id}}">
                                <span></span>
                                <p>{{$supplier->supplier->company_name??''}}</p>
                                <a href="javascript:void(0);" class="team-trash" onclick="deleteSupplier('{{$supplier->group_id}}','{{$supplier->id}}')"><img src="{{asset('Admin/assets/dist/images/trash-icon-white.svg')}}"></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>