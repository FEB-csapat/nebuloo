<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\Vote;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $model = Question::class;

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\QuestionResource
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Question::class);

        $querySearch = $request->input('search');
        $querySubject = $request->input('subject');
        $queryTopic = $request->input('topic');
        $queryOrderBy = $request->input('orderBy');

        $questions = Question::query();

        if ($querySearch != null) {
            $questions = $questions
                ->where('title', 'like', "%{$querySearch}%")
                ->orWhere('body', 'like', "%{$querySearch}%");
        }
        if ($querySubject != null) {
            $questions = $questions->where('subject_id', $querySubject);
        }
        if ($queryTopic != null) {
            $questions = $questions->where('topic_id', $queryTopic);
        }
        if ($queryOrderBy != null) {
            if($queryOrderBy == 'newest'){
                $questions = $questions->get()->sortByDesc('created_at');
            }else if($queryOrderBy == 'oldest'){
                $questions = $questions->get()->sortBy('created_at');
            }else if($queryOrderBy == 'popular'){
                $questions = $questions->get()->sortByDesc(function ($question) {
                    return $question->sumVoteScore();
                });
            }
        }else{
            $questions = $questions->get()->sortBy('created_at');
        }
        return PaginationHelper::paginate(QuestionResource::collection($questions));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\QuestionResource
     */
    public function meIndex(Request $request)
    {
        $this->authorize('viewMe', Question::class);

        $questions = Question::where('creator_user_id', $request->user()->id)->get();
        
        return QuestionResource::collection($questions);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreQuestionRequest  $request
     * @return \App\Http\Resources\QuestionResource
     */
    public function store(StoreQuestionRequest $request)
    {
        $this->authorize('create', Question::class);
        $data = $request->validated();
        $data['creator_user_id'] = $request->user()->id;
        $newQuestion = Question::create($data);
        return new QuestionResource($newQuestion);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\QuestionResource
     */
    public function show(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $this->authorize('view', [$question], Question::class);
        
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \App\Http\Resources\QuestionResource
     */
    public function update(UpdateQuestionRequest $request, $id)
    {
        $question = Question::findOrFail($id);

        $this->authorize('update', $question, Question::class);

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

        $this->authorize('delete', $question, Question::class);
        
        $question->delete();
    }
}
