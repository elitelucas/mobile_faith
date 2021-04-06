<?php

namespace App\Http\Controllers\API;

use App\User;
use Validator, Exception;
use App\Http\Controllers\Controller;
use DateTime;
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

            return response()->json(['result' => true, 'data' => $user]);
        } else {
            return response()->json(['result' => false, 'message'  => 'Email or password is incorrect']);
        }
    }

    public function register(Request $request)
    {
        if (User::where('email', $request->email)->first())
            return response()->json(['result' => false, 'message' =>  'Email already exists']);

        $data = $request->all();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->json(['result' => true, 'data' => $user]);
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
                return response()->json(['result' => true, 'data' => $user]);
            } catch (Exception $e) {
                return response()->json(['result' => false, 'message' => $e->getMessage()]);
            }
        } else {
            return response()->json(['result' => false, 'message' => 'No user']);
        }
    }

    public function facebookLogin(Request $request)
    {
        $data = $request->all();

        if ($user = User::where('fbID', $request->fbID)->first()) {
            $user->update($data);
            return response()->json(['result' => true, 'data' => $user]);
        }
        if ($user = User::where('email', $request->email)->first()) {
            $user->update($data);
            return response()->json(['result' => true, 'data' => $user]);
        }

        $user = User::create($data);
        return response()->json(['result' => true, 'data' => $user]);
    }

    public function googleLogin(Request $request)
    {
        $data = $request->all();

        if ($user = User::where('googleID', $request->googleID)->first()) {
            $user->update($data);
            return response()->json(['result' => true, 'data' => $user]);
        }
        if ($user = User::where('email', $request->email)->first()) {
            $user->update($data);
            return response()->json(['result' => true, 'data' => $user]);
        }

        $user = User::create($data);
        return response()->json(['result' => true, 'data' => $user]);
    }

    public function appleLogin(Request $request)
    {
        $data = $request->all();

        if ($user = User::where('appleID', $request->appleID)->first()) {
            $user->update($data);
            return response()->json(['result' => true, 'data' => $user]);
        }
        if ($user = User::where('email', $request->email)->first()) {
            $user->update($data);
            return response()->json(['result' => true, 'data' => $user]);
        }

        $user = User::create($data);
        return response()->json(['result' => true, 'data' => $user]);
    }
}
