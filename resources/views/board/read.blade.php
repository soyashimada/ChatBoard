@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url',config('app.url'))

@section('content')
    <div class="read-position">
        <div class="container read-container">
        @component('components.pagetitle')
            @slot('page_title')
            {{ $board->title }}
            @endslot
        @endcomponent


        <div id="app">
            <real-time-chat v-bind:id="{{ $board->id }}"></real-time-chat>
        </div>

        @if( count($errors) )
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
 
    </div>
@endsection