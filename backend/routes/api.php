<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
* API routes for rank
*/
Route::get('/ranks', [RankController:: class, "index"])
    ->name("ranks.index");

Route::get('/ranks/{id}', [RankController:: class, "show"])
    ->name("ranks.show");

/*
* API routes for user
*/
Route::get('/users', [UserController:: class, "index"])
    ->name("users.index");

Route::get('/users/{id}', [UserController:: class, "show"])
    ->name("users.show");

Route::post('/users', [UserController:: class, "store"])
    ->name("users.store");

Route::put('/users/{id}', [UserController:: class, "update"])
    ->name("users.update");

Route::delete('/users/{id}', [UserController:: class, "destroy"])
    ->name("users.destroy");

/*
* API routes for content
*/
Route::get('/contents', [ContentController:: class, "index"])
    ->name("contents.index");

Route::get('/contents/{id}', [ContentController:: class, "show"])
    ->name("contents.show");

Route::post('/contents', [ContentController:: class, "store"])
    ->name("contents.store");

Route::put('/contents/{id}', [ContentController:: class, "update"])
    ->name("contents.update");

Route::delete('/contents/{id}', [ContentController:: class, "destroy"])
    ->name("contents.destroy");

/*
* API routes for question
*/
Route::get('/questions', [QuestionController:: class, "index"])
    ->name("questions.index");

Route::get('/questions/{id}', [QuestionController:: class, "show"])
    ->name("questions.show");

Route::post('/questions', [QuestionController:: class, "store"])
    ->name("questions.store");

Route::put('/questions/{id}', [QuestionController:: class, "update"])
    ->name("questions.update");

Route::delete('/questions/{id}', [QuestionController:: class, "destroy"])
    ->name("questions.destroy");

/*
* API routes for comment
*/
Route::get('/comments', [CommentController:: class, "index"])
    ->name("comments.index");

Route::get('/comments/{id}', [CommentController:: class, "show"])
    ->name("comments.show");

Route::post('/comments', [CommentController:: class, "store"])
    ->name("comments.store");

Route::put('/comments/{id}', [CommentController:: class, "update"])
    ->name("comments.update");

Route::delete('/comments/{id}', [CommentController:: class, "destroy"])
    ->name("comments.destroy");


/*
* API routes for comment
*/
Route::post('/votes', [VoteController:: class, "store"])
    ->name("votes.store");

Route::put('/votes/{id}', [VoteController:: class, "update"])
    ->name("votes.update");

Route::delete('/votes/{id}', [VoteController:: class, "destroy"])
    ->name("votes.destroy");



Route::group(['middleware' => ['role:admin']], function () {
    //
});
    