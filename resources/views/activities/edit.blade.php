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

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Category/Type</label>
                <div id="categorySelectArea" class="col-sm-5">
                    <select class="form-control" id="categorySelect" name="category_id">
                        @foreach($categories as $category)
                            <option id="categoryOption" value="{{ $category->id }}" data-types="{{ $category->types }}"
                                    @if($activity->category_id == $category->id)selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="typeSelectArea" class="col-sm-5">
                    <select class="form-control" id="typeSelect" name="type_id">
                        @foreach($activity->category->types as $type)
                            <option value="{{ $type->id }}"
                                    @if($activity->type_id == $type->id)selected @endif>{{ $type->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
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
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
