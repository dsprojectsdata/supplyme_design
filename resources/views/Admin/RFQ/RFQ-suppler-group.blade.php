<div class="d-flex flex-column pb-4">
    <h2 class="pb-2">{{$groupWithSuppliers ? $groupWithSuppliers->name : ' '}}</h2>
    <p>{{count($suppli) ?? 0}}  Companies</p>
    </div>
    <div class="accordion accordion-flush" id="accordionFlushExample">
    <form id="companyForm" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row gap-3 gap-xl-0 ">
        <div class="col-12 col-xl-12 mb-0 mb-xl-3">
            <div class="saved-com">
            <h3>{{count($suppli) ?? 0}} Saved Companies</h3>
            <div class="saved-com-r">
                <div class="saved-com-serach">
                <img src="{{asset('Admin/assets/dist/images/search-icon.svg')}}" style=" width: 20px;">
                <input type="text" placeholder="Search this list" />
                </div>
            </div>
            </div>
        </div>
        @foreach($Company as $data)
        <div class="col-12 col-xl-12 mb-0 mb-xl-3">
            <div class="addded-team add-slip">
            <input type="checkbox" value="{{$data->id}}" id="companySelect" name="checkout[]" data-name="{{$data->company_name}}" data-id="{{$data->id}}" data-category-id="{{$data->company_category}}" data-profile="{{$data->company_category}}">
            <span><img src="{{ asset('Admin/assets/dist/images/table-iconOne.png') }}" alt="icon" class="w-auto img-fluid"></span>
            <div class="addded-iner">
            <a href="{{ route('company.profile.show', ['id' => $data->id]) }}"> <h2>{{$data->company_name}}</h2></a>
            <label class="addded-text">
                <b>Distributor</b>
                <b><em><img src="{{ asset('Admin/assets/dist/images/television-icon.svg') }}" style=" width: 20px;"> Detroit, MI 53226 </em><em><img src="{{ asset('Admin/assets/dist/images/user-icon.svg')}}" style=" width: 20px;"> 150 - 200</em><em><img src="{{ asset('Admin/assets/dist/images/report-icon.svg')}}" style=" width: 20px;"> 24</em></b>
            </label>
            </div>
            </div>
        </div>
        @endforeach
        </div>
        <div class="col-12" style=" text-align: end;">
            <input type="button" id="addCompanyButton" value="Add" class="btn btn-success " data-bs-dismiss="modal" >
            <!-- <input type="button" value="cancel" class="btn btn-danger"  class="btn btn-default" data-bs-dismiss="modal"> -->
        </div>
    </form>
    
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize an array to keep track of added companies
    var addedCompanies = [];

    $('#addCompanyButton').on('click', function() {
        // Find all checkboxes with class 'companySelect' that are checked
        $('#companySelect:checked').each(function() {
            var AddcompanyName = $(this).data('name');
            var comCatg = $(this).data('category-id');
            var AddcompanyProfile = $(this).data('profile');
            var AddcompanyId = $(this).data('id');
            
            // Check if the company name is not already in the addedCompanies array
            if (!addedCompanies.includes(AddcompanyName)) {
                var cardHtml = `
                    <div class="col-4 col-xl-4 mb-0 mb-xl-3">
                        <div class="addded-team add-slip" data-card-id="${AddcompanyId}">
                            <a href="#" class="close-icon adddelete-company" data-card-id="${AddcompanyId}"><img src="{{asset('Admin/assets/dist/images/trash-icon1.svg')}}"></a>
                            <span><img src="{{asset('Admin/assets/dist/images/table-iconOne.png')}}" alt="icon" class="w-auto img-fluid"></span>
                            <div class="addded-iner">
                                <h2>${AddcompanyName}</h2>
                                <label class="addded-text">
                                    <b>Company Profile :-${AddcompanyProfile}</b>
                                    <input type="hidden" name="supplier_add[]" value="${AddcompanyId}">
                                </label>
                            </div>
                        </div>
                    </div>`;
                
                $('.supplierCardContainer').append(cardHtml);
                
                // Add the company name to the addedCompanies array
                addedCompanies.push(AddcompanyName);
            }
            
            // Uncheck the corresponding checkbox
            $(this).prop('checked', false);
        });
    });

    $("body").on("click", ".adddelete-company", function(e) {
        e.preventDefault();
        var $card = $(this).closest(".addded-team");
        var cardId = $card.data('card-id');

        // Remove the company name from the addedCompanies array
        addedCompanies = addedCompanies.filter(name => name !== AddcompanyName);

        // Remove the card based on the card ID
        $card.remove();
    });
});
</script>
     