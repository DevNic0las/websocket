<?php

use App\Events\MessagePublic;
use App\Events\testeLog;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotifiyController;
use App\Http\Controllers\UserController;
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
  Route::get('/chat', [UserController::class, 'index'])->name('message.all');


  Route::post('/sendInvite', [InviteController::class, 'inviteFriend'])->name("friend.invite");

  Route::get('/friend', function () {
    return Inertia::render('InviteFriend');
  })->name('show.InviteFriend');

  Route::get('/friend/pedingInvite', [InviteController::class, 'peding'])->name('peding');

  Route::get('/friend/sentInvite', [InviteController::class, 'sentInvite'])->name('sent');

  Route::post('/friend/accept/{name}', [InviteController::class, 'acceptedFriend'])->name('accepted');

  Route::post('/sendMessage', [MessageController::class, 'sendMessagePrivate'])->name('message');

  Route::post('/sendMessageAll', function (Request $request) {
    broadcast(new MessagePublic($request->user()->name . " : " . $request->input('message')));
    return 'sucess';
  })->name('messageall');

  Route::get('/chat/{name}', [MessageController::class, "showConversasion"])->name('message.show');
 
  Route::post('/typing', [MessageController::class, "typing"])->name('message.typing');

  Route::get('/notify', [NotifiyController::class, 'index'])->name('notify.all');

});
Route::get('/teste', function (Request $request) {
  $user = User::find(2)->load('sentFriendRequests');

  return response()->json($user);
});
require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
