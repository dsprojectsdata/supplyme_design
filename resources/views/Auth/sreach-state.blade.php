<option>Select State Name</option>
    @foreach($States as $State)
    <option value="{{$State->id}}">{{$State->name}}</option>
    @endforeach