<?php

namespace App\Http\Controllers\API;

use App\User;
use Validator, Exception;
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
            $user->deviceToken = $request->deviceToken;
            $user->save();
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
            'deviceToken' => 'required',
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
        if ($user = User::where('id', $request->id)->first()) {
            try {
                foreach ($request->except('id') as $key => $value) {
                    $user->$key = $value;
                }
                $user->save();
                return response()->json(['result' => true, 'data' => $user], 200);
            } catch (Exception $e) {
                return response()->json(['result' => false, 'message' => $e->getMessage()], 500);
            }
        } else {
            return response()->json(['result' => false, 'message' => 'No user'], 400);
        }
    }

    public function facebookLogin(Request $request)
    {
        $data = $request->all();

        if ($user = User::where('fbID', $request->fbID)->first()) {
            $user->update($data);
            return response()->json(['result' => true, 'data' => $user], 200);
        }
        if ($user = User::where('email', $request->email)->first()) {
            $user->update($data);
            return response()->json(['result' => true, 'data' => $user], 200);
        }

        $user = User::create($data);
        return response()->json(['result' => true, 'data' => $user], 200);
    }

    public function googleLogin(Request $request)
    {
        $data = $request->all();

        if ($user = User::where('googleID', $request->googleID)->first()) {
            $user->update($data);
            return response()->json(['result' => true, 'data' => $user], 200);
        }
        if ($user = User::where('email', $request->email)->first()) {
            $user->update($data);
            return response()->json(['result' => true, 'data' => $user], 200);
        }

        $user = User::create($data);
        return response()->json(['result' => true, 'data' => $user], 200);
    }

    public function appleLogin(Request $request)
    {
        $data = $request->all();

        if ($user = User::where('appleID', $request->appleID)->first()) {
            $user->update($data);
            return response()->json(['result' => true, 'data' => $user], 200);
        }
        if ($user = User::where('email', $request->email)->first()) {
            $user->update($data);
            return response()->json(['result' => true, 'data' => $user], 200);
        }

        $user = User::create($data);
        return response()->json(['result' => true, 'data' => $user], 200);
    }
}
