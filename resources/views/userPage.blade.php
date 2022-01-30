@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url','http://localhost/')

@section('content')
    @component('components.pagetitle')
        @slot('page_title')
            Your Profile
        @endslot
    @endcomponent

    <div class="media">
        <img class="img-fluid bd-placeholder-img align-self-start mr-3" src="{{ \Storage::url($user->user_image) }}" alt="画像">
        <div class="media-body">
            <h5 class="mt-0">{{ $user->name }}</h5>
            {{ $user->status_message }}
        </div>
    </div>
    
@endsection