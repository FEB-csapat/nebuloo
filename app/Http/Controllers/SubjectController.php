<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the subjects.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Subject::class);
        $subjects = Subject::all();
        return SubjectResource::collection($subjects);
    }
    
    /**
     * Display the specified subject.
     *
     * @param  int  $id
     * @return \App\Http\Resources\SubjectResource
     */
    public function show(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $this->authorize('view', $subject);

        return new SubjectResource($subject);
    }

    /**
     * Store a newly created subject in storage.
     *
     * @param  \App\Http\Requests\StoreSubjectRequest  $request
     * @return \App\Http\Resources\SubjectResource
     */
    public function store(StoreSubjectRequest $request)
    {
        $this->authorize('create', Subject::class);
        $data = $request->validated();
        $data['creator_user_id'] = $request->user()->id;
        $newSubject = Subject::create($data);
        return new SubjectResource($newSubject);
    }


    /**
     * Update the specified subject in storage.
     *
     * @param  \App\Http\Requests\UpdateSubjectRequest
     * @param  int  $id
     * @return \App\Http\Resources\SubjectResource
     */
    public function update(UpdateSubjectRequest $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $this->authorize('update', $subject);
        $data = $request->validated();
        if($subject->update($data)){
            return new SubjectResource($subject);
        }
        abort(500, 'Could not update subject.');
    }

    /**
     * Remove the specified subject from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $this->authorize('delete', $subject);
        $subject->delete();
        return response()->json([
            'message' => 'Successfully deleted subject!',
        ], 200);
    }
}
