<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view', Ticket::class);

        $tickets = Ticket::query();
        return TicketResource::collection($tickets->paginate());
    }

    public function meIndex(Request $request)
    {
        $this->authorize('viewMe', Ticket::class);

        $tickets = Ticket::where('creator_user_id', $request->user()->id)->get();

        return TicketResource::collection($tickets);
    }

    public function store(StoreTicketRequest $request)
    {
        $data = $request->validated();
        $data['creator_user_id'] = $request->user()->id;
        $data['state'] = false;
        $newTicket = Ticket::create($data);
        return new TicketResource($newTicket);
    }

    public function show(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $this->authorize('view', [$ticket], Ticket::class);

        return new TicketResource($ticket);
    }

    public function update(UpdateTicketRequest $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $this->authorize('update', $ticket, Ticket::class);

        $data = $request->validated();

        if($ticket->update($data)){
            return new TicketResource($ticket);
        }
    }

    public function destroy(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $this->authorize('delete', $ticket, Ticket::class);

        $ticket->delete();
    }
}
