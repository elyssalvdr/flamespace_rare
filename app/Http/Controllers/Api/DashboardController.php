<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $reservedRoomsIds = Schedule::where('end_time', '>', now())->pluck('room_id')->toArray();

        $availableRooms = Room::whereNotIn('id', $reservedRoomsIds)
            ->where('status', 'available')
            ->get();

        $availableRoomsCount = $availableRooms->count();
        $reservedRoomsCount = count($reservedRoomsIds);

        return response()->json([
            'available_rooms' => $availableRoomsCount,
            'reserved_rooms' => $reservedRoomsCount,
            'available_rooms_list' => $availableRooms,
        ]);
    }
}