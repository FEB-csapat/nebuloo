<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\ImageController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, "login"]);


Route::get('/users', [UserController::class, "index"])
    ->name("users.index");
Route::get('/users/{id}', [UserController::class, "show"])
    ->name("users.show");

Route::get('/feed', [FeedController::class, "index"])
    ->name("feed.index");

Route::get('/contents', [ContentController::class, "index"])
    ->name("contents.index");
Route::get('/contents/{id}', [ContentController::class, "show"])
    ->where(['id' => '[0-9]+'])
    ->name("contents.show");    


Route::get('/questions', [QuestionController::class, "index"])
    ->name("questions.index");
Route::get('/questions/{id}', [QuestionController::class, "show"])
    ->where(['id' => '[0-9]+'])
    ->name("questions.show");


Route::get('/subjects', [SubjectController::class, "index"])
    ->name("subjects.index");
Route::get('/subjects/{id}', [SubjectController::class, "show"])
    ->where(['id' => '[0-9]+'])
    ->name("subjects.show");

Route::get('/subjects/{id}/topics', [TopicController::class, "indexBySubjectId"])
    ->where(['id' => '[0-9]+'])
    ->name("subjects.indexBySubjectId");

Route::get('/topics', [TopicController::class, "index"])
    ->name("topics.index");
Route::get('/topics/{id}', [TopicController::class, "show"])
    ->where(['id' => '[0-9]+'])
    ->name("topics.show");


Route::get('/comments', [CommentController::class, "index"])
    ->name("comments.index");
Route::get('/comments/{id}', [CommentController::class, "show"])
    ->where(['id' => '[0-9]+'])
    ->name("comments.show");


Route::get('images/{id}', [ImageController::class, "show"])
    ->name("images.show");


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/me', [UserController::class, "showMe"])
        ->name("me.show");
    Route::put('/me', [UserController::class, "updateMe"])
        ->name("me.update");
    Route::delete('/me', [UserController::class, "destroyMe"])
        ->name("me.destroy");

    Route::get('contents/me', [ContentController::class, "meIndex"])
        ->name("me.contents.index");
    
    Route::get('questions/me', [QuestionController::class, "meIndex"])
        ->name("me.contents.index");
    
    
    Route::get('comments/me', [CommentController::class, "meIndex"])
        ->name("comments.index");


    Route::get('votes/me', [VoteController::class, "meIndex"])
        ->name("votes.index");


    Route::post('images', [ImageController::class, "store"])
        ->name("images.store");

    Route::post('subjects', [SubjectController::class, "store"])
        ->name("subjects.store");

    Route::post('topics', [TopicController::class, "store"])
        ->name("topic.store");


    Route::post('contents', [ContentController::class, "store"])
        ->name("me.contents.store");
    Route::put('contents/{id}', [ContentController::class, "update"])
        ->name("contents.update");
    Route::delete('contents/{id}', [ContentController::class, "destroy"])
        ->name("contents.destroy");
    
    
    Route::post('questions', [QuestionController::class, "store"])
        ->name("questions.store");
    Route::put('questions/{id}', [QuestionController::class, "update"])
        ->name("questions.update");
    Route::delete('questions/{id}', [QuestionController::class, "destroy"])
        ->name("questions.destroy");
    

    Route::get('tickets/me',[TicketController::class,'meIndex'])
    ->name('me.tickets.index');
     Route::get('tickets',[TicketController::class,'index'])
        ->name('tickets.index');
    Route::delete('tickets/{id}', [TicketController::class, 'destroy'])
        ->name("tickets.destroy");
    Route::post("tickets",[TicketController::class,"store"])
        ->name("me.tickets.store");
    Route::get('tickets/{id}',[TicketController::class,'show'])
        ->name('tickets.show');
    Route::delete('tickets/{id}', [TicketController::class, 'destroy'])
        ->name("tickets.destroy");

    Route::put('tickets/{id}', [TicketController::class, "update"])
        ->name("tickets.update");
    
    Route::post('{commentable}/{id}/comments', [CommentController::class, "store"])
        ->name("commentable.comments.store");
    
    Route::put('comments/{id}', [CommentController::class, "update"])
        ->name("comments.update");
    Route::delete('comments/{id}', [CommentController::class, "destroy"])
        ->name("comments.destroy");
    
    Route::post('{votable}/{id}/votes', [VoteController::class, "store"])
        ->name("votes.store");
    Route::delete('{votable}/{id}/votes', [VoteController::class, "destroyByVotableId"])
        ->name("votes.destroyByVotableId");
    
    Route::put('votes/{id}', [VoteController::class, "update"])
        ->name("votes.update");
    Route::delete('votes/{id}', [VoteController::class, "destroy"])
        ->name("votes.destroy");
});

/*
* API routes for rank
*/
Route::get('/ranks', [RankController::class, "index"])
    ->name("ranks.index");

Route::get('/ranks/{id}', [RankController::class, "show"])
    ->name("ranks.show");


Route::group(['middleware' => ['role:admin|moderator']], function () {
    Route::put('users/{id}', [UserController::class, "update"])
        ->name("users.update");

    Route::put('users/{id}/ban', [UserController::class, "ban"])
        ->name("users.ban");


    Route::put('/subjects/{id}', [SubjectController::class, "update"])
        ->name("subjects.update");
    Route::delete('/subjects/{id}', [SubjectController::class, "destroy"])
        ->name("subjects.destroy");


    Route::put('/topics/{id}', [TopicController::class, "update"])
        ->name("topics.update");
    Route::delete('/topics/{id}', [TopicController::class, "destroy"])
        ->name("topics.destroy");
});


Route::group(['middleware' => ['role:admin']], function () {

    Route::put('user/{id}/role', [RoleController::class, "update"])
        ->name("users.role.update");

    Route::delete('users/{id}', [UserController::class, "destroy"])
        ->name("users.destroy");

   
});
