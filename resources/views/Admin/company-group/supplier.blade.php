@push('custom-style')
@endpush
@extends('Admin.layout.app')
@section('admincontent')
<!-- main content section -->
<div class="main-content px-md-4 px-2 py-4" style="margin-top:57px">
    <!-- Welcome -->
    <div class="d-block flex-wrap gap-3 welcomeBox">

        <div class="row">
            <div class="col-12 col-md-5 col-xl-3 mb-3 mb-md-0">
                <div class="border bg-white compnay-tabs-ul" style="border-color:#B4B6BD;">
                    <div class="tabs-ac">
                        <a href="{{route('admin.create.group')}}">As Buyer</a>
                        <a href="#" class="active">As Supplier</a>
                    </div>
                    <ul class="d-flex flex-column nav nav-tabs listing" id="nav-tabs" role="tablist">
                        @if($supplier_list->count()==0)
                        <div class="text-center">
                            <img style="max-width: 250px" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror="img_onError(this)">
                        </div>
                        @endif
                        @foreach($supplier_list as $supplier)
                        <li>
                            <a id="nav-supplier-{{$loop->iteration}}-tab" data-bs-toggle="tab" data-bs-toggle="tab" data-bs-target="#nav-supplier-{{$loop->iteration}}" type="button" role="tab" aria-controls="nav-supplier-{{$loop->iteration}}" aria-selected="true" href="#" class="nav-link py-3 px-4 d-block position-relative group-link" data-group-id="{{$supplier->id}}">
                                <div class="tab-text">
                                    <div class="row">
                                        <div class="col-7">
                                            <b>{{$supplier->name ?? ''}}</b>
                                        </div>
                                        <div class="col-5">
                                            @if($supplier->supplierStatus->status == 1)
                                            <small class="badge bg-primary">Accepted</small>
                                            @else
                                            <small class="badge bg-warning">Pending</small>
                                            @endif
                                        </div>
                                    </div>
                                    <p>{{$supplier->supplierCount ?? 0}} Supplier</p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                        <!-- <div class="btn-networl">
                            <a href="{{route('admin.create.group')}}" class="btn btn-primary">Create Supplier Network</a>
                        </div> -->
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-7 col-xl-9 ">
                <div class="tabs-buyer">
                    <h3>Create Supplier Network Group</h3>
                    <div class="ac-to-p d-none">
                        <ul class="nav nav-tab">
                            <li class="nav-item mx-1" id="group-feed-tab">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#group-feed" href="#">Feed</a>
                            </li>
                            <li class="nav-item mx-1">
                                <a class="nav-link" id="" href="#">Analytics</a>
                            </li>
                            <li class="nav-item mx-1">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="" id="group-setting-tab" href="#">Settings</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="border bg-white p-3 px-sm-4 py-sm-4 tab-content" id="nav-tabContent" style="border-color:#B4B6BD;">
                    @foreach($supplier_list as $supplier)
                    <div class="tab-pane fade" id="nav-supplier-{{$loop->iteration}}" role="tabpanel" aria-labelledby="nav-supplier-{{$loop->iteration}}-tab">
                    </div>
                    @endforeach
                    <!-- feed tab -->
                    <div class="tab-pane fade" id="group-feed" data-group="" role="tabpanel" aria-labelledby="group-feed">
                        
                    </div>
                    <!-- end feed tab -->
                    @if($supplier_list->count()==0)
                    <div class="text-center">
                        <img style="max-width: 500px" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror="img_onError(this)">
                    </div>
                    @endif
                    <div class="text-center" id="no-data-section">
                        <img style="max-width: 500px" src="{{ asset('storage/no-data.jpg') }}" alt="no-data" onerror="img_onError(this)">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- questionnair answer model -->
                     <!-- Modal Start -->
<div class="modal fade" id="questionnaire-answer-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body" id="questionnaire-answer-form">

        </div>
    </div>
  </div>
</div>
<!-- end -->

@endsection
<!-- back bxutton -->
@push('custom-script')
<script>
    $(document).ready(function() {
        $('.group-link').on('click', function(e) {
            e.preventDefault();
            var tabId = $(this).data('bs-target');
            var group_id = $(this).data('group-id');
            $('div.ac-to-p').find('a.nav-link.active').removeClass('active');
            $('div.ac-to-p').find('a#group-setting-tab').addClass('active').attr('data-bs-target', $(this).attr('data-bs-target'));

            $.ajax({
                url: "{{route('company.supplier.info')}}",
                type: 'POST',
                data: {
                    group_id: group_id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#no-data-section').hide();
                    $(tabId).html(response.html);
                    $('div#group-feed').html(response.feedHtml);
                    $('div#group-feed').attr('data-group', group_id);
                    $('div#group-feed').find('form#news-feed-form').find('input[name=ccg_id]').val(group_id);
                    $('div.ac-to-p').removeClass('d-none');
                    $('div#group-feed').find('form#news-feed-form').remove();
                    $('body').find('a.delete-feed').each(function(index, element) {
                        // element.addEventListener('click', function(event){
                        //     event.preventDefault();
                        //     if (confirm('Are you sure you want to delete this')) {
                        //         deleteFeed(element);
                        //     }
                        // });
                        addEventListenerIfNotExists(element, "click", deleteFeed);
                    });
                    // add event listeners to delete comment
                    $('body').find('a.delete-comment').each(function(index, element) {
                        addEventListenerIfNotExists(element, "click", deleteComment);
                    });
                    hideEmptyCommentDiv();
                },
                error: function(xhr, status, error) {
                    $('#no-data-section').show();
                    console.error('AJAX request failed:', error);
                }
            });
        });
        
        // fetch questionnaire data
        $('body').on('click', '.show-questionnaire', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            $.getJSON(url, function(response) {
                $('body').find('div#questionnaire-answer-form').html(response.data);
            });
        });
        
        function isFile(input) {
            return input instanceof File;
        }
        
        $('body').on('submit', '#questionnare-answer-form', function (e) {
            e.preventDefault();
            let formElement = document.getElementById('questionnare-answer-form');
            let formData = new FormData(formElement);
            let fileInputs = $(formElement).find('input[type=file]');
            for (let i = 0; i < fileInputs.length; i++) {
                if (isFile(fileInputs[i].files[0])) {
                    formData.delete(`${fileInputs[i].getAttribute('name')}`);
                    formData.append(`${fileInputs[i].getAttribute('name')}`, fileInputs[i].files[0]);
                }
            }
            let url = formElement.getAttribute('action');
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status == 'success') {
                        alert(response.message);
                        formElement.reset();
                        $('body').find('div#questionnaire-answer-form').html('');
                        $('body').find('div#questionnaire-answer-Modal').modal('hide');
                    }
                },error: function (xhr, textStatus, errorThrown) {
                    console.log(errorThrown.text);
                }
            });
        });
    });
</script>

<script>
    function isAlreadySelected(id, type) {
        const selectedItems = $(`.${type}-selected input[name="${type}[]"]`).map(function() {
            return $(this).val();
        }).get();
        console.log(selectedItems);
        return selectedItems.includes(id.toString());
    }

    function removeMember(event, group_team_members_id = null) {
        const teamMemberDiv = document.getElementById(`team-member-${group_team_members_id}`);
        const confirmed = window.confirm('Are you sure you want to delete this team member?');
        if (confirmed) {
            $.ajax({
                url: "{{ route('delete.supplier.team.member', ['id' => '/']) }}" + `/${group_team_members_id}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                success: function(response) {
                    if (response.success) {
                        if (teamMemberDiv) {
                            teamMemberDiv.remove();
                        }
                        const selectedTeamMemberCount = $('.team_member-selected').length;
                        $('body').find('#team-member-count').html(selectedTeamMemberCount);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });
        }
    }
</script>
<script>
    var typingTimer;
    var doneTypingInterval = 500;
    $(document).ready(function() {
        // When user starts typing
        $(document).on('input', '#team-member-search', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(performTeamSearch, doneTypingInterval);
        });
        const performTeamSearch = () => {
            const query = $('#team-member-search').val();
            const resultsDiv = $('#team-member-results');
            resultsDiv.empty();

            $.ajax({
                url: "{{ route('admin.search.team.members') }}",
                type: 'GET',
                data: {
                    query: query
                },
                success: function(response) {
                    const entries = Object.entries(response);
                    entries.forEach(function(entry) {
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

                    $('.team-member-result').on('click', function() {

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

                        const selectedTeamMemberCount = selectedTeamMembersDiv.find('.team_member-selected').length;
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
        const selectedTeamMemberCount = $('#selected-team-members .team_member-selected').length;

        if (selectedTeamMemberCount < 1) {
            $('.no-team-member-section').show();
        } else {
            $('.no-team-member-section').hide();
        }
        $('#team-member-count').html(selectedTeamMemberCount);
    }
</script>

<script>
    $(function() {
        $('.tab-title').on('click', function(e) {
            e.preventDefault();
            var _self = $(this);
            $('.tab').removeClass('active');
            _self.parent().addClass('active');
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('body').on('click', "#accept-submit-form", function(e) {
            e.preventDefault();
            var formData = $("#accept-supplier-form").serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('admin.validate.supplier.group') }}",
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $("#accept-supplier-form").submit();
                    }
                },
                error: function(xhr, status, error) {
                    console.log('XHR Status: ' + status);
                    console.log('Error: ' + error);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessages = '';
                        $.each(errors, function(field, messages) {
                            $.each(messages, function(index, message) {
                                errorMessages += '<p>' + message + '</p>';
                            });
                        });
                        $('#error-messages').show();
                        $("#error-messages").html(errorMessages);
                    } else {
                        $("#error-messages").html('<p>An error occurred while processing your request.</p>');
                    }
                }
            });
        });
    });

    function img_onError(_this) {
        _this.src = "{{asset('storage/dummy-image.jpg')}}";
    }
</script>
<script>
    $('body').on('input', '#edit-team-member-search', function() {
        debouncedperformEditTeamMember();
    });
    const performTeamSearch = () => {
        const query = $('#edit-team-member-search').val();
        const resultsDiv = $('#edit-team-member-results');
        resultsDiv.empty();
        resultsDiv.show();

        $.ajax({
            url: "{{ route('admin.search.team.members') }}",
            type: 'GET',
            data: {
                query: query,
                buyer_group_id: $('#supply_group_id').val(),
            },
            success: function(response) {
                const entries = Object.entries(response);
                entries.forEach(function(entry) {
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

                $('.team-member-result').on('click', function() {
                    $('.supplier-save-button').attr('disabled', false);
                    resultsDiv.hide();
                    $('.no-team-member-section').hide();
                    const teamMemberName = $(this).text();
                    const teamMemberId = $(this).data('id');
                    const selectedTeamMembersDiv = $('.edit-selected-team-members');
                    const teamMemberItem = `
                        <div class="team-select-one team-selected team_member-selected edit-team-member-selected" id="team-member-${teamMemberId}">
                            <span></span>
                            <input type="hidden" name="team_member[]" value="${teamMemberId}">
                            <p>${teamMemberName}</p>
                            <div class="team-btn-two" onclick="removeEditTeamMember(event, ${teamMemberId})">
                                <a href="" class="team-btn-red"><svg width="800px" height="800px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path fill="#000000" d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z"></path></svg> Remove</a>
                            </div>
                        </div>
                    `;

                    if (!isAlreadySelected(teamMemberId, 'team_member')) {
                        selectedTeamMembersDiv.append(teamMemberItem);
                    }
                    $('#edit-team-member-search').val('');
                    resultsDiv.empty();

                    const selectedTeamMemberCount = selectedTeamMembersDiv.find('.team_member-selected').length;
                    $('#team-member-count').html(selectedTeamMemberCount);
                });
            }
        });
    }
    const debouncedperformEditTeamMember = debounce(performTeamSearch, 500);

    function removeEditTeamMember(event, teamMemberId) {
        event.preventDefault();
        const confirmed = window.confirm('Are you sure you want to delete this team member?');
        if (confirmed) {
            const teamMemberDiv = document.getElementById(`team-member-${teamMemberId}`);
            if (teamMemberDiv) {
                teamMemberDiv.remove();
            }
            const selectedTeamMemberCount = $('.edit-selected-team-members .team_member-selected').length;

            if ($('.edit-selected-team-members .edit-team-member-selected').length < 1) {
                $('.supplier-save-button').attr('disabled', true);
            } else {
                $('.supplier-save-button').attr('disabled', false);
            }
            $('#team-member-count').html(selectedTeamMemberCount);
        }
    }
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
</style>
@endpush