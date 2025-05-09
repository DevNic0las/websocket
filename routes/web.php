<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('chat', function(){
    return Inertia::render('Chat', ['user'=>Auth::user()]);
});
Route::post('/sendMessage',[MessageController::class ,'sendMessagePrivate'] )->name('message');
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
