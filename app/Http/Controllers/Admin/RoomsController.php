<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateRoomsRequest;
use App\Http\Requests\StoreRoomsRequest;
use validator;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('rooms.index', [
            'rooms' => Rooms::latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomsRequest $request): RedirectResponse
    {
        Rooms::create($request->all());
        return redirect()->route('rooms.index')
            ->withSuccess('New room is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rooms $rooms): View
    {
        return view('rooms.show', [
            'rooms' => $rooms
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rooms $rooms): View
    {
        return view('rooms.edit', [
            'rooms' => $rooms
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomsRequest $request, Rooms $rooms): RedirectResponse
    {
        $rooms->update($request->all());
        return redirect()->back()
            ->withSuccess('Room is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rooms $rooms): RedirectResponse
    {
        $rooms->delete();
        return redirect()->route('rooms.index')
            ->withSuccess('Room is deleted successfully.');
    }
}