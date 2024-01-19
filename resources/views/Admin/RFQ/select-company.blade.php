@foreach($return as $re)
<div class="company-add-card" style="cursor: pointer;" data-name="{{$re->company_name}}" data-profile="{{$re->company_category}}" data-id="{{$re->id}}">
  <ul class="list-group mt-3">
    <li class="list-group-item">
      <img class="cyc-searchResultsItem__logo" src="https://cdn.thomasnet.com/img/ico-company-default-logo.svg" alt="company logo">{{$re->company_name}}
      @if($re->claimed_status == 1)
      <span class="cyc-searchResultsItem__claimed font-size-xs">
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="icon" style="margin-right: 0.25rem;">
          <title>checkmark</title>
          <path d="M27.604 3.372a1.155 1.155 0 0 0-1.628.112L11.614 19.958 6.477 17.15a1.19 1.19 0 0 0-1.503 1.784l5.457 6.865a2.473 2.473 0 0 0 4.014-.198l.179-.278L27.816 4.867a1.153 1.153 0 0 0-.212-1.495z" fill="currentColor" fill-rule="nonzero"></path>
        </svg>
        Claimed
      </span>
      @endif
    </li>
  </ul>
</div>
<script>
    $(document).ready(function () {
        $(".company-add-card").click(function () {
            $(this).toggle(); // Toggle the visibility of the clicked div
        });
    });

</script>
@endforeach

