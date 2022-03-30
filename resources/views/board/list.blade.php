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
        <p class="system-message">あなたのボード一覧</p>
            @foreach ($boards as $board)
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><a href="{{ route('read',['id' => $board->id]) }}">{{$board->title}}</a></h3>
                        <h4 class="card-subtitle">{{$board->description}}</h4>
                    </div>
                </div>
            @endforeach
            {{ $boards->links('pagination::bootstrap-4') }}
        @else
            <p>ボードが見つかりませんでした</p>
        @endif
    </div>

    
@endsection