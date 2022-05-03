<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use DB;
use Carbon\Carbon;
use Response;
use Exception;

class StatsController extends Controller
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
     * Fetching statistics of tickets.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $total_tickets = 0;
            $unprocessed_tickets = 0;
            $highest_submitted_username = '';
            $last_process_ticket_time = '';

            //total tickets
            $total_tickets = Ticket::count();


            //unprocessed tickets
            $unprocessed_tickets = Ticket::where('status', 0)
                                                ->count();

                                                
            //highest number of tickets submitted by user
            $highest_ticket = Ticket::select(DB::raw("COUNT(*) AS highest_records"), 'username')
                                    ->groupBy('username')
                                    ->orderBy('highest_records', 'desc')
                                    ->limit(1)
                                    ->first();
           
            if ($highest_ticket) {
                $highest_submitted_username = $highest_ticket->username;
            }
            
            
            //time when the last processing of a ticket was done
            $last_process_ticket = Ticket::select('updated_at')
                                    ->where('status', 1)
                                    ->orderBy('updated_at', 'desc')
                                    ->limit(1)
                                    ->first();
            
            if ($last_process_ticket) {
                $last_process_ticket_time = Carbon::createFromFormat('Y-m-d H:i:s', $last_process_ticket->updated_at)->format('H:i:s');
            }
                            
            $data = [
                'total_tickets' => $total_tickets,
                'unprocessed_tickets' => $unprocessed_tickets,
                'highest_tickets_submitted_by' => $highest_submitted_username,
                'last_process_ticket_time' => $last_process_ticket_time
            ];
            
            return response()->json(['data' => $data, 'message' => LISING_DATA], 200);
            
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return response()->json(['message' => SOMETHING_ERROR], 422);
        }
    }
}
