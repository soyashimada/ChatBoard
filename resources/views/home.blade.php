@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url','http://localhost/')

@section('content')
    @component('components.pagetitle')
        @slot('page_title')
            TOP PAGE
        @endslot
    @endcomponent

    <div class="container">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('board')}}" class="card-title" style="font-size: 20px">あなたのチャットボード</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <a href="{{ route('create_board') }}" class="card-title" style="font-size: 20px">チャットボードを作る</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <a href="{{ route('find') }}" class="card-title" style="font-size: 20px">チャットボードを探す</a>
            </div>
        </div>
    </div>
@endsection
