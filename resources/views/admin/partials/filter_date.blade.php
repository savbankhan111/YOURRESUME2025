@foreach($datesArray as $key => $value)
    <option {{ $value == Request::get('date')? "selected":""}}  value="{{$value}}"> {{$key}} Day</option>
@endforeach