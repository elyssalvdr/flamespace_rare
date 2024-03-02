<?php

namespace App\Http\Controllers\Admin;

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

        return view('dashboard.index', [
            'available_rooms_count' => $availableRoomsCount,
            'reserved_rooms_count' => $reservedRoomsCount,
            'available_rooms' => $availableRooms,
        ]);
    }
}
