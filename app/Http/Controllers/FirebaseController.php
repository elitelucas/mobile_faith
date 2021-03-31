<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Symfony\Component\Console\Output\ConsoleOutput;

class FirebaseController extends Controller

{
    public static function sendNotification($deviceToken, $title, $body, $data)
    {
        try {
            $output = new ConsoleOutput();
            $message = "    sending notification";
            $output->writeln($message);

            $factory = (new Factory)
                ->withServiceAccount(__DIR__ . '/faithspace-c0c15-firebase-adminsdk-ko0pi-684b91a001.json');
            $messaging = $factory->createMessaging();

            $notification = Notification::fromArray([
                'title' => $title,
                'body' => $body,
            ]);

            $message = CloudMessage::withTarget('token', $deviceToken)
                ->withNotification($notification) // optional
                ->withData($data) // optional
            ;

            $messaging->send($message);
        } catch (\Exception $e) {
            $output = new ConsoleOutput();
            $message = "    ### Push Notification: deviceToken->$deviceToken, ErrorMessage:" . $e->getMessage();
            $output->writeln($message);
        }
    }
}
