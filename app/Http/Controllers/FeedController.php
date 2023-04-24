<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Http\Resources\SimpleContentResource;
use App\Http\Resources\SimpleQuestionResource;
use App\Models\Content;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //  $this->authorize('viewAny', Content::class);

        $search = $request->input('search');
        $tags = $request->input('tags');

        $contents = Content::query();


        $questions = Question::query();

        if ($search != null) {
            $contents = $contents
                ->where('body', 'like', "%{$search}%");
            $questions = $questions
                ->where('title', 'like', "%{$search}%")
                ->orWhere('body', 'like', "%{$search}%");
        }

        if ($tags != null) {
            $contents = $contents->withAnyTags($tags);
            $questions = $questions->withAnyTags($tags);
        }

        $contentCollection = SimpleContentResource::collection($contents->take(15)->get());
        $questionCollection = SimpleQuestionResource::collection($questions->take(15)->get());


        $perPage = config('app.pagination.per_page');

        $mergedCollection = $contentCollection
            ->merge($questionCollection)
            ->sortBy('created_at')
            ->take($perPage);
        
        // TODO fix pagination
        $page = request()->get('page', 1);

        $paginatedCollection = new LengthAwarePaginator(
            $mergedCollection->forPage($page, $perPage),
            $mergedCollection->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );
        

        
        $mergedCollection->forPage(1, $perPage);

        return $paginatedCollection;
    }
     

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function meIndex(Request $request)
    {
        $this->authorize('viewMe', Content::class);

        $contents = Content::where('creator_user_id', $request->user()->id)->get();

        return ContentResource::collection($contents);
    }
}
