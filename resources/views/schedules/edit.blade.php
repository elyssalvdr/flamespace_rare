<!-- edit -->
<div id="editScheduleModal{{ $schedule->id }}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('schedules.update', $schedule->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">                        
                    <h4 class="modal-title">Edit Schedule</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <div class="form-group">
                        <label>User</label>
                        <select name="user_id" class="form-control" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $schedule->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Room</label>
                        <select name="room_id" class="form-control" required>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" {{ $schedule->room_id == $room->id ? 'selected' : '' }}>{{ $room->room_number }} - {{ $room->building }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Start Time</label>
                        <input type="datetime-local" name="start_time" class="form-control" value="{{ $schedule->start_time }}" required>
                    </div>
                    <div class="form-group">
                        <label>End Time</label>
                        <input type="datetime-local" name="end_time" class="form-control" value="{{ $schedule->end_time }}" required>
                    </div>               
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
