<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\SimpleQuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of questions.
     *
     * @return array
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
            $questions = $questions->get()->sortByDesc('created_at');
        }
        return PaginationHelper::paginate(SimpleQuestionResource::collection($questions));
    }

    /**
     * Display a listing of questions created by the user.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function meIndex(Request $request)
    {
        $this->authorize('viewMe', Question::class);
        $questions = Question::where('creator_user_id', $request->user()->id)->get();
        return QuestionResource::collection($questions);
    }
    
    /**
     * Store a newly created question in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionRequest $request
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
     * Display the specified question.
     *
     * @param  int  $id
     * @return \App\Http\Resources\QuestionResource
     */
    public function show(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $this->authorize('view', $question);
        return new QuestionResource($question);
    }

    /**
     * Update the specified question in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\QuestionResource
     */
    public function update(UpdateQuestionRequest $request, $id)
    {
        $question = Question::findOrFail($id);
        $this->authorize('update', $question);
        $data = $request->validated();
        if($question->update($data)){
            return new QuestionResource($question);
        }
        abort(500, __('messages.error_updating'));
    }

    /**
     * Remove the specified question from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $this->authorize('delete', $question);
        if($question->delete()){
            return response()->json([
                'message' => __('messages.successful_deletion'),
            ], 200);
        }
        abort(500, __('messages.error_deleting'));
    }
}
