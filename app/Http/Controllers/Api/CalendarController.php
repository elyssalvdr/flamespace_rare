<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class CalendarController extends Controller
{
    public function index()
    {
        // Retrieve all scheds
        $schedules = Schedule::all();

        $events = [];
        foreach ($schedules as $schedule) {
            $events[] = [
                'title' => $schedule->user->name . ' - Room ' . $schedule->room->room_number,
                'start' => $schedule->start_time,
                'end' => $schedule->end_time,
            ];
        }

        return response()->json($events);
    }

    public function filter(Request $request)
    {
        // Validate request parameters
        $request->validate([
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:1900',
        ]);

        // Retrieve schedules based on the filtered month and year
        $schedules = Schedule::whereMonth('start_time', $request->month)
            ->whereYear('start_time', $request->year)
            ->get();

        $events = [];
        foreach ($schedules as $schedule) {
            $events[] = [
                'title' => $schedule->user->name . ' - Room ' . $schedule->room->room_number,
                'start' => $schedule->start_time,
                'end' => $schedule->end_time,
            ];
        }

        return response()->json($events);
    }
}
