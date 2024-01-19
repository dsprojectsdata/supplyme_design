<option>Select City Name</option>
@foreach($citys as $city)
<option value="{{$city->id}}" @if($selected_city==$city->id) selected @endif>{{$city->name}}</option>
@endforeach