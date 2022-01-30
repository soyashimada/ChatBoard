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

    <form action="/settings/profile/userLink" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="url" name="_user_link" id="url" placeholder="https://example.com" pattern="https://.*" size="30" required>
        <input class="form-control" type="submit" value="送信">
    </form>

    
@endsection