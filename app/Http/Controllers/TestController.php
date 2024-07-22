<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request as HttpRequest;

class TestController extends Controller
{
    public function index(HttpRequest $request)
    {
        $client = new Client();
        $headers = [
            'apikey' => 'jawapi',
            'Content-Type' => 'application/json'
        ];
        $body = [
            'receiver' => '6285162822778',
            'isGroup' => false,
            'message' => [
                'text' => 'Hello!',
                'contextInfo' => [
                    'forwardingScore' => 9999,
                    'isForwarded' => true,
                    'forwardedNewsletterMessageInfo' => [
                        'newsletterName' => 'Bot Dibuat Oleh Jayadana',
                        'newsletterJid' => '120363182351520831@newsletter'
                    ]
                ]
            ]
        ];

        $response = $client->post('http://localhost:8000/chats/send?id=jayadana', [
            'headers' => $headers,
            'json' => $body
        ]);

        dd($response->getBody());
    }
}
