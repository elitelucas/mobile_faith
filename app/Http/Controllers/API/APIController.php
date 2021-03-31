<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Background;
use App\Following;
use App\Invite;
use App\Meditate;
use App\Pray;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Validator, Exception;
use App\Http\Controllers\FirebaseController;

class APIController extends Controller
{
    public function addPray(Request $request)
    {
        try {
            $data = $request->all();
            $pray = Pray::create($data);
            return response()->json(['result' => true, 'data' => $pray], 200);
        } catch (Exception $e) {
            return response()->json(['result' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function followPray(Request $request)
    {
        if (Following::where('pray_id', $request->pray_id)->where('user_id', $request->user_id)->delete()) {
            return response()->json(['result' => true, 'data' => null], 200);
        } else {
            try {
                $data = $request->all();
                $following = Following::create($data);
                return response()->json(['result' => true, 'data' => $following], 200);
            } catch (Exception $e) {
                return response()->json(['result' => false, 'message' => $e->getMessage()], 500);
            }
        }
    }

    public function getPray(Request $request)
    {
        $records = [];
        if ($request->type == 'all') {
            $records = Pray::get();
        } else if ($request->type == 'me') {
            $records = Pray::where('user_id', $request->user_id)->get();
        }
        return response()->json(['result' => true, 'data' => $records], 200);
    }


    public function inviteFriend(Request $request)
    {
        try {
            $data = $request->all();
            $obj = Invite::create($data);
            return response()->json(['result' => true, 'data' => $obj], 200);
        } catch (Exception $e) {
            return response()->json(['result' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function invitePray(Request $request)
    {
        if ($invite = Invite::find($request->invite_id)) {
            $invite->pray_time = $request->pray_time;
            $invite->save();
            return response()->json(['result' => true, 'data' => $invite], 200);
        } else {
            return response()->json(['result' => false, 'message' => 'No invite'], 400);
        }
    }

    public function getInvite(Request $request)
    {
        $invites = Invite::where('sender_id', $request->user_id)->orwhere('receiver_id', $request->user_id)->get();
        return response()->json(['result' => true, 'data' => $invites], 200);
    }

    public function getMeditate(Request $request)
    {
        $meditates = Meditate::inRandomOrder()->limit(20)->get();
        return response()->json(['result' => true, 'data' => $meditates], 200);
    }

    public function getBackground(Request $request)
    {
        $backgrounds = Background::inRandomOrder()->limit(10)->get();
        return response()->json(['result' => true, 'data' => $backgrounds], 200);
    }

    public function sendNotification(Request $request)
    {         
        $deviceToken =User::find($request->receiver_id)->deviceToken;
        $title = $request->title;
        $body =  $request->description;
        $data = [
            'type' => 'notification',
        ];

        FirebaseController::sendNotification($deviceToken, $title, $body, $data);

        return response()->json(['result' => true, 'data' => "Notification sent"]);
    }

    public function test(Request $request)
    {
        return response()->json(['result' => true, 'data' => 'Faith API working'], 200);
    }
}
