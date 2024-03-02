<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class CalendarController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();

        $events = [];
        foreach ($schedules as $schedule) {
            $events[] = [
                'title' => $schedule->user->name . ' - Room ' . $schedule->room->room_number,
                'start' => $schedule->start_time,
                'end' => $schedule->end_time,
            ];
        }

        return view('calendar.index', ['events' => $events]);
    }

    public function filter(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:1900',
        ]);

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

        return view('calendar.index', ['events' => $events]);
    }
}
