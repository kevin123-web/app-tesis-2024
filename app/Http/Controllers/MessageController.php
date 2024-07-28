<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $client = new Client();

        $response = $client->request('POST', 'https://gate.whapi.cloud/messages/text', [
            'body' => json_encode([
                'typing_time' => 0,
                'to' => $request->input('to'),
                'body' => $request->input('body')
            ]),
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer 33gQM0Mkk5wGfE9mRZV67ofjpxUnTtO6',
                'content-type' => 'application/json',
            ],
        ]);

        return response()->json([
            'status' => 'success',
            'response' => json_decode($response->getBody()->getContents())
        ]);
    }
}

