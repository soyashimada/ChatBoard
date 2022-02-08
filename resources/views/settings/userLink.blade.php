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

    <div class="container mb-4">
        <form action="/settings/profile/userLink" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="inputUserLink" class="form-label">User Link</label>
                <input class="form-control" type="url" name="user_link" id="inputUserLink" placeholder="https://example.com" pattern="https://.*" size="30" required>
            </div>
            <button type="submit" class="btn btn-primary">send</button>
        </form>
    </div>

    
@endsection