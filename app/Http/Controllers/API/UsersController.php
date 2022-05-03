<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use Exception;
use App\Models\User;
use App\Models\Ticket;

class UsersController extends Controller
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
     * Display a listing of the user tickets.
     * @return \Illuminate\Http\Response
     */
    public function userTickets(Request $request, $email)
    {
        try {

            $user = User::where('email', $email)->first();

            if (!$user) {
                return response()->json(['message' => USER_NOT_FOUND], 422);
            }
           
            //get the open tickets
            $tickets = Ticket::where('useremail', $email)
                                ->orderBy('id','desc')
                                ->paginate(PAGE_LIMIT);

            return response()->json(['tickets' => $tickets, 'message' => LISING_DATA], 200);
            
        } catch (\Exception $ex) {
            return response()->json(['message' => SOMETHING_ERROR], 422);
        }
    }
}
