@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url','http://localhost/')

@section('content')
    @component('components.pagetitle')
        @slot('page_title')
            User Profile
        @endslot
    @endcomponent

    <div class="profile-info">
        <div class="container">
            <div class="card pb-5">
                <div class="row justify-content-center g-0">
                    <div class="col-4">
                        <img class="w-100 img-thumbnail bd-placeholder-img align-self-start mr-3" src="{{ $profiledUser->user_image }}" alt="user_image">
                    </div>
                </div>
                <div class="user_profile">
                    <div class="card-body profile-card">
                        <div class="mb-2">
                            <p class="card-title profile-name mb-0">{{ $profiledUser->name }}</p>
                            <a class="card-text profile-link text-muted" href="{{ $profiledUser->user_link }}">{{ $profiledUser->user_link }}</a>
                        </div>
                        <p class="card-text">{{ $profiledUser->status_message }}</p>
                    </div>
                </div>
            </div>
        <div>
        @if($profiledUser->id == Auth::user()->id)
            <a class="card-text" href="{{ route('setting_profile_top') }}"><small class="text-muted">プロフィールを編集</small></a>
        @endif
    </div>

    <div class="container mb-5">
        <div class="recently-boards">
            <p style="font-size: 3.0rem">最近のボード</p>
            @foreach ($boards as $board)
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><a href="{{ route('read',['id' => $board->id]) }}">{{$board->title}}</a></h3>
                    <h4 class="card-subtitle">{{$board->description}}</h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
@endsection