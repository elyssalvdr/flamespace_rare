<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Room;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view('schedules.index', ['schedules' => $schedules]);
    }

    public function create()
    {
        $rooms = Room::all();
        return view('schedules.create', ['rooms' => $rooms]);
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
        $schedule = Schedule::findOrFail($id);
        return view('schedules.show', ['schedule' => $schedule]);
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

    public function destroy($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['error' => 'Schedule not found'], 404);
        }

        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully');
    }
}
