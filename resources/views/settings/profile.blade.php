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

    <div class="container">
        <div class="card">
            <div class="card-body">
                <a href="/settings/profile/name" class="card-title" style="font-size: 20px">ユーザー名の変更</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <a href="/settings/profile/statusMessage" class="card-title" style="font-size: 20px">コメントを編集する</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <a href="/settings/profile/userImage" class="card-title" style="font-size: 20px">プロフィール画像を編集する</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <a href="/settings/profile/userLink" class="card-title" style="font-size: 20px">プロフィールリンクを編集する</a>
            </div>
        </div>
    </div>

    
@endsection