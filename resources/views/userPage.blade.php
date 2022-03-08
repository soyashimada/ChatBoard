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

    <div class="profile-info mb-3">
        <div class="container">
            <div class="pb-5">
                <div class="row justify-content-center g-0">
                    <div class="col-4">
                        <img class="w-100 img-thumbnail bd-placeholder-img align-self-start mr-3" src="{{ $profiledUser->user_image }}" alt="user_image">
                    </div>
                </div>
                <div class="user_profile">
                    <div class="profile-card">
                        <div class="mb-2">
                            <p class="profile-name mb-0">{{ $profiledUser->name }}</p>
                            <a class="profile-link text-muted" href="{{ $profiledUser->user_link }}">{{ $profiledUser->user_link }}</a>
                        </div>
                        <p>{{ $profiledUser->status_message }}</p>
                    </div>
                </div>
            </div>       
            <div class="text-center">
            @if($profiledUser->id == Auth::user()->id)
                <a class="btn btn-secondary" href="{{ route('setting_profile_top') }}" role="button">プロフィールを編集</a>
            @endif
            </div>
        </div>
    </div>

    <div class="container">
        <p style="font-size: 3.0rem">{{ $profiledUser->name}}のボード</p>
        <div class="pb-5">
            @if(!($boards->isEmpty()))
                @foreach ($boards as $board)
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"><a href="{{ route('read',['id' => $board->id]) }}">{{$board->title}}</a></h3>
                            <h4 class="card-subtitle">{{$board->description}}</h4>
                        </div>
                    </div>
                @endforeach
            @else
                <p>このユーザーのボードは見つかりませんでした</p>
            @endif
        </div>
    </div>
    
@endsection