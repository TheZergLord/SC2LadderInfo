@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container-fluid">
        <table class="table">
            <tbody>
                <tr>
                    <th>Player</th>
                    <th>MMR</th>
                    <th>Wins</th>
                    <th>Losses</th>
                </tr>
                @foreach ($apidata as $data)
                <tr>
                    <td>
                        {{ $data->name ?? '' }}
                    </td>
                    <td>
                        {{ $data->code }}
                    </td>
                    <td>
                        {{ $data->fullName ?? '' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    
@endsection