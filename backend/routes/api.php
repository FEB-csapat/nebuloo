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
    
    Route::put('/me}', [UserController:: class, "update"])
        ->name("users.update");
    Route::delete('me/{id}', [UserController:: class, "destroy"])
        ->name("users.destroy");

    Route::post('me/contents', [ContentController:: class, "store"])
        ->name("contents.store");
    Route::put('me/contents/{id}', [ContentController:: class, "update"])
        ->name("contents.update");
    Route::delete('me/contents/{id}', [ContentController:: class, "destroy"])
        ->name("contents.destroy");

    Route::post('me/questions', [QuestionController:: class, "store"])
        ->name("questions.store");
    Route::put('me/questions/{id}', [QuestionController:: class, "update"])
        ->name("questions.update");
    Route::delete('me/questions/{id}', [QuestionController:: class, "destroy"])
        ->name("questions.destroy");


    Route::post('me/comments', [CommentController:: class, "store"])
        ->name("comments.store");
    Route::put('me/comments/{id}', [CommentController:: class, "update"])
        ->name("comments.update");
    Route::delete('me/comments/{id}', [CommentController:: class, "destroy"])
        ->name("comments.destroy");


    Route::post('me/votes', [VoteController:: class, "store"])
        ->name("votes.store");
    Route::get('me/votes', [VoteController:: class, "view"])
        ->name("votes.view");
    Route::put('me/votes/{id}', [VoteController:: class, "update"])
        ->name("votes.update");
    Route::delete('me/votes/{id}', [VoteController:: class, "destroy"])
        ->name("votes.destroy");
});


/*
* API routes for rank
*/
Route::get('/ranks', [RankController:: class, "index"])
    ->name("ranks.index");

Route::get('/ranks/{id}', [RankController:: class, "show"])
    ->name("ranks.show");


Route::group(['middleware' => ['role:admin|moderator']], function () {
    Route::put('moderator/users/{id}', [UserController:: class, "update"])
        ->name("users.update");

    Route::put('moderator/users/{id}/ban', [UserController:: class, "ban"])
        ->name("users.ban");

    Route::put('moderator/contents/{id}', [ContentController:: class, "update"])
        ->name("contents.update");
    Route::delete('moderator/contents/{id}', [ContentController:: class, "destroy"])
        ->name("contents.destroy");

    Route::put('moderator/questions/{id}', [QuestionController:: class, "update"])
        ->name("questions.update");
    Route::delete('moderator/questions/{id}', [QuestionController:: class, "destroy"])
        ->name("questions.destroy");

    Route::put('moderator/comments/{id}', [CommentController:: class, "update"])
        ->name("comments.update");
    Route::delete('moderator/comments/{id}', [CommentController:: class, "destroy"])
        ->name("comments.destroy");
});


Route::group(['middleware' => ['role:admin']], function () {
    
    Route::put('admin/users/{id}', [UserController:: class, "update"])
        ->name("users.update");
    Route::delete('admin/users/{id}', [UserController:: class, "destroy"])
        ->name("users.destroy");

    Route::put('admin/users/{id}/ban', [UserController:: class, "ban"])
        ->name("users.ban");

    Route::put('admin/contents/{id}', [ContentController:: class, "update"])
        ->name("contents.update");
    Route::delete('admin/contents/{id}', [ContentController:: class, "destroy"])
        ->name("contents.destroy");

    Route::put('admin/questions/{id}', [QuestionController:: class, "update"])
        ->name("questions.update");
    Route::delete('admin/questions/{id}', [QuestionController:: class, "destroy"])
        ->name("questions.destroy");


    Route::put('admin/comments/{id}', [CommentController:: class, "update"])
        ->name("comments.update");
    Route::delete('admin/comments/{id}', [CommentController:: class, "destroy"])
        ->name("comments.destroy");

});
    