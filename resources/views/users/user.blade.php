
//
@extends('layouts.app')

@section('content')
<h1>Users</h1>

<table>
    <thead>
        <tr>
            <th>Student Number</th>
            <th>Email</th>
            <th>Name</th>
            <th>Roles</th>
            <th>Permissions</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->student_number }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->roles }}</td>
            <td>{{ $user->permissions }}</td>
            <!-- <td>{{ $user->permissions }}</td> -->
        </tr>
        @endforeach
    </tbody>
</table>
@endsection