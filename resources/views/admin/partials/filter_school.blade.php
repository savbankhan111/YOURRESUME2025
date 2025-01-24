@foreach($schools as $school)
    <option {{ $school->school->id == Request::get('school')? "selected":""}}  value="{{$school->school->id}}"> {{$school->school->school_name}}</option>
@endforeach