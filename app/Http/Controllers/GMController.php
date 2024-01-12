<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;


class GMController extends Controller
{
    public function app()
    {
        $apidata = collect($this->GMList())->sortBy(['mmr', 'desc']);
        return view('home.index', compact('apidata'));
    }

    public function GMList()
    {
        $auth_file = file(base_path('bnetAPIToken.key'));
        $token = trim($auth_file[0]);

        $client = new Client();
        $response = $client->request('POST', 'https://oauth.battle.net/oauth/check_token?:region=us&token='.$token);
        $token_verify = json_decode($response->getBody());

        if($token_verify->exp < Carbon::now()->timestamp)
        {
            $client_id = trim($auth_file[1]);
            $client_secret = trim($auth_file[2]);
            $response = $client->request('POST', 'https://oauth.battle.net/token', [
                'auth' => [$client_id, $client_secret],
                'form_params' => [
                    'grant_type' => 'client_credentials'
                ]
            ]);
            $new_token = json_decode($response->getBody());
            $new_content = implode("\n", [$new_token->access_token, $client_id, $client_secret]);
            file_put_contents(base_path('bnetAPIToken.key'), $new_content);
            $token = $new_token->access_token;
        }

        $response = $client->request('GET', 'https://us.api.blizzard.com/sc2/ladder/grandmaster/1', [
            'headers' => [
                'Authorization' => 'Bearer '.$token
            ]
        ]);
        // dd($response->getStatusCode());
        return json_decode($response->getBody());
    }
}
