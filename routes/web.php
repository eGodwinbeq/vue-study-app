<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [ItemsController::class, 'index'])->name('items');
Route::get('/items', [ItemsController::class, 'index'])->name('items.index');
Route::get('/create-item', [ItemsController::class, 'create'])->name('items.create');
Route::post('/item-store', [ItemsController::class, 'store'])->name('items.store');


Route::get('/users', [UsersController::class, 'index'])->name('users.index');


Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::put('/settings-update', [SettingsController::class, 'update'])->name('settings-update');


//Mini-Forum
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::delete('/comments/{commentId}', [CommentsController::class, 'destroy'])->name('comments.delete');

// Guest book
Route::get('/guestbook', [GuestBookController::class, 'index'])->name('guestbook.index');
Route::post('/guestbook', [GuestBookController::class, 'store'])->name('guestbook.store');
