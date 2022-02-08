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

    <div class="container">
        <div class="card">
            <div class="row justify-content-center g-0">
                <div class="col-4">
                    <img class="w-100 img-thumbnail bd-placeholder-img align-self-start mr-3" src="{{ $profiledUser->user_image }}" alt="user_image">
                </div>
                <div class="col-sm-8 user_profile">
                    <div class="card-body">
                        <h5 class="card-title">{{ $profiledUser->name }}</h5>
                        <a class="card-text" href="{{ $profiledUser->user_link }}"><small class="text-muted">{{ $profiledUser->user_link }}</small></a>
                        <p class="card-text">{{ $profiledUser->status_message }}</p>
                    </div>
                </div>
            </div>
        </div>
    <div>


    @if($profiledUser->id == Auth::user()->id)
        <a class="card-text" href="{{ route('setting_profile_top') }}"><small class="text-muted">プロフィールを編集</small></a>
    @endif
    
@endsection