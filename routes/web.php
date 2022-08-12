<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 Route::post('comment/{post}',[CommentController::class,'store'])->name('comment.store');
 Route::get('comments',[CommentController::class,'index'])->name('comment.index');
 Route::delete('comments/{id}',[CommentController::class,'destroy'])->name('comment.destroy');
 Route::get('/blogbyme',[BlogController::class,'blogByAuthor'])->name('blogs.me');
 Route::resource('blogs', BlogController::class);
});

// Route::get('blogs/create', [BlogController::class,'create']);
// Route::post('store/blogs', [BlogController::class, 'store'])->name('store.blog');

Route::get('post/{slug}',[BlogController::class,'post_details'])->name('post.details');
// Route::get('blogs/show/{slug}',[BlogController::class,'show'])->name('blogs.show');
// Route::middleware(['auth'])->group(function () {
//     Route::get('/approval', [App\Http\Controllers\HomeController::class, 'approval'])->name('approval');
//     Route::middleware(['approved'])->group(function () {
//         Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//     });

//     Route::middleware(['admin'])->group(function () {
//         Route::get('/users',  [App\Http\Controllers\UserController::class,'index'])->name('admin.users.index');
//         Route::get('/users/{user_id}/approve',  [App\Http\Controllers\UserController::class,'approve'])->name('admin.users.approve');
//     });
// });
Auth::routes();
