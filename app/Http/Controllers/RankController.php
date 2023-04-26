<?php

namespace App\Http\Controllers;

use App\Http\Resources\RankResource;
use App\Models\Rank;

class RankController extends Controller
{
    /**
     * Display a listing of ranks.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $ranks = Rank::all();
        return RankResource::collection($ranks);
    }

    /**
     * Display the specified rank.
     *
     * @param  int  $id
     * @return \App\Http\Resources\RankResource
     */
    public function show($id)
    {
        $rank = Rank::findOrFail($id);
        return new RankResource($rank);
    }
}
