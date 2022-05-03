<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Response;
use Exception;

class TicketsController extends Controller
{
    /**
    * Constructor
    *
    * @return void
    */
    public function __construct()
    {
        
    }

    /**
     * Display a listing of the open tickets.
     * @return \Illuminate\Http\Response
     */
    public function openTickets()
    {
        try {
           
            $tickets = Ticket::where('status', 0)
                                ->orderBy('id','desc')
                                ->paginate(PAGE_LIMIT);
            
            return response()->json(['tickets' => $tickets, 'message' => LISING_DATA], 200);
            
        } catch (\Exception $ex) {
            return response()->json(['message' => SOMETHING_ERROR], 422);
        }
    }

    /**
     * Display a listing of the closed tickets.
     * @return \Illuminate\Http\Response
     */
    public function closedTickets()
    {
        try {
           
            $tickets = Ticket::where('status', 1)
                                ->orderBy('id','desc')
                                ->paginate(PAGE_LIMIT);

            return response()->json(['tickets' => $tickets, 'message' => LISING_DATA], 200);
            
        } catch (\Exception $ex) {
            return response()->json(['message' => SOMETHING_ERROR], 422);
        }
    }
}
