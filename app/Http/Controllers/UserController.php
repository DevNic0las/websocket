<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(){
    $user = Auth::user();
    $allFriends = $user->friends;
    return Inertia::render('Chat', ['friendsThisUser'=>$allFriends, 'user'=> $user]);
    }
}
