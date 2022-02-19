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


    <div class="container mb-4">
        @if( count($errors) )
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <form action="/settings/profile/statusMessage" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="inputStatusMessage" class="form-label">Status Message</label>
                <textarea class="form-control" name="status_message" rows="4" id="inputStatusMessage"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">send</button>
        </form>
    </div>
    
@endsection