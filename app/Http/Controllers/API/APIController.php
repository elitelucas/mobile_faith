<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Background;
use App\FavoriteVerse;
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
            return response()->json(['result' => true, 'data' => $pray]);
        } catch (Exception $e) {
            return response()->json(['result' => false, 'message' => $e->getMessage()]);
        }
    }

    public function followPray(Request $request)
    {
        if (Following::where('pray_id', $request->pray_id)->where('user_id', $request->user_id)->delete()) {
            return response()->json(['result' => true, 'data' => null]);
        } else {
            try {
                $data = $request->all();
                $following = Following::create($data);
                return response()->json(['result' => true, 'data' => $following]);
            } catch (Exception $e) {
                return response()->json(['result' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function getPray(Request $request)
    {
        $records = [];
        if ($request->type == 'all') {
            $friends = [$request->user_id];
            $friends = array_merge($friends, Invite::where('sender_id', $request->user_id)->pluck('receiver_id')->toArray());
            $friends = array_merge($friends, Invite::where('receiver_id', $request->user_id)->pluck('sender_id')->toArray());

            $records = Pray::wherein('user_id', $friends)->get();
        } else if ($request->type == 'me') {
            $records = Pray::where('user_id', $request->user_id)->get();
        }
        return response()->json(['result' => true, 'data' => $records]);
    }


    public function inviteFriend(Request $request)
    {
        if ($invite = Invite::where('sender_id', $request->sender_id)->where('receiver_id', $request->receiver_id)->first() ||
            $invite = Invite::where('sender_id', $request->receiver_id)->where('receiver_id', $request->sender_id)->first()
        ) {
            return response()->json(['result' => false, 'message' => 'already exist']);
        }
        try {
            $data = $request->all();
            $invite = Invite::create($data);
            return response()->json(['result' => true, 'data' => $invite]);
        } catch (Exception $e) {
            return response()->json(['result' => false, 'message' => $e->getMessage()]);
        }
    }

    public function invitePray(Request $request)
    {
        if ($invite = Invite::find($request->invite_id)) {
            $invite->update([
                'pray_time' => $request->pray_time,
                'invitor_id' => $request->user_id,
            ]);

            //send notification
            if ($request->user_id == $invite->sender_id) {
                $friend = User::find($invite->receiver_id);
            } else {
                $friend = User::find($invite->sender_id);
            }
            $deviceToken =  $friend->deviceToken;
            $title = $request->title;
            $body =  $request->message;
            $data = [
                'type' => 'notification',
            ];
            FirebaseController::sendNotification($deviceToken, $title, $body, $data);

            return response()->json(['result' => true, 'data' => $invite]);
        } else {
            return response()->json(['result' => false, 'message' => 'No invite']);
        }
    }

    public function getInvite(Request $request)
    {
        $invites = Invite::where('sender_id', $request->user_id)->orwhere('receiver_id', $request->user_id)->get();
        foreach ($invites as $invite) {
            if ($invite->sender_id == $request->user_id) {
                $invite->user = User::where('id', $invite->receiver_id)->first();
            } else {
                $invite->user = User::where('id', $invite->sender_id)->first();
            }
        }
        return response()->json(['result' => true, 'data' => $invites]);
    }

    public function getMeditate(Request $request)
    {
        $meditates = Meditate::inRandomOrder()->limit(20)->get();
        return response()->json(['result' => true, 'data' => $meditates]);
    }

    public function getBackground(Request $request)
    {
        $backgrounds = Background::inRandomOrder()->limit(5)->get();
        return response()->json(['result' => true, 'data' => $backgrounds]);
    }

    public function sendNotification(Request $request)
    {
        $receiver = User::find($request->receiver_id);
        if (!$receiver)  return response()->json(['result' => false, 'message' => "No user"]);
        $deviceToken =  $receiver->deviceToken;
        $title = $request->title;
        $body =  $request->description;
        $data = [
            'type' => 'notification',
        ];

        FirebaseController::sendNotification($deviceToken, $title, $body, $data);

        return response()->json(['result' => true, 'data' => "Notification sent"]);
    }

    public function addFavoriteVerse(Request $request)
    {
        try {
            $data = $request->all();
            $obj = FavoriteVerse::create($data);
            return response()->json(['result' => true, 'data' => $obj]);
        } catch (Exception $e) {
            return response()->json(['result' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteFavoriteVerse(Request $request)
    {
        if ($verse = FavoriteVerse::where('id', $request->verse_id)->where('user_id', $request->user_id)->first()) {
            $verse->delete();
            return response()->json(['result' => true, 'data' => 'Deleted successfully']);
        } else {
            return response()->json(['result' => false, 'message' => 'No verse']);
        }
    }

    public function getFavoriteVerse(Request $request)

    {
        $verses = FavoriteVerse::where('user_id', $request->user_id)->get();
        return response()->json(['result' => true, 'data' =>   $verses]);
    }

    public function makePayment(Request $request)
    {
        $user = User::find($request->user_id);
        if (!$user) return response()->json(['result' => false, 'message' => 'No user']);

        $user->paid = true;
        $user->save();
        return response()->json(['result' => true, 'data' =>   $user]);
    }

    public function getOneInvite(Request $request)
    {
        $user_id = $request->user_id;
        $one_invite = Invite::where(function ($query)  use ($user_id) {
            $query->where('sender_id', $user_id)
                ->orWhere('receiver_id', $user_id);
        })->where('invitor_id', '!=', $user_id)->inRandomOrder()->first();
        if ($one_invite) {
            $one_invite->user = User::select('id', 'name')->find($one_invite->invitor_id);
            return response()->json(['result' => true, 'data' => $one_invite]);
        } else
            return response()->json(['result' => false, 'message' => 'No invite']);
    }

    public function updateInvite(Request $request)
    {
        $invite = Invite::where('id', $request->invite_id)->first();
        if (!$invite) return response()->json(['result' => false, 'message' => 'No invite']);
        $invite->update(['state' => $request->state]);
        return response()->json(['result' => true, 'data' =>   $invite]);
    }

    public function test(Request $request)
    {
        return response()->json(['result' => true, 'data' => 'Faith API working']);
    }
}
