@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url',config('app.url'))

@section('content')
   
    <!-- top画面上部分 -->
    <div class="container mb-5 text-center">
        <div class="jumbotron">
            @auth
            <h1 class="display-4">ようこそ！ {{ Auth::user()->name }}さん！</h1>
            @endauth
            @guest
            <h1 class="display-4">ようこそ！ゲストさん！</h1>
            @endguest
            <p class="lead">ChatBoardはシンプルなリアルタイムチャットサイト</p>
            <hr class="my-4">
            <p>チャットボードを作りますか？探しますか？</p>
            <a href="{{ route('create_board') }}" class="btn btn-primary mb-1">チャットボードを作る</a>
            <a href="{{ route('search') }}" class="btn btn-primary mb-1">チャットボードを探す</a>
        </div>
    </div>
    
    <!-- 最近作られたボードを表示 -->
    <div class="container">
        <p style="font-size: 3.0rem">最近作られたボード</p>
        <div class="list-boards row">
            @foreach ($boards as $board)
                <div class="list-board-margin col-12 col-md-6">
                    <div class="list-board-color">
                        <a class="list-board-link" href="{{ route('read',['id' => $board->id]) }}"></a>
                        <div class="list-board-body">
                            <div class="list-board-body-top">
                                <p class="list-board-title mb-0">{{$board->title}}</p>
                                <p class="list-board-user">{{ '@'.$board->user->name }}</p>

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

                            </div>
                            <p class="list-board-subtitle">{{ Str::limit( $board->description, 94, '...') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    
@endsection
