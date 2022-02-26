@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url','http://localhost/')

@section('content')
   
    <div class="container mb-5 text-center">
        <div class="jumbotron">
            <h1 class="display-4">こんにちわ！ {{ Auth::user()->name }}さん！</h1>
            <p class="lead">ChatBoardはシンプルなリアルタイムチャットサイト</p>
            <hr class="my-4">
            <p>チャットボードを作りますか？探しますか？</p>
            <a href="{{ route('create_board') }}" class="btn btn-primary mb-1">チャットボードを作る</a>
            <a href="{{ route('search') }}" class="btn btn-primary">チャットボードを探す</a>
        </div>
    </div>
    
    <div class="container mb-5">
        <div class="recently-boards">
            <p style="font-size: 3.0rem">最近のボード</p>
            @foreach ($boards as $board)
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><a href="{{ route('read',['id' => $board->id]) }}">{{$board->title}}</a></h3>
                    <h4 class="card-subtitle">{{$board->description}}</h4>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
