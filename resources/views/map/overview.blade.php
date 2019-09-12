@extends('layouts.app')

@section('content')
    <map-overview-component :terrain="{{ json_encode($terrain) }}"></map-overview-component>
@endsection
