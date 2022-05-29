@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url',config('app.url'))

@section('content')
   
    <!-- top画面上部分 -->
    <div class="top container text-center">
        <div class="jumbotron top-display">
            <div class="top-display-back">
                @auth
                <p class="display-4">ようこそ！ {{ Auth::user()->name }}さん！</p>
                @endauth
                @guest
                <p class="display-4">ようこそ！ゲストさん！</p>
                @endguest
                <p class="lead">ChatBoardはシンプルなリアルタイムチャットサイト</p>
                <hr class="my-4">
                <p class="top-display-text">チャットボードを作って、他のユーザーとチャットを書きあいましょう</p>
                <a href="{{ route('create_board') }}" class="btn btn-primary mb-1">チャットボードを作る</a>
                <a href="{{ route('search') }}" class="btn btn-primary mb-1">チャットボードを探す</a>
            </div>
        </div>
        <hr class="my-4">
        <div class="top-icon">
            <div class="row">
                <div class="col-12 col-md-6 top-icon-img">
                    <i class="fa-solid fa-comments ml-auto"></i>
                </div>
                <div class="col-12 col-md-6 top-icon-text">
                    <div class="top-icon-text-font">
                        <p>ChatBoardはリアルタイムチャットサイトです。
                        <br> 掲示板（チャットボード）を作り、
                        <br>みんなでリアルタイムチャットを楽しみましょう</p>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4">
    </div>

    <!-- 最近作られたボードを表示 -->
    <div class="container list">
        <p style="font-size: 3.0rem">最近作られたボード</p>
        <div class="list-boards row" id="app">
            @foreach ($boards as $board)
                <div class="list-board-margin col-12 col-md-6">
                    <!-- JavaScriptでdiv枠にリンクを持たせるhttps://www.ipentec.com/document/html-css-link-entire-div-frame#section_06 -->
                    <div class="list-board-color-hover" onclick="DivFrameClick()" href="{{ route('read',['id' => $board->id]) }}">
                        <div class="list-board-body">
                            <div class="list-board-body-top">
                                <!-- <a class="list-board-link-over" href="{{ route('read',['id' => $board->id]) }}"></a> -->
                                <p class="list-boad-title mb-0">{{$board->title}}</p>
                                <div class="list-board-user">
                                    <a href="{{ route('profile', ['user' => $board->user->id]) }}">{{ '@'.$board->user->name }}</a>
                                </div>
                                <!-- 何日前の投稿かを表示 -->
                                <p class="list-board-day text-muted">
                                    @php
                                        $var = \Carbon\Carbon::parse($board->created_at)->diffInDays(\Carbon\Carbon::now())
                                    @endphp
                                    @switch( $var )
                                        @case(0)
                                             今日
                                            @break
                                        @case(1)
                                             昨日
                                            @break
                                        @default
                                             {{$var}}日前
                                    @endswitch
                                </p>
                                <div style="display: inline-block;">
                                    <favorite-board :favorite_num="{{ $board->getFavoritesCountAttribute() }}" :favorite_status="{{ $board->getFavoritedByUserAttribute() ? 'true' : 'false' }}" :board_id="{{ $board->id }}"></favorite-board>
                                </div>

                            </div>
                            <p class="list-board-subtitle">{{ $board->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <style>
        .fa-heart {
            z-index: 2;
        }

    </style>

    <script type="text/javascript">
        function DivFrameClick() {
            document.location.href = this.href;
        }
    </script>

    
@endsection
