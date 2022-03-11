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
        <p style="font-size: 3.0rem">{{ $profiledUser->name}}が最近作成したボード</p>
        @if(!($boards->isEmpty()))
        <div class="list-boards row">
            @foreach ($boards as $board)
                <div class="list-board-margin col-12 col-md-6 col-lg-4">
                    <div class="list-board-color">
                        <a class="list-board-link" href="{{ route('read',['id' => $board->id]) }}"></a>
                        <div class="list-board-body">
                            <div class="list-board-body-top">
                                <p class="list-board-title mb-0">{{$board->title}}</p>
                                <p class="list-board-day text-muted">{{$board->created_at->isoFormat('YYYY.M.D(dd)')}}</p>
                            </div>
                            <p class="list-board-subtitle">{{ Str::limit( $board->description, 94, '...') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @else
            <p>このユーザーのボードは見つかりませんでした</p>
        @endif
    </div>
    
@endsection