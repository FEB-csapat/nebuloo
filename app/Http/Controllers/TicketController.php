<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;

class TicketController extends Controller
{
    /**
     * Display a listing of tickets.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $this->authorize('view', Ticket::class);
        $tickets = Ticket::query();
        return TicketResource::collection($tickets->paginate());
    }

    /**
     * Display a listing of the ticket created by the user.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function meIndex(Request $request)
    {
        $this->authorize('viewMe', Ticket::class);
        $tickets = Ticket::where('creator_user_id', $request->user()->id)->get();
        return TicketResource::collection($tickets);
    }

    /**
     * Store a newly created ticket in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \App\Http\Resources\TicketResource
     */
    public function store(StoreTicketRequest $request)
    {
        $this->authorize('create', Ticket::class);
        $data = $request->validated();
        $data['creator_user_id'] = $request->user()->id;
        $data['state'] = false;
        $newTicket = Ticket::create($data);
        return new TicketResource($newTicket);
    }

    /**
     * Display the specified ticket.
     *
     * @param  int  $id
     * @return \App\Http\Resources\TicketResource
     */
    public function show(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $this->authorize('view', $ticket);
        return new TicketResource($ticket);
    }

    /**
     * Update the specified ticket in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\TicketResource
     */
    public function update(UpdateTicketRequest $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $this->authorize('update', $ticket);
        $data = $request->validated();
        if($ticket->update($data)){
            return new TicketResource($ticket);
        }
        abort(500, __('messages.error_updating_ticket'));
    }

    /**
     * Remove the specified ticket from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $this->authorize('delete', $ticket);
        $ticket->delete();
        return response()->json([
            'message' => __('messages.successful_ticket_deletion'),
        ], 200);
    }
}
