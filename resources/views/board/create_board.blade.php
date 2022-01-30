@extends('layouts.app')

@section('title','ChatBoard')
@section('description','this is chatboard')
@section('base_url','http://localhost/')

@section('content')
    @component('components.pagetitle')
        @slot('page_title')
            Create Board
        @endslot
    @endcomponent

    <div class="container">
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