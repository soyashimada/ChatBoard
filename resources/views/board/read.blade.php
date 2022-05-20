@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url',config('app.url'))

@section('content')
    <style>
        .fa-heart {
            font-size: 54px!important;
        }

        .favorite-num {
            font-size: 45px!important;
        }

    </style>
    <div class="read-position" id="app">
        <div class="container read-container">
            <div class="container-fluid">
                <div class="container d-flex" style="justify-content: space-between; align-items: flex-start">
                    <div class="row w-100">
                        <div class="page-title col-11">
                            <p class="fw-bold">{{ $board->title }}</p>
                        </div>
                        <div class="col-1">
                            <favorite-board :favorite_num="{{ $board->getFavoritesCountAttribute() }}" :favorite_status="{{ $board->getFavoritedByUserAttribute() ? 'true' : 'false' }}" :board_id="{{ $board->id }}"></favorite-board>
                        </div>
                    </div>
                </div>
            </div>
            <real-time-chat v-bind:board_data="{{ $board }}"></real-time-chat>
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