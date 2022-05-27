@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url',config('app.url'))

@section('content')
    @component('components.pagetitle')
        @slot('page_title')
            Search Board
        @endslot
    @endcomponent

    <!-- ボード検索ページ -->
    <div class="container mb-4">
        @if( count($errors) )
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <p class="system-message">検索したいワードを入力しよう！</p>
        <form action="{{ route('search') }}" method="get">
            @csrf
            <div class="mb-3">
                <label for="inputSearchTitleOfBoard" class="form-label">Board Title</label>
                <input type="text" class="form-control" name="input" id="inputSearchTitleOfBoard" value="{{ isset($input) ? $input : '' }}">
            </div>
            <button type="submit" class="btn btn-primary">find</button>
        </form>
    </div>

    @if(isset($boards))
        <div class="container" id="app">
            @if (!($boards->isEmpty()))
                @foreach ($boards as $board)
                    <div class="list-board-margin col-12">
                        <div class="list-board-color">
                            <!-- <a class="list-board-link" href="{{ route('read',['id' => $board->id]) }}"></a> -->
                            <div class="list-board-body">
                                <div class="list-board-body-top">
                                    <div class="list-boad-title mb-0">
                                        <a class="list-board-link" href="{{ route('read',['id' => $board->id]) }}">{{$board->title}}</a>
                                    </div>
                                    <div class="list-board-user">
                                        <a href="{{ route('profile', ['user' => $board->user->id]) }}">{{ '@'.$board->user->name }}</a>
                                    </div>
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
            @else
                <p class="system-message">ボードがありませんでした。</p>
            @endif
        </div>
    @endif
    <style>
        .fa-heart {
            font-size: 34px!important;
        }

        .favorite-num {
            font-size: 28px!important;
        }

    </style>

    
@endsection