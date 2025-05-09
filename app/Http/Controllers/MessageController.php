<?php

namespace App\Http\Controllers;

use App\Events\MessagePrivate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;

class MessageController extends Controller
{
public function sendMessagePrivate(Request $request){
$message = $request->input('message');
Broadcast(new MessagePrivate(2, $message, 1));

}
}
