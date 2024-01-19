<option>Select Category</option>

@foreach($subcategory as $subcat)
<option value="{{$subcat->id}}" @if($selected_sub_category==$subcat->id) selected @endif>{{$subcat->name}}</option>
@endforeach