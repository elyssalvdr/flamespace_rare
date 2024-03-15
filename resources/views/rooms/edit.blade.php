@foreach ($rooms as $room)
    <div id="editRoomModal{{ $room->id }}" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('rooms.update', $room->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">                        
                        <h4 class="modal-title">Edit Room</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">                    
                        <div class="form-group">
                            <label>Room Number</label>
                            <input type="text" name="name" class="form-control" value="{{ $room->room_number }}" required>
                        </div>
                        <div class="form-group">
                            <label>Building</label>
                            <input type="text" name="email" class="form-control" value="{{ $room->building }}" required>
                        </div>
                        <div class="form-group">
                          <label >Capacity</label>
                          <input type="number" name="capacity" class="form-control" value="{{ $room->capacity }}" required>
                        </div>
                        <div class="form-group">
                          <label >Status</label>
                          <input type="enum" name="status" class="form-control" value="{{ $room->status }}" required>
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
@endforeach