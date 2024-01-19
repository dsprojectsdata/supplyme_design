<style>
    .fixed-element {
        position: fixed;
        background-color: white;
        width: 23%;
    }
    
</style>
<div class="cyc-searchResults fade-enter-done" style="position: fixed; height: 204px; overflow-x: auto;width: 26%;">
        <ul class="searchResults__list" role="listbox" style="max-height:183.859px;">
            @foreach($return as $re)
               @php
                  $companyId = base64_encode($re->id);
                   $capmany   = \Illuminate\Support\Facades\Session::push('company_id',$re->id);
               @endphp
            <li class="searchResults__listItem" role="option">
                @if($re->claimed_status == 1)
                    <a class="searchResults__listItem-link" href="{{ Route('auth.loginShow') }}">
                    @else
                        <a class="searchResults__listItem-link"  href="{{ Route('auth.create_an_account',$companyId) }}">
                @endif
                <div class="cyc-searchResultsItem">
                    <img class="cyc-searchResultsItem__logo"
                        src="https://cdn.thomasnet.com/img/ico-company-default-logo.svg" alt="company logo">
                    <div class="cyc-searchResultsItem__titleWrapper">
                        <h4 class="cyc-searchResultsItem__title font-size-sm">{{ $re->company_name }}</h4>
                        <h6 class="cyc-searchResultsItem__subTitle font-size-xs">{{ $re->address }}</h6>
                    </div>
                    @if($re->claimed_status == 1)
                        <span class="cyc-searchResultsItem__claimed font-size-xs">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="icon"
                                style="margin-right: 0.25rem;">
                                <title>checkmark</title>
                                <path
                                    d="M27.604 3.372a1.155 1.155 0 0 0-1.628.112L11.614 19.958 6.477 17.15a1.19 1.19 0 0 0-1.503 1.784l5.457 6.865a2.473 2.473 0 0 0 4.014-.198l.179-.278L27.816 4.867a1.153 1.153 0 0 0-.212-1.495z"
                                    fill="currentColor" fill-rule="nonzero">
                                </path>
                            </svg>
                            Claimed
                        </span>
                    @endif
                </div>
                </a>
            </li>
             @endforeach
             
        </ul>
        <div class="cyc-searchResultsCTA " style="position: fixed; background-color: white; width: 26%;">
                <div>
                    <h4 class="cyc-searchResultsCTA__title font-size-sm">Can't Find Your Business?</h4>
                    <p class="cyc-searchResultsCTA__subTitle font-size-xs">Take Less Than 5 Minutes</p>
                </div>
                <a class="btn btn-primary btn-sm" href="{{ Route('auth.list_your_company') }}" tabindex="0"
                    type="button">
                    List For Free
                </a>
            </div>
</div>
