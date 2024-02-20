<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;
use validator;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Rooms::latest()->get();

        if (is_null($rooms->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No rooms found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Rooms retrieved successfully.',
            'data' => $rooms,
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:250',
            'description' => 'required|string|',
            'capacity' => 'required|string|'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);    
        }

        $rooms = Rooms::create($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Room is added successfully.',
            'data' => $rooms,
        ];

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rooms = Rooms::find($id);

        if (is_null($rooms)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Room is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Room retrieved successfully.',
            'data' => $rooms,
        ];

        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'capacity' => 'required'

        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $rooms = Rooms::find($id);

        if (is_null($rooms)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Room is not found!',
            ], 200);
        }

        $rooms->update($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Rooms updated successfully.',
            'data' => $rooms,
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rooms = Rooms::find($id);

        if (is_null($rooms)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Room is not found!',
            ], 200);
        }

        Rooms::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Room is deleted successfully.'
        ], 200);
    }

    /**
     * Search by a product name
     *
     * @param    $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        $rooms = Rooms::where('name', 'like', '%' . $name . '%')
            ->latest()->get();

        if (is_null($rooms->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No rooms found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Rooms are retrieved successfully.',
            'data' => $rooms,
        ];

        return response()->json($response, 200);
    }
}
