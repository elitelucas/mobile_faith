<?php

namespace App\Http\Controllers\API;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $user = Auth::user();
            return response()->json(['result' => true, 'data' => $user], 200);
        } else {
            return response()->json(['result' => false, 'message'  => 'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => false, 'message' => $validator->errors()], 400);
        }

        $data = $request->all();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->json(['result' => true, 'data' => $user], 200);
    }

    public function resetPassword(Request $request)
    {
        
    }

    public function updateProfile(Request $request)
    {
        
    }

    public function facebookLogin(Request $request)
    {
        
    }

    public function googleLogin(Request $request)
    {
        
    }

    public function appleLogin(Request $request)
    {
        
    }
}
