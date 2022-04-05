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
            <div class="list-boards row">
                <p class="system-message">あなたのボード一覧</p>
                @foreach ($boards as $board)
                    <div class="list-board-margin col-12">
                        <div class="list-board-color">
                            <a class="list-board-link" href="{{ route('read',['id' => $board->id]) }}"></a>
                            <div class="list-board-body">
                                <div class="list-board-body-top">
                                    <p class="list-board-title mb-0">{{$board->title}}</p>
                                    <p class="list-board-day text-muted">{{$board->created_at->isoFormat('YYYY.M.D(dd)')}}</p>
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