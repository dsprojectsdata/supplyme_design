@push('custom-style')
@endpush
@extends('Admin.layout.app')
@section('admincontent')
<!-- main content section -->
<div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">
    <!-- Welcome -->
    <div class="d-block flex-wrap gap-3 welcomeBox">
        <div class="row">
            <div class="col-12 col-md-12 col-xl-12 ">
                <div class="tabs-buyer mb-4">
                    <h3>Create Supplier Group</h3>
                  <a href="{{route('admin.supplier.group')}}" class="btn btn-primary float-end" style="margin-top:-20px">Back</a>
                </div>
                <div class="border bg-white p-3 px-sm-4 py-sm-4 tab-content" id="nav-tabContent" style="border-color:#B4B6BD;">
                    @foreach($buyer_list as $buyer)
                    <div class="tab-pane fade" id="nav-buyer-{{$loop->iteration}}" role="tabpanel" aria-labelledby="nav-buyer-{{$loop->iteration}}-tab">
                    </div>
                    @endforeach
                    <div class="tab-pane fade show active" id="nav-product" role="tabpanel"
                        aria-labelledby="nav-product-tab">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div id="error-messages" class="alert alert-danger" style="display: none;">
                                <!-- Error messages will be displayed here -->
                            </div>
                            <form id="create-group-form" method="POST" action="{{route('admin.save.supplier.group')}}">
                                @csrf
                                <div class="row gap-3 gap-xl-0">
                                    <div class="col-3 col-xl-3 mb-0 mb-xl-3">
                                        <div class="input-wrapper mt-10">
                                            <b>Group Name</b><label class="text-danger">*</label>
                                        </div>
                                    </div>
                                    <div class="col-9 col-xl-9 mb-0 mb-xl-3">
                                        <div class="input-wrapper">
                                            <input type="text" placeholder="Group Name" name="group_name">
                                        </div>
                                    </div>
                                    <div class="col-3 col-xl-3 mb-0 mb-xl-3">
                                        <div class="input-wrapper mt-10">
                                            <b>Suppliers</b><label class="text-danger">*</label>
                                        </div>
                                    </div>
                                    <div class="col-9 col-xl-9 mb-0 mb-xl-3">
                                        <div class="input-wrapper click-relative">
                                            <input placeholder="Search Supplier Group" type="text" class="team-click-two" id="supplier-search" />
                                            <div class="team-select team-select-two show-list supplier-results">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="team-select team-select-two show-list">
                                    <div class="col-3 col-xl-3 mb-0 mb-xl-3">
                                        <div class="input-wrapper mt-10">
                                            <h3>Selected Suppliers</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-12 mb-0 mb-xl-3 mt-2">
                                    <button type="submit" id="submit-form" class="btn btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    <!-- back bxutton -->
    @push('custom-script')
    <script>
        $(document).ready(function () {
            $('.buyer-group-link').on('click', function (e) {
                e.preventDefault();
                var tabId = $(this).data('bs-target');
                var group_id = $(this).data('group-id');
                $.ajax({
                    url: "{{route('company.buyer.info')}}",
                    type: 'POST',
                    data: {
                        group_id: group_id,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        $('#accordionFlushExample').remove();
                        $(tabId).html(response.html);
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX request failed:', error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".menu").click(function () {
                $(".wrapper").toggleClass("sidebarToggle");
            });
        });

        function isAlreadySelected(id, type) {
            console.log(`.${type}-selected input[name="${type}[]"]`);
            const selectedItems = $(`.${type}-selected input[name="${type}[]"]`).map(function () {
                return $(this).val();
            }).get();
            console.log(selectedItems);
            return selectedItems.includes(id.toString());
        }
    </script>
    <script>
        var typingTimer;
        var doneTypingInterval = 500;
        $(document).ready(function () {

            // When user starts typing
            $('#team-member-search').on('input', function () {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(performTeamSearch, doneTypingInterval);
            });

            const performTeamSearch = () => {
                const query = $('#team-member-search').val();
                const resultsDiv = $('#team-member-results');
                resultsDiv.empty();
                if (query == '')
                    return
                $.ajax({
                    url: "{{ route('admin.search.team.members') }}",
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function (response) {
                        const entries = Object.entries(response);
                        entries.forEach(function (entry) {
                            const teamMemberName = entry[0];
                            const teamMemberId = entry[1];

                            const resultItem = `
                       <div class="team-select-one team-member-result" data-id="${teamMemberId}">
                           <span></span>
                           <p>${teamMemberName}</p>
                       </div>
                   `;
                            resultsDiv.append(resultItem);
                        });

                        $('.team-member-result').on('click', function () {

                            $('.no-team-member-section').hide();
                            const teamMemberName = $(this).text();
                            const teamMemberId = $(this).data('id');
                            const selectedTeamMembersDiv = $('#selected-team-members');
                            const teamMemberItem = `
                       <div class="team-select-one team-selected team_member-selected" id="team-member-${teamMemberId}">
                           <span></span>
                           <input type="hidden" name="team_member[]" value="${teamMemberId}">
                           <p>${teamMemberName}</p>
                           <div class="team-btn-two" onclick="removeTeamMember(event, ${teamMemberId})">
                               <a href="" class="team-btn-red"><svg width="800px" height="800px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path fill="#000000" d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z"></path></svg> Remove</a>
                           </div>
                       </div>
                   `;

                            if (!isAlreadySelected(teamMemberId, 'team_member')) {
                                selectedTeamMembersDiv.append(teamMemberItem);
                            }
                            $('.team-member-search').val('');
                            resultsDiv.empty();

                            const selectedTeamMemberCount = $('.team_member-selected').length;
                            $('#team-member-count').html(selectedTeamMemberCount);
                        });
                    }
                });
            }
        });

        function removeTeamMember(event, teamMemberId) {
            event.preventDefault();
            const teamMemberDiv = document.getElementById(`team-member-${teamMemberId}`);
            if (teamMemberDiv) {
                teamMemberDiv.remove();
            }
            const selectedTeamMemberCount = $('.team_member-selected').length;

            if (selectedTeamMemberCount < 1) {
                $('.no-team-member-section').show();
            } else {
                $('.no-team-member-section').hide();
            }
            $('#team-member-count').html(selectedTeamMemberCount);
        }
    </script>
    <script>
        function removeCompany(event, companyId) {
            event.preventDefault();
            const companyDiv = document.getElementById(`supplier-company-${companyId}`);
            if (companyDiv) {
                companyDiv.remove();
            }
            const selectedSupplierCount = $('.supplier-selected').length;

            if (selectedSupplierCount < 1) {
                $('.edit-').show();
            } else {
                $('.edit-').hide();
            }
        }
        $(document).ready(function () {
            $('#supplier-search').on('input', function () {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(performSupplierSearch, doneTypingInterval);
            });
            const performSupplierSearch = () => {
                // $('#supplier-search').on('input', function() {
                const query = $('#supplier-search').val();
                const resultsDiv = $('.supplier-results');
                resultsDiv.empty();
                if (query == '')
                    return

                $.ajax({
                    url: "{{ route('admin.search.companies') }}",
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function (response) {
                        console.log(response);
                        const entries = Object.entries(response);
                        entries.forEach(function (entry) {
                            const companyName = entry[0];
                            const companyId = entry[1];

                            const resultItem = `<div class="team-select-one "><span></span><p class="company-result" data-id=${companyId}>${companyName}</p></div>`;
                            // const resultItem = `<div class="company-result" data-id=${companyId}>${companyName}</div>`;
                            resultsDiv.append(resultItem);
                        });
                        $('.company-result').on('click', function () {
                            $('.edit-').hide();
                            const companyName = $(this).text();
                            const companyId = $(this).data('id');
                            const selectedSuppliersDiv = $('.team-select-two');
                            const supplierItem = `
                           <div class="team-select-one supplier-selected my-2" id="supplier-company-${companyId}">
                               <span></span>
                               <input type="hidden" name="supplier[]" value="${companyId}">
                               <p>${companyName}</p>
                               <a href="#" class="team-trash" onclick="removeCompany(event, ${companyId})">
                                   <img style="background: #777; width: 20px; height: 20px; float: right; border-radius: 100%; display: flex; justify-content: center; align-items: center;" src="{{asset('Admin/assets/dist/images/trash-icon-white.svg')}}">
                               </a>
                           </div>
                       `;
                            if (!isAlreadySelected(companyId, 'supplier')) {
                                selectedSuppliersDiv.append(supplierItem);
                            }

                            $('#supplier-search').val('');
                            resultsDiv.empty();
                        });
                    }
                });
            }
        });
        $(function () {
            $('.tab-title').on('click', function (e) {
                e.preventDefault();
                var _self = $(this);
                $('.tab').removeClass('active');
                _self.parent().addClass('active');
            });
        });
    </script>
    <script>
        function toggleEditMode(groupSection, inputSection) {
            $(groupSection).toggle();
            $(inputSection).toggle();
            $(inputSection + ' input').prop('readonly', function (i, readonly) {
                return !readonly;
            });
        }
        $(document).ready(function () {
            $('body').on('click', '#saveNameGroup', function () {
                var editedGroupName = $('#groupNameInput').val();
                var group_id = $('#buyer_group_id').val();
                $.ajax({
                    url: "{{route('save.buyer.group.info')}}",
                    method: 'POST',
                    data: {
                        group_id: group_id,
                        group_name: editedGroupName,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        if (response.success) {
                            $(`body .data-group-tab-section-${group_id} .group-name`).html(editedGroupName)
                            $('#group-name').text(editedGroupName);
                            toggleEditMode('#groupNameSection', '#inputGroupNameSection');
                        } else {
                            alert('Failed to save. Please try again.');
                        }
                    },
                    error: function () {
                        alert('An error occurred while saving. Please try again.');
                    }
                });
            });

            $('body').on('click', '#cancelNameGroup', function () {
                toggleEditMode('#groupNameSection', '#inputGroupNameSection');
            });
        });
        $(document).ready(function () {
            $('body').on('click', '#saveDescGroup', function () {
                var editedGroupDesc = $('#groupDescInput').val();
                var group_id = $('#buyer_group_id').val();
                $.ajax({
                    url: "{{route('save.buyer.group.info')}}",
                    method: 'POST',
                    data: {
                        group_id: group_id,
                        group_description: editedGroupDesc,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#group-desc').text(editedGroupDesc);
                            toggleEditMode('#groupDescSection', '#inputGroupDescSection');
                        } else {
                            alert('Failed to save. Please try again.');
                        }
                    },
                    error: function () {
                        alert('An error occurred while saving. Please try again.');
                    }
                });
            });

            $('body').on('click', '#cancelDescGroup', function () {
                toggleEditMode('#groupDescSection', '#inputGroupDescSection');
            });
        });

        function img_onError(_this) {
            _this.src = "{{asset('dummy-image.jpg')}}";
        }
    </script>
    <script>
        const debouncedperformEditTeamSearch = debounce(performEditTeamSearch, 500);

        $('body').on('input', '#edit-team-member-search', function () {
            debouncedperformEditTeamSearch();
        });

        function performEditTeamSearch() {
            const query = $('body').find('#edit-team-member-search').val();
            const resultsDiv = $('#edit-team-member-results');
            resultsDiv.empty();
            if (query == '') {
                resultsDiv.hide();
                return
            }
            resultsDiv.show();

            $.ajax({
                url: "{{ route('admin.search.team.members') }}",
                type: 'GET',
                data: {
                    query: query,
                    buyer_group_id: $('#buyer_group_id').val()
                },
                success: function (response) {
                    const entries = Object.entries(response);
                    entries.forEach(function (entry) {
                        const teamMemberName = entry[0];
                        const teamMemberId = entry[1];

                        const resultItem = `
                       <div class="team-select-one team-member-result" data-id="${teamMemberId}">
                           <span></span>
                           <p>${teamMemberName}</p>
                       </div>
                   `;
                        resultsDiv.append(resultItem);
                    });

                    $('.team-member-result').on('click', function () {
                        resultsDiv.hide();
                        $('.new-team-member').show()
                        $('.no-team-member-section').hide();
                        const teamMemberName = $(this).text();
                        const teamMemberId = $(this).data('id');
                        const selectedTeamMembersDiv = $('#selected-team-members');
                        const teamMemberItem = `
                       <div class="team-select-one team-selected edit_team_member-selected" id="team-member-${teamMemberId}">
                           <span></span>
                           <input type="hidden" name="edit_team_member[]" value="${teamMemberId}">
                           <p>${teamMemberName}</p>
                           <div class="team-btn-two" onclick="removeTeamMember(event, ${teamMemberId})">
                               <a href="" class="team-btn-red"><svg width="800px" height="800px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path fill="#000000" d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z"></path></svg> Remove</a>
                           </div>
                       </div>
                   `;

                        if (!isAlreadySelected(teamMemberId, 'edit_team_member')) {
                            selectedTeamMembersDiv.append(teamMemberItem);
                        }
                        $('.team-member-search').val('');
                        resultsDiv.empty();

                        const selectedTeamMemberCount = $('.edit_team_member-selected').length;
                        $('#team-member-count').html(selectedTeamMemberCount);
                    });
                }
            });
        }

        function deleteTeamMember(team_member_id) {
            const confirmed = window.confirm('Are you sure you want to delete this team member?');
            if (confirmed) {
                $.ajax({
                    url: "{{ route('delete.buyer.team.member', ['id' => '/']) }}" + `/${team_member_id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    success: function (response) {
                        if (response.success) {
                            $(`.team-member-${team_member_id}`).remove();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX request failed:', error);
                    }
                });
            }
        }

        function deleteSupplier(group_id, supplier_id) {
            if (confirm("Are you sure you want to delete this supplier?")) {
                $.ajax({
                    url: "{{ route('delete.buyer.supplier') }}",
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    data: {
                        group_id,
                        supplier_id,
                    },
                    success: function (response) {
                        if (response.success) {
                            $(`.edit-supplier-${supplier_id}`).remove();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX request failed:', error);
                    }
                });
            }
        }

        $('body').on('input', '#edit-supplier-search', function () {
            debouncedperformEditSupplier();
        });
        const performSupplierSearch = () => {
            const query = $('#edit-supplier-search').val();
            const resultsDiv = $('.edit-supplier-results');
            resultsDiv.empty();
            if (query == '') {
                resultsDiv.hide();
                return
            }
            resultsDiv.show();

            $.ajax({
                url: "{{ route('admin.search.companies') }}",
                type: 'GET',
                data: {
                    query: query,
                    buyer_group_id: $('#buyer_group_id').val()
                },
                success: function (response) {
                    console.log(response);
                    const entries = Object.entries(response);
                    entries.forEach(function (entry) {
                        const companyName = entry[0];
                        const companyId = entry[1];

                        const resultItem = `<div class="team-select-one "><span></span><p class="company-result" data-id=${companyId}>${companyName}</p></div>`;
                        resultsDiv.append(resultItem);
                    });
                    $('.company-result').on('click', function () {
                        resultsDiv.hide();
                        $('.edit-no-supplier-section').hide();
                        const companyName = $(this).text();
                        const companyId = $(this).data('id');
                        const selectedSuppliersDiv = $('.edit-supplier-list');
                        const supplierItem = `
                           <div class="team-select-one edit_supplier-selected" id="supplier-company-${companyId}">
                               <span></span>
                               <input type="hidden" name="edit_supplier[]" value="${companyId}">
                               <p>${companyName}</p>
                               <a href="#" class="team-trash" onclick="removeCompany(event, ${companyId})">
                                   <img src="{{asset('Admin/assets/dist/images/trash-icon-white.svg')}}">
                               </a>
                           </div>
                       `;
                        if (!isAlreadySelected(companyId, 'edit_supplier')) {
                            selectedSuppliersDiv.append(supplierItem);
                        }

                        $('#edit-supplier-search').val('');
                        resultsDiv.empty();
                    });
                }
            });
        }
        const debouncedperformEditSupplier = debounce(performSupplierSearch, 500);
    </script>
    @endpush
    @push('custom-style')
    <style>
        .supplier-results,
        #team-member-results {
            max-height: 200px;
            overflow-y: scroll;
        }

        .team-select-one p {
            cursor: pointer;
        }

        .team-select-one {
            display: flex;
            align-items: center;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }

        .team-select-one span {
            width: 20px;
            height: 20px;
            /*background-color: #ff4d4d; */
            background-color: gray;
            border-radius: 50%;
            margin-right: 10px;
        }

        .team-select-one p {
            margin: 0;
            font-weight: bold;
        }

        .team-trash {
            margin-left: auto;
            text-decoration: none;
            color: #fff;
            background-color: gray;
            padding: 5px;
            border-radius: 50%;
        }

        .team-trash img {
            width: 20px;
            height: 20px;
        }
    </style>
    @endpush