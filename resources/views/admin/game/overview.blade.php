@extends('layouts.app')

@section('content')
    <canvas-map-component :game-id="{{ $game->id }}" :overview="true"></canvas-map-component>
@endsection
