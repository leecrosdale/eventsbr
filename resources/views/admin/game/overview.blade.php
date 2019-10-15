@extends('layouts.app')

@section('content')
    <canvas-map-component :gameId="{{ $game->id }}" :overview="true"></canvas-map-component>
@endsection
