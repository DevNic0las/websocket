<?php

namespace App\Http\Controllers;

use App\Events\MessagePrivate;
use App\Events\typingMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function sendMessagePrivate(Request $request)
    {
        $message = $request->input('message');
        $idDestiny = $request->input('idSendMessage');
        Broadcast(new MessagePrivate($idDestiny, $request->user()->name . " : " .   $message, Auth::id()));
    }
    public function showConversasion(string $name)
    {
        $query = User::where("name", $name)->firstorFail();
        return Inertia::render("ChatPrivate", ['userDestiny' => $query]);
    }
    public function typing(Request $request)
    {

        $toId = $request->input("idSendMessage");
        $typing =  $request->user()->name . " está digitando";
        Broadcast(new typingMessage($typing, $toId));
    }
}
