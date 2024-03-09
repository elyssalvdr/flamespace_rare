<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class FullCalendarController extends Controller
{
    public function calendar()
    {
        $schedules = Schedule::all();

        $events = [];
        foreach ($schedules as $schedule) {
            $events[] = [
                'title' => $schedule->user->name . ' - Room ' . $schedule->room->room_number,
                'start' => $schedule->start_time->toDateTimeString(), 
                'end' => $schedule->end_time->toDateTimeString(),
            ];
        }

        $data = [
            'events' => $events
        ];

        return view('calendar.index', $data);
    }

    public function getEvents(Request $request)
    {
        $schedules = Schedule::all();

        $events = [];
        foreach ($schedules as $schedule) {
            $events[] = [
                'title' => $schedule->user->name . ' - Room ' . $schedule->room->room_number,
                'start' => $schedule->start_time->toDateTimeString(),
                'end' => $schedule->end_time->toDateTimeString(),
            ];
        }

        return response()->json($events);
    }
}
