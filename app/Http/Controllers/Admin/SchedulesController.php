<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Models\Schedules;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreSchedulesRequest;
use App\Http\Requests\UpdateSchedulesRequest;


class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.schedules.index', [
            'schedules' => Schedules::latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchedulesRequest $request): RedirectResponse
    {
        Schedules::create($request->all());
        return redirect()->route('admin.schedules.index')
            ->withSuccess('New schedule is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedules $schedules): View
    {
        return view('admin.schedules.show', [
            'schedules' => $schedules
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedules $schedules): View
    {
        return view('admin.schedules.edit', [
            'schedules' => $schedules
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchedulesRequest $request, Schedules $schedules): RedirectResponse
    {
        $schedules->update($request->all());
        return redirect()->back()
            ->withSuccess('Schedule is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedules $schedules): RedirectResponse
    {
        $schedules->delete();
        return redirect()->route('admin.schedules.index')
            ->withSuccess('Schedule is deleted successfully.');
    }
}
