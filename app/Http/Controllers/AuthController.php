<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register a user
    public function register(Request $request){
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
        ]);
    

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $token = JWTAuth::fromUser($user);

    return response()->json(['user' => $user, 'token' => $token],201);
    }

    //Login
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json(['error' => 'unauthorized']);
        }
        $user = auth()->user();
        $user->status = 1;
        $user->save();
        return response()->json(['token' => $token]);
    }

    //for status
    public function updateStatus(Request $request){
        $user = auth()->user();
        $request->validate([
            'status' => 'required|boolean'
        ]);
        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'status updated successfully']);
    }

    //Get User Details
    public function profile(){
        return response()->json(auth()->user());
    }

    //Logout User
    public function logout(){
        $user = auth()->user();
        $user->status = 0;
        $user->save();
        auth()->logout();
        return response()->json(['message' => "Successfully Logout"]);
    }

    //Refresh the token
    public function refresh(){
        return response()->json([
            'token' => auth()->refresh()
        ]);
    }

}
