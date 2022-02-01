@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url','http://localhost/')

@section('content')
    @component('components.pagetitle')
        @slot('page_title')
            Find Board
        @endslot
    @endcomponent

    @if( count($errors) )
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <div class="container mb-4">
        <form action="/board/find" method="post">
            @csrf
            <div class="mb-3">
                <label for="inputSearchTitleOfBoard" class="form-label">Board Title</label>
                <input type="text" class="form-control" name="input" id="inputSearchTitleOfBoard" value="{{$input}}">
            </div>
            <button type="submit" class="btn btn-primary">find</button>
        </form>
    </div>

    @if(isset($items))
        <div class="container">
            @if (!($items->isEmpty()))
                @foreach ($items as $item)
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><a href="{{ route('read',['id' => $item->id]) }}">{{$item->title}}<a></h3>
                        <h4 class="card-subtitle">user - {{$item->user->name}}</h4>
                        <p class="card-text">{{$item->description}}</p>
                    </div>
                </div>
                @endforeach
                {{ $items->links() }}
            @elseif (isset($click))
                <p>ボードがありませんでした。</p>
            @endif
        </div>
    @endif

    
@endsection