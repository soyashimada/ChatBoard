@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url','http://localhost/')

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
                @foreach ($boards as $item)
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><a href="{{ route('read',['id' => $item->id]) }}">{{$item->title}}</a></h3>
                        <h4 class="card-subtitle">user - {{$item->user->name}}</h4>
                        <p class="card-text">{{$item->description}}</p>
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