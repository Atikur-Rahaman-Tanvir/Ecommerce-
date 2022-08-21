
    <option value="0" label="Select a Zilla" selected="selected">Select a Zilla</option>
    @foreach ($zillas as $newZila )
     <option value="{{$newZila->zilla}}">{{App\Models\Zila::select('name')->where('id', $newZila->zilla)->get()[0]['name']}}</option>
     @endforeach

