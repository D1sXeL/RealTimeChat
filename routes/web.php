<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/chat', [App\Http\Controllers\Chat\ChatController::class, 'index'])->name('chat');

Route::post('send-message', [App\Http\Controllers\Chat\SaveMessageController::class, 'index'])->name('send.message');

// Route::get('get-data', [App\Http\Controllers\Chat\ChatController::class, 'getData'])->name('getData');
Route::get('get-data', function () {
    return App\Models\ChatMessage::get();
})->name('get.data');

Route::post('auth-name', [App\Http\Controllers\Chat\ChatController::class, 'update'])->name('auth.name');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
