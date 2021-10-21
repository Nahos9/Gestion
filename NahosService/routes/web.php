<?php

use App\Http\Controllers\UserController;
use App\Http\Livewire\TypeArticleComp;
use App\Http\Livewire\Utilisateur;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/home', function () {
//     return view('home');
// })->middleware('auth');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    "middleware"=> ["auth","auth.admin"],
    "as"=> "admin."
],function(){
    Route::group([
        "prefix"=> "habillitation",
        "as" => "habillitation."
    ],function(){

        Route::get("/user",Utilisateur::class)->name("user.index");
    });

    Route::group([
        "prefix"=> "gestarticles",
        "as" => "gestarticles."
    ],function(){

        Route::get("/typeArticle",TypeArticleComp::class)->name("typearticles");
    });
    });


// Route::get('/user',[UserController::class,'index'])->name('user')->middleware("auth.admin");
