@extends('layout.simple')
@section('breadcrumbs')
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('myActivities') }}">Activities</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </section>
@endsection
@section('content')
    <div class="container p-5">
        <form action="/activities/{{ $activity->id }}" method="post">
        @csrf
        @method('PUT')
        <!-- Start form to add activity -->
            <div class="form-group row">
                <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTitle" name="title" value="{{ $activity->title }}"
                           required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputContent" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputContent" name="content"
                           value="{{$activity->content }}" required>
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Category</legend>
                    <div class="col-sm-4">
                        @isset($categories)

                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category_id"
                                           id="category{{ $category->id }}" value="{{ $category->id }}" @if ($activity->category_id == $category->id) checked="checked" @endif required>
                                    <label class="form-check-label"
                                           for="category{{ $category->id }}">{{ ucwords($category->name) }}</label>
                                </div>
                            @endforeach

                        @endisset
                    </div>
                    <legend class="col-form-label col-sm-2 pt-0">Type</legend>
                    <div class="col-sm-4">
                        @isset($types)

                            @foreach($types as $type)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type_id" id="type{{ $type->id }}"
                                           value="{{ $type->id }}" @if ($activity->type_id == $type->id) checked="checked" @endif required>
                                    <label class="form-check-label"
                                           for="type{{ $type->id }}">{{ ucwords($type->title) }}</label>
                                </div>
                            @endforeach

                        @endisset
                    </div>
                </div>
            </fieldset>
            <div class="form-group row">
                <label for="inputLink" class="col-sm-2 col-form-label">Link</label>
                <div class="col-sm-10">
                    <input type="url" class="form-control" id="link" name="link" value="{{ $activity->link }}" required>
                    <small id="urlHelp" class="form-text text-muted">Dont forget to put https:// or http:// at the
                        beginning.</small>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <a class="btn btn-secondary" href="{{ route('myActivities') }}">Abort</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
