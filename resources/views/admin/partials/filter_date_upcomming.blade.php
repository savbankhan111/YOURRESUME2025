@foreach($datesArrayUpcomming as $key => $value)
    <option {{ $value == Request::get('date')? "selected":""}}  value="{{$value}}"> {{$key}} </option>
@endforeach