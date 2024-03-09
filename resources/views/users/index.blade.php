@extends('layouts.layouts')

@section('content')

<div>
    @include('layouts.sidebar')
</div>
<div class="container-tbl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2><b>Manage Users</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUserModal">
                            <i class="material-icons">&#xE147;</i> <span>Add New User</span>
                        </button>
                        <button class="btn btn-danger" onclick="deleteSelectedUsers()"><i class="material-icons">&#xE872;</i> <span>Delete Selected Users</span></button>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="table-column">
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th>
                        <th class="table-column">ID</th>
                        <th class="table-column">Name</th>
                        <th class="table-column">Email</th>
                        <th class="table-column">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" class="checkbox" id="checkbox{{ $user->id }}" name="options[]" value="{{ $user->id }}">
                                <label for="checkbox{{ $user->id }}"></label>
                            </span>
                        </td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="#" class="edit" data-toggle="modal" data-target="#editUserModal{{ $user->id }}"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#" class="delete" onclick="confirmDelete('{{ $user->id }}')"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $users->links() }} 
            </div>
            <!-- Move the form outside the loop -->
            <form id="delete-user-form" action="{{ route('users.destroy', ':userId') }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
                <input type="hidden" id="delete-user-id" name="user_id">
            </form>
        </div>
    </div>
</div>

@include('users.create')

@include('users.edit', ['user' => $user])


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();
    
    // Select/Deselect checkboxes
    $("#selectAll").click(function(){
        $(".checkbox").prop('checked', $(this).prop('checked'));
    });
});

function deleteSelectedUsers() {
    var selectedUsers = [];
    $(".checkbox:checked").each(function() {
        selectedUsers.push($(this).val());
    });

    if (selectedUsers.length === 0) {
        alert("Please select at least one user to delete.");
        return;
    }

    if (confirm('Are you sure you want to delete the selected users?')) {
        selectedUsers.forEach(function(userId) {
            $('#delete-user-id').val(userId);
            $('#delete-user-form').attr('action', $('#delete-user-form').attr('action').replace(':userId', userId));
            $('#delete-user-form').submit();
        });
    }
}

function confirmDelete(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        // Set the user ID in the form and submit
        $('#delete-user-id').val(userId);
        $('#delete-user-form').attr('action', $('#delete-user-form').attr('action').replace(':userId', userId));
        $('#delete-user-form').submit();
    }
}
</script>    

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

@endsection
