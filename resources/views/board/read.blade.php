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
    <!-- Vueコンポーネントの読み込み -->
    <script src="{{ mix('js/app.js') }}" defer></script>
@endsection