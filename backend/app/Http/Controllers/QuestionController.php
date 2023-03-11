<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$this->authorize('viewAny', Question::class)){
            abort(403);
        }
        $questions = Question::all();
        return QuestionResource::collection($questions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->authorize('create', Question::class)){
            abort(403);
        }
        $data = $request->validated();
        $newQuestion = Question::create($data);
        return new QuestionResource($newQuestion);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        if(!$this->authorize('view', $question, Question::class)){
            abort(403);
        }

        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        if(!$this->authorize('update', $question, Question::class)){
            abort(403);
        }

        $data = $request->validated();

        if($question->update($data)){
            return new QuestionResource($question);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        if(!$this->authorize('delete', $question, Question::class)){
            abort(403);
        }
        $question->delete();
    }}
