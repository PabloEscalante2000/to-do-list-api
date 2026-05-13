<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponses;
    public function login(LoginRequest $request){
        if(!Auth::attempt($request->only(["email,password"]))){
            return $this->error("Invalid Credentials",401);
        }

        $user = User::firstWhere("email",$request->email);
        return response()->json([
            "token" => $user->createToken(
                "API Token for ". $user->email
            )->plainTextToken
        ]);
                
    }

    public function register(RegisterRequest $request){
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            "token" => $user->createToken(
                "API Token for ". $user->email
            )->plainTextToken
        ]);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return $this->ok("Logged Out");
    }
}
