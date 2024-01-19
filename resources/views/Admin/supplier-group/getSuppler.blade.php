    <div class="d-flex flex-column pb-4">
    <h2 class="pb-2">{{$groupWithSuppliers ? $groupWithSuppliers->name : ' '}}</h2>
    <p>{{count($suppli) ?? 0}}  Companies</p>
    </div>
    <div class="accordion accordion-flush" id="accordionFlushExample">
    <form method="POST" action="{{ route('supplier.group.company_add') }}">
        @csrf
        <input type="hidden" name="group_id" value="{{ $groupWithSuppliers->id }}">
        
        <div class="row gap-3 gap-xl-0 ">
        <div class="col-md-12 col-xl-12 mb-0 mb-xl-3">
            <div class="saved-com">
                <h3>{{count($suppli) ?? 0}} Saved Companies</h3>
                <div class="saved-com-r">
                    <div class="saved-com-serach" style="width: 240px; margin-right: 90px;">
                        <img src="{{asset('Admin/assets/dist/images/search-icon.svg')}}" style=" width: 20px;">
                        <input placeholder="Seach new supplier." type="text" class="team-click-two" id="supplier-search" />
                        <span><button type="submit" class="btn btn-primary mt-2 float-end" style="margin-right: -85px; margin-top:-4px !important; height:35px;">Add</button></span>
                        <div class="team-select team-select-two show-list supplier-results mb-2 p-1">
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="team-select team-select-two show-list">
                <div class="col-md-12 col-xl-12 mb-0 mb-xl-3 p-2">
                    <div class="input-wrapper">
                        <p>selected suppliers show here</p>
                    </div>
                </div>
            </div>
        </div>
        @foreach($Company as $data)
            @php
              $companyprofile = App\Models\CompanyProfile::where('company_id',$data->id)->first();
            @endphp
          <a href="{{ route('company.profile.show', ['id' => $data->id]) }}">
        	<div class="col-12 col-xl-12 mb-0 mb-xl-3">
              <div class="addded-team add-slip">
                <span>
                    @if($companyprofile  && $companyprofile->company_logo)    
                        <img src="{{asset($companyprofile->company_logo)}}" alt="icon" class="w-auto img-fluid">
                        @else
                        <img src="{{asset('Admin/assets/dist/images/sun.png')}}" alt="icon" class="w-auto img-fluid">
                    @endif 
                </span>
               <div class="addded-iner">
                    <h2>{{$data->company_name ?? ' '}}</h2>
                    <a href="#" class="delete-btn float-end" data-id="{{ $data->id }}" data-group_id="{{$groupWithSuppliers->id}}">
                        <img class="trash-img" id="image-delect-Sheet" src="{{ asset('Admin/assets/dist/images/trash-icon1.svg') }}">
                    </a>
                    <label class="addded-text">
                      <b style=" position: relative; right:1px; font-size: 14px;">{{$data->City ? $data->City->name : ' '}}, {{$data->State ? $data->State->name : ' '}}</b>
                    </label>
                 </div>
              </div>
           </div>
          </a>
        @endforeach
        </div>
    </form>

    </div>
    

    <script>
        $(document).ready(function () {
            $('.delete-btn').on('click', function (event) {
                event.preventDefault();
                var group_id = $(this).data('group_id');
                var supplier_id = $(this).data('id');
                
                var userConfirmed = confirm('Are you sure you want to delete?');
                
                if (userConfirmed) {
                    console.log({ company_id: supplier_id, group_id: group_id });
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var url = "{{ route('company.profile.delete') }}";
                    
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: { company_id: supplier_id, group_id: group_id },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function (data) {
                            console.log(data);
                            location.reload();
                        },
                        error: function (error) {
                            console.error(error);
                        }
                    });
                }
            });
        });
    </script>


    <script>
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
    </script>


    
    <style>
        .trash-img {
            background: #AA0101;
            height: 30px;
            width: 30px;
            border-radius: 3px;
            padding: 3px;
        }
        .supplier-results {
            position: absolute;
            z-index: 2;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 2 6px 10px rgba(0, 0, 0, 0.5);
            overflow-y: auto; 
            max-height: 300px;
            transform: translateZ(0);
            transition: transform 0.3s ease-in-out;
        }
    
        .supplier-results:hover {
            transform: scale(1.05);
        }
    
        .supplier-results::-webkit-scrollbar {
            width: 4px;
        }
    
        .supplier-results::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 3px;
        }
    
        .team-select::-webkit-scrollbar-track {
            background-color: #f1f1f1;
        }
    </style>



     