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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Subject::class, auth()->user());
        $subjects = Subject::all();
        return SubjectResource::collection($subjects);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $this->authorize('view', $subject, Subject::class);

        return new SubjectResource($subject);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreSubjectRequest  $request
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectRequest $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $this->authorize('update', $subject, Subject::class);

        $data = $request->validated();
        
        if($subject->update($data)){
            return new SubjectResource($subject);
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
        $subject = Subject::findOrFail($id);

        $this->authorize('delete', $subject);
        
        $subject->delete();
    }
}
