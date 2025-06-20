<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;
use App\Notifications\FriendRequestNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use PhpParser\Node\Expr\Cast\String_;

class InviteController extends Controller
{
    public function inviteFriend(Request $request)
    {
        $data = $request->validate([
            'friendName' => 'required|exists:users,name'
        ]);
        $friend = User::where('name', $data['friendName'])->first();
        if (!$friend) {
            return back()->withErrors(['friendName' => 'Usuário não encontrado.']);
        }
        $requestToFriend = $request->user()->sentFriendRequests()->attach($friend->id, ['status' => 'pending']);
        $friend->notify(new FriendRequestNotification(Auth::user()));
    }
    public function peding()
    {
        $user = Auth::user();
        $receivedFriendRequests = $user->receivedFriendRequests;
        return Inertia::render('InviteFriend', ['receivedFriendRequests' => $receivedFriendRequests]);
    }

    public function sentInvite()
    {
        $user = Auth::user();
        $sentInvite = $user->sentFriendRequests;
        return Inertia::render('InviteFriend', ['sentFriendRequests' => $sentInvite]);
    }


    public function acceptedFriend(String $name, Request $request)
    {
        $userName = User::where("name", $name)->first();
        if (!$userName) {
            return response()->json(['message' => 'error']);
        }
        $request->user()->sentFriendRequests()->attach($userName->id, ['status'=> 'accepted']);
        DB::table('friend_user')
            ->where('user_id', $userName->id)
            ->update(['status' => 'accepted']);
    }
}
