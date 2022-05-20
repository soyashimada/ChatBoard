@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url',config('app.url'))

@section('content')
    @component('components.pagetitle')
        @slot('page_title')
            Your Board List
        @endslot
    @endcomponent
    
    <!-- ログインユーザーが作成したいボードを一覧表示する -->
    <div class="container">
        @if(!($boards->isEmpty()))
            <div class="list-boards row" id="app">
                <p class="system-message">あなたのボード一覧</p>
                @foreach ($boards as $board)
                    <div class="list-board-margin col-12">
                        <div class="list-board-color">
                            <!-- <a class="list-board-link" href="{{ route('read',['id' => $board->id]) }}"></a> -->
                            <div class="list-board-body">
                                <div class="list-board-body-top">
                                    <div class="list-boad-title mb-0">
                                        <a class="list-board-link" href="{{ route('read',['id' => $board->id]) }}">{{$board->title}}</a>
                                    </div>
                                    <p class="list-board-day text-muted">{{$board->created_at->isoFormat('YYYY.M.D(dd)')}}</p>
                                    <div style="display: inline-block;">
                                        <favorite-board :favorite_num="{{ $board->getFavoritesCountAttribute() }}" :favorite_status="{{ $board->getFavoritedByUserAttribute() ? 'true' : 'false' }}" :board_id="{{ $board->id }}"></favorite-board>
                                    </div>
                                </div>
                                <p class="list-board-subtitle">{{ $board->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $boards->links('pagination::bootstrap-4') }}
            </div>
        @else
            <p>ボードが見つかりませんでした</p>
        @endif
    </div>

    
@endsection