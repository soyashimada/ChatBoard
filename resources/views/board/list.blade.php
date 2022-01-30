@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url','http://localhost/')

@section('content')
    @component('components.pagetitle')
        @slot('page_title')
            Your Board List
        @endslot
    @endcomponent

    
    <div class="container">
        @foreach ($user->boards as $item)
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><a href="{{ route('read',['id' => $item->id]) }}">{{$item->title}}</a></h3>
                    <h4 class="card-subtitle">{{$item->description}}</h4>
                </div>
            </div>
        @endforeach
    </div>

    
@endsection