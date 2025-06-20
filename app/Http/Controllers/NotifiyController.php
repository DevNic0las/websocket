<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class NotifiyController extends Controller
{
  public function index(){
 $query = DB::table('notifications')->where('notifiable_id', Auth::id())->get('data');
    return Inertia::render('Notifications', ['notify'=>$query]);
  }
}
