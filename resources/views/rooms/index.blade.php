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
                        <h2>Manage <b>Rooms</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <button href="#addRoomModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Room</span></button>
                        <button class="btn btn-danger" onclick="deleteSelectedRooms()"><i class="material-icons">&#xE15C;</i> <span>Delete</span></button>                        
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
                        <th class="table-column">Room Number</th>
                        <th class="table-column">Building</th>
                        <th class="table-column">Capacity</th>
                        <th class="table-column">Status</th>
                        <th class="table-column">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                    <tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" class="checkbox" id="checkbox{{ $room->id }}" name="options[]" value="{{ $room->id }}">
                                <label for="checkbox{{ $room->id }}"></label>
                            </span>
                        </td>
                        <td>{{ $room->id }}</td>
                        <td>{{ $room->room_number }}</td>
                        <td>{{ $room->building }}</td>
                        <td>{{ $room->capacity }}</td>
                        <td>{{ $room->status }}</td>
                        <td>
                            <a href="#" class="edit" data-toggle="modal" data-target="#editRoomModal{{ $room->id }}"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#" class="delete" onclick="confirmDelete('{{ $room->id }}')"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $rooms->links() }} 
            </div>
        </div>
    </div>        
</div>

@include('rooms.create')

@include('rooms.edit', ['room' => $room]) 

<!-- Delete -->
<div id="deleteRoomModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="delete-room-form" action="{{ route('rooms.destroy', ':roomId') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">                        
                    <h4 class="modal-title">Delete Room</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <p id="delete-warning-message">Are you sure you want to delete these rooms?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

function deleteSelectedRooms() {
    var selectedRooms = [];
    $(".checkbox:checked").each(function() {
        selectedRooms.push($(this).val());
    });

    if (selectedRooms.length === 0) {
        alert("Please select at least one room to delete.");
        return;
    }

    $('#deleteRoomModal').modal('show');

    $('#delete-room-form').attr('action', function() {
        var actionUrl = $(this).attr('action');
        return actionUrl + '?ids=' + selectedRooms.join(',');
    });
}

function confirmDelete(roomId) {
    $('#deleteRoomModal').modal('show');
    $('#delete-room-form').attr('action', function() {
        return $(this).attr('action').replace(':roomId', roomId);
    });
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
