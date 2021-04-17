<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;
use App\User;
use App\Http\Controllers\FirebaseController;
use Symfony\Component\Console\Output\ConsoleOutput;

class PrayTimeNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'praytime:notify';

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
        Log::info("============================================================");
        Log::info("Cron job: PrayTimeNotify  " . date('Y-m-d H:i:s'));

        $now = strtotime(gmdate('H:i:s'));
        foreach (User::where('is_admin', 0)->get() as $user) {
            $praytime = strtotime($user->prayTime);
            $diff = $praytime - $now;
            if ($diff >= 0 && $diff < 300) {
                // Log::info($user->id . ": " . $diff);
                $deviceToken =  $user->deviceToken;
                $title = 'Faithspace';
                $body =  'Time to Pray';
                $data = [
                    'type' => 'notification',
                ];
                FirebaseController::sendNotification($deviceToken, $title, $body, $data);
            }
        }
    }
}
