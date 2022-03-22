@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url',config('app.url'))

@section('content')
    @component('components.pagetitle')
        @slot('page_title')
            Create Board
        @endslot
    @endcomponent

    <!-- ボード作成ページ -->
    <div class="container">
        @if( count($errors) )
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <form action="/board/create" method="post">
            @csrf
            <div class="mb-3">
                <label for="inputTitle" class="form-label">Board Name</label>
                <input type="text" id="inputTitle" name="title" class="form-control" value="{{old('title')}}">
            </div>
            <div class="mb-3">
                <label for="inputDescriptionOfBoard" class="form-label">Description</label>
                <input type="text" id="inputDescriptionOfBoard" class="form-control" name="description" value="{{old('description')}}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    
@endsection