<?php

use Illuminate\Support\Facades\Route;
use App\Weather;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\TagController;
use GuzzleHttp\Middleware;

app()->singleton('App\Weather', function ($app) {
    return new Weather('db18eec2f8e5f853b874c63ce27540b1', 'Swansea');
});

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::redirect('/', '/posts');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('users', [UserController::class, 'index'])->name('users.index');

Route::get('users/{user}', [UserController::class, 'show'])->name('users.singleuser');

Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::get('posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::post('posts', [PostController::class, 'store'])->name('posts.store');
Route::post('posts/update/{post}', [PostController::class, 'update'])->name('posts.update');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.singlepost');
Route::post('posts/{post}', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');
Route::post('comments/update/{comment}', [CommentController::class, 'update'])->name('comments.update');

Route::get('tags/{tag}', [TagController::class, 'show'])->name('tags.singletag');

Route::get('elections', [ElectionController::class, 'index'])->name('elections.index');
Route::get('elections/{election}/vote', [ElectionController::class, 'vote'])->name('elections.vote')->middleware('auth');
Route::post('elections/{election}/vote', [ElectionController::class, 'store'])->name('elections.store')->middleware('auth');
Route::post('elections/{election}/close', [ElectionController::class, 'close'])->name('elections.close')->middleware('auth');

Route::middleware(['auth','admin'])->group(function () {
    Route::get('admin', [UserController::class, 'adminView'])->name('admin.view');
});


