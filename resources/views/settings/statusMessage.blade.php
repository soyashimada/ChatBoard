@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url','http://localhost/')

@section('content')
    @component('components.pagetitle')
        @slot('page_title')
            Setting Profile
        @endslot
    @endcomponent

    @if( count($errors) )
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <form action="/settings/profile/statusMessage" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea class="form-control" name="status_message" rows="4" placeholder="コメント"></textarea>
        <input class="form-control" type="submit" value="送信">
    </form>

    
@endsection