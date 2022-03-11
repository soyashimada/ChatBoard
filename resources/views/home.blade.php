@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url','http://localhost/')

@section('content')
   
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
    
    <div class="container mb-5">
        <p style="font-size: 3.0rem">最近作られたボード</p>
        <div class="recently-boards row">
            @foreach ($boards as $board)
            <div class="recently-board-margin col-12 col-md-6 col-lg-4">
                <div class="recently-board-border">
                    <a class="recently-board-link" href="{{ route('read',['id' => $board->id]) }}"></a>
                    <div class="recently-board-body">
                        <div class="recently-board-body-top">
                            <p class="recently-board-title mb-0">{{$board->title}}</p>
                            <p class="recently-board-day text-muted">{{$board->created_at->isoFormat('YYYY.M.D(dd)')}}</p>
                        </div>
                        <p class="recently-board-subtitle">{{ Str::limit( $board->description, 94, '...') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
