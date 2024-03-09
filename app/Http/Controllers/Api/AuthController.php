<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
        'name'=>'required|min:2|max:100',
        'email'=>'required|email|unique:users',
        'password'=>'required|string|min:6',
        'confirm_password'
    ]);

    if($validator->fails()) {
        return response()->json([
            'message'=>'Validation fails',
            'errors'=>$validator->errors()
        ], 422);
    }

    $user=User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password)

    ]);

    Session::put('admin_name', $user->name);

    return response()->json([
        'message'=>'Registration Successful',
        'data'=>$user
    ], 200);
}

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'=>'Validation fails',
                'errors'=>$validator->errors()
            ], 422);
        }

        $user = User::where('email',$request->email)->first();

        if($user){
            if(Hash::check($request->password,$user->password)){

                Session::put('admin_name', $user->name);

                $token=$user->createToken('auth-token')->plainTextToken;
                return response()->json([
                    'message'=>'Login Successfully',
                    'token'=>$token,
                    'data'=>$user
                ], 400);

            }else{
                return response()->json([
                    'message'=>'Incorrect Credentials',
                    'errors'=>$validator->errors()
                ], 400);
            }

        }else{
            return response()->json([
                'message'=>'Incorrect Credentials',
                'errors'=>$validator->errors()
            ], 400);
        }
    }
    public function logout(Request $request){
        $user = Auth::user();
    
        if ($user) {
            $user->tokens()->delete();

            Session::put('admin_name', $user->name);
    
            return response()->json([
                'message' => 'Successfully logged out'
            ], 200);
        } else {
            return response()->json([
                'message' => 'User not authenticated'
            ], 401);
        }
    }
    
}

