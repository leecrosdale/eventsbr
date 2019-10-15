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


                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Map</th>
                                <th>State</th>
                                <th>Players A/D/T</th>
                                <th>Start</th>
                                <th>Edit</th>
                                <th>View</th>
                            </tr>
                            @foreach($games as $game)
                                <tr>
                                    <td>{{ $game->id }}</td>
                                    <td>{{ $game->map->name }}</td>
                                    <td>{{ $game->status_string }}</td>
                                    <td>0/0/0</td>
                                    <td><a href="{{ route('game.start', $game) }}">
                                            <button>Start</button>
                                        </a></td>
                                    <td>
                                        <button>Edit</button>
                                    </td>
                                    <td><a href="{{ route('game.overview', $game) }}">
                                            <button>View</button>
                                        </a></td>
                                </tr>

                            @endforeach
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
