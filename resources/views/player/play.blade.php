@extends('layouts.app')

@section('head')

    <script>
        window.gameId = {{ $gameId }}
    </script>

@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Play</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <play-component :player="{{ $player }}"></play-component>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
