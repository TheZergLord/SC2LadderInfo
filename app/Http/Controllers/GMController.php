<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;


class GMController extends Controller
{
    public function app()
    {
        $apidata = collect($this->GMList());
        return view('home.index', compact('apidata'));
    }

    public function GMList()
    {
        $token = file_get_contents(base_path('bnetAPIToken.key'));

        $client = new Client();
        try
        {
            $response = $client->request('POST', 'https://oauth.battle.net/oauth/check_token',[
                'form_params' => [
                    'region' => 'us',
                    'token' => $token
                ]
            ]);
        }
        catch(\Exception $e)
        {
            $client_id = env('BATTLE_NET_CLIENT_ID');
            $client_secret = env('BATTLE_NET_CLIENT_SECRET');
            $response = $client->request('POST', 'https://oauth.battle.net/token', [
                'auth' => [$client_id, $client_secret],
                'form_params' => [
                    'grant_type' => 'client_credentials'
                ]
            ]);
            $new_token = json_decode($response->getBody());
            file_put_contents(base_path('bnetAPIToken.key'), $new_token->access_token);
            $token = $new_token->access_token;
        }

        $response = $client->request('GET', 'https://us.api.blizzard.com/sc2/ladder/grandmaster/1', [
            'headers' => [
                'Authorization' => 'Bearer '.$token
            ]
        ]);
        // $response = $client->request('GET', 'https://us.api.blizzard.com/sc2/legacy/ladder/1/319813', [
        //     'headers' => [
        //         'Authorization' => 'Bearer '.$token
        //     ]
        // ]);
        // dd($response->getStatusCode());
        return json_decode($response->getBody());
    }
}
