<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->save();
        return response()->json(["token" => $user->createToken('api')->plainTextToken]);
    }
    public function login(AuthUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json(['token' => $user->createToken('api')->plainTextToken]);
        } else {
            return response()->json(['errors' => ["password" => ["Неверный логин или пароль"]]]);
        }
    }
}
