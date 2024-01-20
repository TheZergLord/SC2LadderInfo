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
                @if ($na_gm->isEmpty())
                    <th scope="row">
                        <td>No GM Players Yet</td>
                    </th>
                @else
                    @foreach ($na_gm as $gm)
                    <tr>
                        <th scope="row">
                            {{ $gm->displayName ?? '' }}
                        </th>
                        <td>
                            {{ $gm->race ?? '' }}
                        </td>
                        <td>
                            {{ $gm->clan ?? '' }}
                        </td>
                        <td>
                            {{ $gm->mmr ?? '' }}
                        </td>
                        <td>
                            {{ $gm->points ?? '' }}
                        </td>
                        <td>
                            {{ $gm->wins ?? '' }}
                        </td>
                        <td>
                            {{ $gm->losses ?? '' }}
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
    
@endsection
