@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url','http://localhost/')

@section('content')
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

@endsection