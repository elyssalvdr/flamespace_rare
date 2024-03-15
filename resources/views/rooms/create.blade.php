<div id="addRoomModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addRoomForm" method="POST" action="{{ route('rooms.store') }}">
                @csrf
                <div class="modal-header">                        
                    <h4 class="modal-title">Add Room</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <div class="form-group">
                        <label>Room Number</label>
                        <input type="text" name="room_number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Building</label>
                        <select name="building" class="form-control" required>
                            <option value="">Select Building</option>
                            <option value="Building 1">BE Building</option>
                            <option value="Building 2">CAHS Building</option>
                            <option value="Building 3">CAS Building</option>
                            <option value="Building 4">CMA Building</option>
                            <option value="Building 5">MBA Building</option>
                            <option value="Building 6">NH Building</option>
                            <option value="Building 7">PTC Building</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Capacity</label>
                        <input type="number" name="capacity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="available">Available</option>
                            <option value="not available">Not Available</option>
                        </select>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Validate form
        document.getElementById('addRoomForm').addEventListener('submit', function(e) {
            var capacity = parseInt(document.querySelector('input[name="capacity"]').value);
            if (capacity < 1) {
                alert('Capacity must be 1 or more.');
                e.preventDefault();
            }
        });
    });
</script>


