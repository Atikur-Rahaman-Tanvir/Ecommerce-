
    <option value="0" label="Select a Zilla" selected="selected">Select a Zilla</option>
    @foreach ($upozillas as $newupozillas )
     <option value="{{$newupozillas->upozilla}}">{{App\Models\Upozila::select('name')->where('id', $newupozillas->upozilla)->get()[0]['name']}}</option>
     @endforeach

