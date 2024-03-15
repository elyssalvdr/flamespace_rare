<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::paginate(8);
        return view('rooms.index', compact('rooms'));
    }


    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_number' => 'required|string|unique:rooms,room_number',
            'building' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:available,not available',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $room = Room::create([
            'room_number' => $request->input('room_number'),
            'building' => $request->input('building'),
            'capacity' => $request->input('capacity'),
            'status' => $request->input('status'),
            // 'image' => $request->file('image') ? $request->file('image')->store('room_images', 'public') : null,
        ]);

        return redirect()->route('rooms.index')->with('success', 'Room added successfully');
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.show', ['room' => $room]);
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.edit', ['room' => $room]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'room_number' => [
                'sometimes',
                'required',
                'string',
                Rule::unique('rooms')->ignore($id),
            ],
            'building' => 'sometimes|required|string',
            'capacity' => 'sometimes|required|integer|min:1',
            'status' => 'sometimes|required|in:available,not available',
            //'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $room = Room::find($id);

        if (!$room) {
            return response()->json(['error' => 'Room not found'], 404);
        }

        if ($request->has('room_number')) {
            $room->room_number = $request->input('room_number');
        }

        if ($request->has('building')) {
            $room->building = $request->input('building');
        }

        if ($request->has('capacity')) {
            $room->capacity = $request->input('capacity');
        }

        if ($request->has('status')) {
            $room->status = $request->input('status');
        }

        // if ($request->hasFile('image')) {
        //     $room->image = $request->file('image')->store('room_images', 'public');
        // }

        $room->save();

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully');
    }


    public function destroy($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json(['error' => 'Room not found'], 404);
        }

        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully');
    }
}
