<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/login/{provider}', [AuthController:: class, "redirectToProvider"]);
Route::get('/login/{provider}/callback', [AuthController:: class, "handleProviderCallback"]);


Route::get('/users', [UserController:: class, "index"])
    ->name("users.index");
Route::get('/users/{id}', [UserController:: class, "show"])
    ->name("users.show");

Route::get('/contents', [ContentController:: class, "index"])
    ->name("contents.index");
Route::get('/contents/{id}', [ContentController:: class, "show"])
    ->name("contents.show");

    
Route::get('/questions', [QuestionController:: class, "index"])
    ->name("questions.index");
Route::get('/questions/{id}', [QuestionController:: class, "show"])
    ->name("questions.show");

Route::get('/comments', [CommentController:: class, "index"])
    ->name("comments.index");
Route::get('/comments/{id}', [CommentController:: class, "show"])
    ->name("comments.show");

Route::middleware(['auth:api'])->group(function () {
    
    
    Route::post('/users', [UserController:: class, "store"])
        ->name("users.store");
    Route::put('/users/{id}', [UserController:: class, "update"])
        ->name("users.update");
    Route::delete('/users/{id}', [UserController:: class, "destroy"])
        ->name("users.destroy");

    Route::post('/contents', [ContentController:: class, "store"])
        ->name("contents.store");
    Route::put('/contents/{id}', [ContentController:: class, "update"])
        ->name("contents.update");
    Route::delete('/contents/{id}', [ContentController:: class, "destroy"])
        ->name("contents.destroy");

    Route::post('/questions', [QuestionController:: class, "store"])
        ->name("questions.store");
    Route::put('/questions/{id}', [QuestionController:: class, "update"])
        ->name("questions.update");
    Route::delete('/questions/{id}', [QuestionController:: class, "destroy"])
        ->name("questions.destroy");


    Route::post('/comments', [CommentController:: class, "store"])
        ->name("comments.store");
    Route::put('/comments/{id}', [CommentController:: class, "update"])
        ->name("comments.update");
    Route::delete('/comments/{id}', [CommentController:: class, "destroy"])
        ->name("comments.destroy");


    Route::post('/votes', [VoteController:: class, "store"])
        ->name("votes.store");
    Route::put('/votes/{id}', [VoteController:: class, "update"])
        ->name("votes.update");
    Route::delete('/votes/{id}', [VoteController:: class, "destroy"])
        ->name("votes.destroy");

});


Route::get('/auth', [AuthController:: class, "handleProviderCallback"])
    ->name("ranks.index");

/*
* API routes for rank
*/
Route::get('/ranks', [RankController:: class, "index"])
    ->name("ranks.index");

Route::get('/ranks/{id}', [RankController:: class, "show"])
    ->name("ranks.show");


Route::group(['middleware' => ['role:admin']], function () {
    //
});
    