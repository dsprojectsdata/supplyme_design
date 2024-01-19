<option>Select State Name</option>
@foreach($States as $State)
<option value="{{$State->id}}" @if($selected_state==$State->id) selected @endif>{{$State->name}}</option>
@endforeach