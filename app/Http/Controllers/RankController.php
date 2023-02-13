<?php

namespace App\Http\Controllers;

use App\Http\Resources\RankResource;
use App\Models\Rank;
use Illuminate\Http\Request;


class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ranks = Rank::all();
        return RankResource::collection($ranks);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rank = Rank::findOrFail($id);
        return new RankResource($rank);
    }
}
