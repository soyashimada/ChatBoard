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
    <style>
        .fa-heart {
            font-size: 34px!important;
        }

        .favorite-num {
            font-size: 28px!important;
        }

    </style>
    
    <!-- ログインユーザーが作成したいボードを一覧表示する -->
    <div class="container">
        @if(!($boards->isEmpty()))
            <div class="list-boards row" id="app">
                <p class="system-message">あなたのボード一覧</p>
                @foreach ($boards as $board)
                    <div class="list-board-margin col-12">
                        <div class="list-board-color-hover">
                            <div class="list-board-body">
                                <div class="list-board-body-top">
                                    <a class="list-board-link-over" href="{{ route('read',['id' => $board->id]) }}"></a>
                                    <p class="list-board-title-big mb-0">{{$board->title}}</p>
                                    <p class="list-board-day text-muted">
                                        <?php $var = \Carbon\Carbon::parse($board->created_at)->diffInDays(\Carbon\Carbon::now()) ?>
                                        @switch( $var )
                                            @case(0)
                                                    今日
                                                @break
                                            @case(1)
                                                    昨日
                                                @break
                                            @default
                                                    {{\Carbon\Carbon::parse($board->created_at)->diffInDays(\Carbon\Carbon::now())}}日前
                                        @endswitch
                                    </p>
                                </div>
                                <p class="list-board-subtitle">{{ $board->description }}</p>
                                <div class="d-flex justify-content-end align-content-end">
                                    <favorite-board :favorite_num="{{ $board->getFavoritesCountAttribute() }}" :favorite_status="{{ $board->getFavoritedByUserAttribute() ? 'true' : 'false' }}" :board_id="{{ $board->id }}"></favorite-board>
                                </div>
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
    <style>
        .fa-heart {
            z-index: 2;
        }

    </style>
    
@endsection