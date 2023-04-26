<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Http\Resources\ContentResource;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of contents.
     *
     * @return array
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Content::class);

        $querySearch = $request->input('search');
        $querySubject = $request->input('subject');
        $queryTopic = $request->input('topic');
        $queryOrderBy = $request->input('orderBy');

        $contents = Content::query();

        if ($querySearch != null) {
            $contents = $contents
                ->where('body', 'like', "%{$querySearch}%");
        }

        if ($querySubject != null) {
            $contents = $contents->where('subject_id', $querySubject);
        }
        
        if ($queryTopic != null) {
            $contents = $contents->where('topic_id', $queryTopic);
        }

        if ($queryOrderBy != null) {
            if($queryOrderBy == 'newest'){
                $contents = $contents->get()->sortByDesc('created_at');
            }else if($queryOrderBy == 'oldest'){
                $contents = $contents->get()->sortBy('created_at');
            }else if($queryOrderBy == 'popular'){
                $contents = $contents->get()->sortByDesc(function ($content) {
                    return $content->sumVoteScore();
                });
            }
        }else{
            $contents = $contents->get()->sortBy('created_at');
        }

        return PaginationHelper::paginate(ContentResource::collection($contents));
    }
    

    /**
     * Display a listing of contents created by the user.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function meIndex(Request $request)
    {
        $this->authorize('viewMe', Content::class);
        $contents = Content::where('creator_user_id', $request->user()->id)->get();
        return ContentResource::collection($contents);
    }
    
    /**
     * Store a newly created content in storage.
     *
     * @param  \App\Http\Requests\StoreContentRequest  $request
     * @return \App\Http\Resources\ContentResource
     */
    public function store(StoreContentRequest $request)
    {
        $this->authorize('create', Content::class);
        $data = $request->validated();
        $data['creator_user_id'] = $request->user()->id;
        $newContent = Content::create($data);
        return new ContentResource($newContent);
    }

    /**
     * Display the specified content.
     *
     * @param  int  $id
     * @return \App\Http\Resources\ContentResource
     */
    public function show(Request $request, $id)
    {
        $content = Content::findOrFail($id);
        $this->authorize('view', $content);
        return new ContentResource($content);
    }

    /**
     * Update the specified content in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \App\Http\Resources\ContentResource
     */
    public function update(UpdateContentRequest $request, $id)
    {
        $content = Content::findOrFail($id);
        $this->authorize('update', $content);
        $data = $request->validated();
        if($content->update($data)){
            return new ContentResource($content);
        }
        abort(500, 'Could not update content.');
    }

    /**
     * Remove the specified content from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $content = Content::findOrFail($id);
        $this->authorize('delete', $content);
        $content->delete();
        return response()->json([
            'message' => 'Successfully deleted content!',
        ], 200);
    }
}
