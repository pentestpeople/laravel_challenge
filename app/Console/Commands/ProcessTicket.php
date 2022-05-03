<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ticket;

class ProcessTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:process_ticket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process tickets in chronological order for every 5 minutes.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return bool
     */
    public function handle()
    {
        try {

            $ticket = Ticket::where('status', 0)
                            ->orderBy('created_at')
                            ->first();

            //process the ticket by changing the ticket status to true
            $ticket->status = 1;
            
            if ($ticket->save())
                return true;
            else
                return false;

        } catch (\Exception $ex) {
            return false;
        }
    }
}
