<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Log;

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

        $state = "expire";
        $endpoint = 'https://api.revenuecat.com/v1/subscribers/' . '1';

        //Get or Create Subscription Info on RevenueCat
        $response = Http::withHeaders([
            'Authorization' => 'Bearer WFpqdzAwxwVzyXPBwtkfPEcpDUtvDnrG',
        ])->get($endpoint, [
            // 'name' => 'Taylor',
        ])->throw()->json();

        Log::info($response);

        if ($response["subscriber"]["entitlements"] != null) {            
            $state = "active";          
        } else {
          
        }

    }
}
