@foreach($roles as $role)
    <option {{ $role->id == $role_id ? "selected":""}}  value="{{$role->id}}"> {{$role->role}}</option>
@endforeach