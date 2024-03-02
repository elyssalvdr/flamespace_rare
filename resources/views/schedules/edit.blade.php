@extends('layouts.app')

@section('content')

<div class="container-xl">
    <div class="card">
        <div class="card-header">
            <h3>Edit Schedule</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="user_id">User ID</label>
                    <input type="text" name="user_id" id="user_id" class="form-control" value="{{ $schedule->user_id }}" required>
                </div>
                <div class="form-group">
                    <label for="room_id">Room ID</label>
                    <input type="text" name="room_id" id="room_id" class="form-control" value="{{ $schedule->room_id }}" required>
                </div>
                <div class="form-group">
                    <label for="start_time">Start Time</label>
                    <input type="datetime-local" name="start_time" id="start_time" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($schedule->start_time)) }}" required>
                </div>
                <div class="form-group">
                    <label for="end_time">End Time</label>
                    <input type="datetime-local" name="end_time" id="end_time" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($schedule->end_time)) }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Schedule</button>
            </form>
        </div>
    </div>
</div>

@endsection
