@foreach($roles as $role)
    <td> {{ $role->id == $role_id ? $role->role : "" }}</td>
    @break
@endforeach