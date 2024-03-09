<div id="addUserModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addUserForm" method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="modal-header">                        
                    <h4 class="modal-title">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
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
        // Validate form
        $('#addUserForm').submit(function(e) {
            var password = $('input[name="password"]').val();

            if (password.length < 6) {
                alert('Password must be at least 6 characters long.');
                e.preventDefault();
            }
        });
    });
</script>

