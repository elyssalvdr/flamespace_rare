<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class ScheduleController extends Controller
{
    public function index()
    {
        $users = User::all();
        $rooms = Room::where('capacity', '>=', 1)->where('capacity', '<=', 200)->get();
        $schedules = Schedule::paginate(8);
        return view('schedules.index', ['schedules' => $schedules, 'users' => $users, 'rooms' => $rooms]);
    }

    public function create()
    {
        $users = User::all();
        $rooms = Room::where('capacity', '>=', 1)->where('capacity', '<=', 200)->get();
        return view('schedules.create', ['users' => $users, 'rooms' => $rooms]);
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

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully');
    }

    public function show($id)
    {
        // Retrieve the schedule with the given ID
        $schedule = Schedule::findOrFail($id);

        // Retrieve user's name and room number associated with the schedule
        $userName = $schedule->user->name;
        $roomNumber = $schedule->room->room_number;

        // Pass the schedule, user name, and room number to the view
        return view('schedules.show', compact('schedule', 'userName', 'roomNumber'));
    }
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $rooms = Room::all();
        return view('schedules.edit', ['schedule' => $schedule, 'rooms' => $rooms]);
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

        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully');
    }

    public function destroy(Request $request)
    {
        $scheduleIds = explode(',', $request->input('ids'));

        foreach ($scheduleIds as $scheduleId) {
            $schedule = Schedule::find($scheduleId);

            if ($schedule) {
                $schedule->delete();
            } else {
                Log::error('Schedule with ID ' . $scheduleId . ' not found');

                return response()->json(['error' => 'Schedule not found'], 404);
            }
        }

        return redirect()->back()->with('success', 'Schedules deleted successfully');
    }

}