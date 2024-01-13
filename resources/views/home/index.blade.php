@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container-fluid">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Player</th>
                    <th scope="col">Race</th>
                    <th scope="col">Clan</th>
                    <th scope="col">MMR</th>
                    <th scope="col">Points</th>
                    <th scope="col">Wins</th>
                    <th scope="col">Losses</th>
                </tr>
            </thead>
            <tbody>
                @if ($apidata->isEmpty())
                    <th scope="row">
                        <td>No GM Players Yet</td>
                    </th>
                @else
                    @foreach ($apidata['ladderTeams'] as $data)
                    <tr>
                        <th scope="row">
                            {{ $data->teamMembers[0]->displayName ?? '' }}
                        </th>
                        <td>
                            {{ ucfirst($data->teamMembers[0]->favoriteRace ?? '') }}
                        </td>
                        <td>
                            {{ $data->teamMembers[0]->clanTag ?? '' }}
                        </td>
                        <td>
                            {{ $data->mmr ?? '' }}
                        </td>
                        <td>
                            {{ $data->points ?? '' }}
                        </td>
                        <td>
                            {{ $data->wins ?? '' }}
                        </td>
                        <td>
                            {{ $data->losses ?? '' }}
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
    
@endsection
