<?php

namespace App\Http\Controllers;

use App\Models\GM;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;


class GMController extends Controller
{
    public function getLocalToken()
    {
        return file_get_contents(base_path('bnetAPIToken.key'));
    }
    public function setLocalToken($new_token)
    {
        file_put_contents(base_path('bnetAPIToken.key'), $new_token);
    }

    public function app()
    {
        $na_gm = GM::where('region_id', 1)->get();
        return view('home.index', compact('na_gm'));
    }

    public function store()
    {
        // armazena a nova lista da GM no banco de dados
        $apidata = collect($this->NA_GMList());
        GM::truncate();
        foreach($apidata['ladderTeams'] as $data)
        {
            GM::create([
                'displayName' => $data->teamMembers[0]->displayName ?? '',
                'race' => ucfirst($data->teamMembers[0]->favoriteRace ?? ''),
                'clan' => $data->teamMembers[0]->clanTag ?? '',
                'mmr' => $data->mmr ?? null,
                'points' => $data->points ?? null,
                'wins' => $data->wins ?? null,
                'losses' => $data->losses ?? null,
                'region_id' => 1,
            ]);
        }
    }

    public function verifyToken()
    {
        $token = $this->getLocalToken();

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
            $this->setLocalToken($new_token->access_token);
        }
    }

    public function NA_GMList()
    {
        $client = new Client();
        $token = $this->getLocalToken();
        
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
