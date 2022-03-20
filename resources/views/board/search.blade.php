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

    <div class="container mb-4">
        @if( count($errors) )
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

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
        <div class="container">
            @if (!($boards->isEmpty()))
                @foreach ($boards as $board)
                <div class="card search-board">
                    <a class="search-board-link" href="{{ route('read',['id' => $board->id]) }}"></a>
                    <div class="card-body">
                        <div class="search-board-body-top">
                            <p class="search-board-title">{{$board->title}}</p>
                            <p class="search-board-user">{{'@'.$board->user->name}}</p>
                            <p class="search-board-day text-muted">
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
                        <p class="card-text">{{$board->description}}</p>
                    </div>
                </div>
                @endforeach
                {{ $boards->links('pagination::bootstrap-4') }}
            @else
                <p>ボードがありませんでした。</p>
            @endif
        </div>
    @endif

    
@endsection