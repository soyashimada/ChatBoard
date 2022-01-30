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

    <form action="/settings/profile/userImage" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="user_image">
        <input class="form-control" type="submit" value="送信">
    </form>

    
@endsection