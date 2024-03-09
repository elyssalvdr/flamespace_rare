<!-- add -->
<div id="addScheduleModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addScheduleForm" method="POST" action="{{ route('schedules.store') }}">
                @csrf
                <div class="modal-header">                        
                    <h4 class="modal-title">Add Schedule</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <div class="form-group">
                        <label>User</label>
                        <select name="user_id" class="form-control" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Room</label>
                        <select name="room_id" class="form-control" required>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->room_number }} - {{ $room->building }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Start Time</label>
                        <input id="start_time" type="datetime-local" name="start_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>End Time</label>
                        <input id="end_time" type="datetime-local" name="end_time" class="form-control" required>
                    </div>            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        // Validate start and end time
        $('#addScheduleForm').submit(function(e) {
            var startTime = new Date($('#start_time').val());
            var endTime = new Date($('#end_time').val());
            var currentTime = new Date();

            if (startTime.getTime() < currentTime.getTime()) {
                alert('Start time must be later than the current time.');
                e.preventDefault();
            }

            if (endTime.getTime() < startTime.getTime()) {
                alert('End time must be later than the start time.');
                e.preventDefault();
            }
        });
    });
</script>
