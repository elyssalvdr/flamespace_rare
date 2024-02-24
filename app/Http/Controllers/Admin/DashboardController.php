<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\Schedules;

class DashboardController extends Controller
{
    public function index()
    {
        $availableRoomsCount = Rooms::where('status', 'available')->count();
        $reservedRoomsCount = Schedules::where('end_time', '>', now())->count();

        return response()->json([
            'available_rooms' => $availableRoomsCount,
            'reserved_rooms' => $reservedRoomsCount,
        ]);
    }
}