<?php

namespace App\Http\Controllers\Admin;

use App\Models\Calendar;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Requests\StoreCalendarRequest;
use App\Http\Requests\UpdateCalendarRequest;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function calendar()
    {

        //not final pa
        $events = [];

        $start_dates = ['2023-06-01', '2023-06-07', '2023-06-11', '2023-06-12T10:30:00', '2023-06-12', '2023-06-12', '2023-06-13', '2023-06-28'];
        $end_date = ['', '2023-06-10', '2023-06-13', '2023-06-12T12:30:00', '2023-06-12T12:00:00', '2023-06-12T14:30:00', '2023-06-13T07:00:00', ''];

        $titles = ['All Day Event', 'Long Event', 'Conference', 'Meeting', 'Lunch', 'Meeting', 'Birthday Party', 'Click for Google'];
        $links = ['', '', '', '', '', '', '', 'https://www.google.com/'];

        foreach ($titles as $key => $title) {
            $events[] = [
                'title' => $title,
                'start' => $start_dates[$key],
                'end' => $end_date[$key],
                'url' => $links[$key],
            ];
        }

        $data = [
            'events' => $events
        ];

        return view('admin.calendar', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCalendarRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Calendar $calendar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calendar $calendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCalendarRequest $request, Calendar $calendar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calendar $calendar)
    {
        //
    }
}
