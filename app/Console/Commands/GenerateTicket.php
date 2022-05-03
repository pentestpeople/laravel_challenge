<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Ticket;
use Faker\Generator as Faker;

class GenerateTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:generate_ticket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Ticket with dummy data for every minute';

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
    public function handle(Faker $faker)
    {
        try {

            $user = User::inRandomOrder()->first();

            $ticket = new Ticket();
            $ticket->subject = $faker->text();
            $ticket->content = $faker->paragraph();
            $ticket->username = $user->name;
            $ticket->useremail = $user->email;
            $ticket->status = 0;
            
            if ($ticket->save())
                return true;
            else
                return false;

        } catch (\Exception $ex) {
            return false;
        }
    }
}
