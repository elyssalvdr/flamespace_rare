<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function index()
    {
        // Retrieve the list of schedules
        $schedules = Schedule::all();
        return response()->json($schedules);
    }

    public function filterByRoom($room)
    {
        $schedules = Schedule::whereHas('room', function ($query) use ($room) {
            $query->where('room_number', $room);
        })->get();

        return response()->json($schedules);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $schedule = Schedule::create([
            'user_id' => $request->input('user_id'),
            'room_id' => $request->input('room_id'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);

        return response()->json(['message' => 'Schedule created successfully', 'schedule' => $schedule]);
    }

    public function show($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['error' => 'Schedule not found'], 404);
        }

        // Retrieve user's name and room number associated with the schedule
        $userName = $schedule->user->name;
        $roomNumber = $schedule->room->room_number;

        return response()->json($schedule);
    }

    public function destroy($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['error' => 'Schedule not found'], 404);
        }

        $schedule->delete();

        return response()->json(['message' => 'Schedule deleted successfully']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['error' => 'Schedule not found'], 404);
        }

        $schedule->user_id = $request->input('user_id');
        $schedule->room_id = $request->input('room_id');
        $schedule->start_time = $request->input('start_time');
        $schedule->end_time = $request->input('end_time');

        $schedule->save();

        return response()->json(['message' => 'Schedule updated successfully', 'schedule' => $schedule]);
    }

    public function getUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function getRooms()
    {
        $rooms = Room::where('capacity', '>=', 1)->where('capacity', '<=', 200)->get();
        return response()->json($rooms);
    }
}