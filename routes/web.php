<?php

use App\Http\Controllers\StoryController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('homepage');

Auth::routes();

ROute::get('stories', [MainController::class, 'stories'])->name('stories');


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('stories', StoryController::class);
    Route::get('stories/{story}/delete', [StoryController::class, 'destroy'])->name('stories.destroy');
    Route::get('stories/{story}/delete-file/{file}', [StoryController::class, 'removeFile'])->name('stories.remove-file');

    Route::resource('users', UserController::class);
    Route::get('users/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('admins', AdminController::class);
    Route::get('admins/{admin}/delete', [AdminController::class, 'destroy'])->name('admins.destroy');

    Route::resource('comments', DestinationCommentController::class)
        ->only(['index', 'show']);
    Route::get('comments/{comment}/delete', [DestinationCommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('comments/{comment}/reply', [DestinationCommentController::class, 'reply'])->name('comments.reply');
});
