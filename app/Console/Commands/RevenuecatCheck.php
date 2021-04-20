<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Log;
use App\User;

class RevenuecatCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'revenuecat:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        Log::info("Cron job: Revecuecat Check  " . date('Y-m-d H:i:s'));

        foreach (User::where('is_admin', 0)->get() as $user) {
            $endpoint = 'https://api.revenuecat.com/v1/subscribers/' .  $user->id;

            //Get or Create Subscription Info on RevenueCat
            $response = Http::withHeaders([
                'Authorization' => 'Bearer WFpqdzAwxwVzyXPBwtkfPEcpDUtvDnrG',
            ])->get($endpoint, [
                // 'name' => 'Taylor',
            ])->throw()->json();
           
            if ($response["subscriber"]["entitlements"] != null) { //User paid
                $user->paid = true;
                $user->save();
            } else {
            }
        }
    }
}
