<?php

use App\Events\MessagePublic;
use App\Events\testeLog;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\MessageController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
  return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
  return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get("/teste", function () {
  $evento = new testeLog("usuario 3232");
  echo $evento;
});
Route::middleware(['auth', 'verified'])->group(function () {
  //gets
  Route::get('/chat', function () {
    return Inertia::render('Chat', ['user' => Auth::user(), 'othersUsers' => User::where("id", "!=", Auth::id())->get(['id', 'name'])]);
  })->name("message.all");

  Route::post('/sendInvite', [InviteController::class, 'inviteFriend'])->name("friend.invite");

  Route::get('/friend', function () {
    return Inertia::render('InviteFriend');
  })->name('show.InviteFriend');

  Route::post('/sendMessage', [MessageController::class, 'sendMessagePrivate'])->name('message');

  Route::post('/sendMessageAll', function (Request $request) {
    broadcast(new MessagePublic($request->user()->name . " : " . $request->input('message')));
    return 'sucess';
  })->name('messageall');

  Route::get('/chat/{name}', [MessageController::class, "showConversasion"])->name('message.show');
  Route::post('/typing', [MessageController::class, "typing"])->name('message.typing');
});
require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
