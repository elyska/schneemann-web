@extends('layouts.app')

@section('title')
    {{ config('app.name', 'Schneemann') }}
@endsection

@section('content')
    <main>
        {{  __("Order received successfully") }}
    </main>
@endsection
