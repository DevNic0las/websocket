<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;

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
        $request->user()->sentFriendRequests()->attach($friend->id, ['status' => 'pending']);
        
    }
}
