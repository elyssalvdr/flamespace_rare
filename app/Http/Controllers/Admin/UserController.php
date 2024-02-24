<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Retrieve the list of users
        $users = User::all();
        return response()->json($users);
    }

    public function search(Request $request)
    {
        // Implement user search logic based on student number or email
    }

    public function store(Request $request)
    {
        // Implement logic to add a new user
    }

    public function destroy($id)
    {
        // Implement logic to delete a user by ID
    }

    public function update(Request $request, $id)
    {
        // Implement logic to update user details
    }
}
