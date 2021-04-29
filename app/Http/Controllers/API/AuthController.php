<?php

namespace App\Http\Controllers\API;

use App\User;
use Validator, Exception, Str, Mail, Log;
use App\Http\Controllers\Controller;
use DateTime, DB, Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Mail\PasswordResetMail;

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
            if ($user->is_active) {
                $user->deviceToken = $request->deviceToken;
                $user->save();

                return response()->json(['result' => true, 'data' => $user]);
            } else {
                return response()->json(['result' => false, 'message'  => 'User is blocked']);
            }
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
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['result' => false, 'message' =>  'User does not exist']);
        }

        $token = Str::random(60);
        DB::table('password_resets')->where([
            'email' => $request->email,
        ])->delete();
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' =>  $token,
            'created_at' => Carbon::now()
        ]);

        //SendEmail
        try {
            Mail::to($request->email)->queue(new PasswordResetMail($token));
            return response()->json(['result' => true, 'data' => 'Reset Password Email Sent']);
        } catch (Exception $e) {
            return response()->json(['result' => false, 'message' =>  $e->getMessage()]);
        }
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

        if (($request->fbID && $user = User::where('fbID', $request->fbID)->first()) ||
            ($request->email && $user = User::where('email', $request->email)->first())
        ) {
            $user->deviceToken = $request->deviceToken;
            $user->save();
            return response()->json(['result' => true, 'data' => $user]);
        }

        $user = User::create($data);
        return response()->json(['result' => true, 'data' => $user]);
    }

    public function googleLogin(Request $request)
    {
        $data = $request->all();

        if (($request->googleID && $user = User::where('googleID', $request->googleID)->first()) ||
            ($request->email && $user = User::where('email', $request->email)->first())
        ) {
            $user->deviceToken = $request->deviceToken;
            $user->save();
            return response()->json(['result' => true, 'data' => $user]);
        }

        $user = User::create($data);
        return response()->json(['result' => true, 'data' => $user]);
    }

    public function appleLogin(Request $request)
    {
        $data = $request->all();

        if (($request->appleID && $user = User::where('appleID', $request->appleID)->first()) ||
            ($request->email && $user = User::where('email', $request->email)->first())
        ) {
            $user->deviceToken = $request->deviceToken;
            $user->save();
            return response()->json(['result' => true, 'data' => $user]);
        }

        $user = User::create($data);
        return response()->json(['result' => true, 'data' => $user]);
    }
}
