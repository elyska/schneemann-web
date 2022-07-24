@extends('layouts.app')

@section('title')
    {{ config('app.name', 'Schneemann') }}
@endsection

@section('content')
    <div class="container">
        {{__("Hello")}}
    </div>
@endsection
