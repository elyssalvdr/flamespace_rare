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
                        <h2>Manage <b>Schedules</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-danger" onclick="deleteSelectedSchedules()"><i class="material-icons">&#xE15C;</i> <span>Delete Selected Schedules</span></button>                        
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Room Number</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                    <tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" class="checkbox" id="checkbox{{ $schedule->id }}" name="options[]" value="{{ $schedule->id }}">
                                <label for="checkbox{{ $schedule->id }}"></label>
                            </span>
                        </td>
                        <td>{{ $schedule->id }}</td>
                        <td>{{ $schedule->user->name }}</td>
                        <td>{{ $schedule->room->room_number }}</td>
                        <td>{{ $schedule->start_time }}</td>
                        <td>{{ $schedule->end_time }}</td>
                        <td>
                            <a href="#editScheduleModal{{ $schedule->id }}" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#" class="delete" onclick="confirmDelete('{{ $schedule->id }}')"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>                  
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $schedules->links() }} 
            </div>
        </div>
    </div>        
</div>


@include('schedules.edit', ['schedule' => $schedule])


<!-- Delete -->
<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="delete-schedule-form" action="{{ route('schedules.destroy', ':scheduleId') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">                        
                    <h4 class="modal-title">Delete Schedule</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <p id="delete-warning-message">Are you sure you want to delete these schedules?</p>
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

function deleteSelectedSchedules() {
    var selectedSchedules = [];
    $(".checkbox:checked").each(function() {
        selectedSchedules.push($(this).val());
    });

    if (selectedSchedules.length === 0) {
        alert("Please select at least one schedule to delete.");
        return;
    }

    $('#deleteEmployeeModal').modal('show');

    $('#delete-schedule-form').attr('action', function() {
        var actionUrl = $(this).attr('action');
        return actionUrl + '?ids=' + selectedSchedules.join(',');
    });
}

function confirmDelete(scheduleId) {
    $('#deleteEmployeeModal').modal('show');
    $('#delete-schedule-form').attr('action', function() {
        return $(this).attr('action').replace(':scheduleId', scheduleId);
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
