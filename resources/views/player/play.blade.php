@extends('layouts.app')

@section('head')

    <script>
        window.gameId = {{ $gameId }}
    </script>

@endsection


@section('content')

    <play-component :player="{{ $player }}"></play-component>

@endsection
