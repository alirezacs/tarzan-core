<?php

namespace App\Notifications\channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FarazSmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        $userName = 'u09389901748';

        $password = urlencode('Faraz@1979420441221734');

        $from = '+983000505';

        $patternCode = $notification->pattern;

        $to = $notifiable->phone;

        $data = $notification->data;

        $url = "https://ippanel.com/patterns/pattern?username=" . $userName . "&password=" . $password . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($data)) . "&pattern_code=$patternCode";

        try{
            $request = Http::post($url, $data);
        }catch(\Exception $e){
            Log::info('خطا در ارسال اس ام اس تایید سفارش');
        }
    }
}
