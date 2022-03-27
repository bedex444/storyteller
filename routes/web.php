<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

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

Route::get('our-stories', [MainController::class, 'stories'])->name('list-stories');

Route::get('/view/{story}', [MainController::class, 'story'])->name('view-story');
Route::post('/view/{story}/comment', [MainController::class, 'comment'])->name('add-comment');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('stories', StoryController::class);
    Route::get('stories/{story}/delete', [StoryController::class, 'destroy'])->name('stories.destroy');
    Route::get('stories/{story}/delete-file/{file}', [StoryController::class, 'remove_file'])->name('stories.remove-file');

    Route::resource('users', UserController::class);
    Route::get('users/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('admins', AdminController::class);
    Route::get('admins/{admin}/delete', [AdminController::class, 'destroy'])->name('admins.destroy');

    Route::resource('comments', CommentController::class)
        ->only(['index', 'show']);
    Route::get('comments/{comment}/delete', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('comments/{comment}/reply', [CommentController::class, 'reply'])->name('comments.reply');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});
