@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Current Turn</th>
                                <th>Players</th>
                                <th>Join</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($games as $game)
                                <tr>
                                    <td>{{ $game->id }}</td>
                                    <td>{{ $game->name }}</td>
                                    <td>{{ $game->status }}</td>
                                    <td>{{ $game->current_turn }}</td>
                                    <td> {{ $game->players()->count() }} / {{ $game->max_players }}</td>
                                    <td>@if ($game->players()->count() != $game->max_players) <a
                                            href="{{ route('game.join', $game) }}">Join</a> @endif</td>

                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
