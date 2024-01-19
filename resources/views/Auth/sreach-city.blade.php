<option>Select City Name</option>
@foreach($citys as $city)
<option value="{{$city->id}}">{{$city->name}}</option>
@endforeach