@extends('layout.simple')
@section('breadcrumbs')
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </nav>
    </section>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row h-100">
            @foreach($categories as $category)
                <div class="category-{{ $category->id }} vh-50 w-100 col-sm-12 col-md-6 col-xl-4 p-4 text-center">
                    <img src="{{ asset('img/category_' . $category->id) }}.png"
                         width="{{ env('TIC_CARDS_CAT_IMG_SIZE', 100) }}"
                         height="{{ env('TIC_CARDS_CAT_IMG_SIZE', 100) }}" alt="">
                    <h2>{{ $category->name }}</h2>
                    <p>{{ $category->description }}</p>
                    <a href="/categories/{{ $category->id }}" class="btn btn-category-{{ $category->id }}">{{ __('Discover') }}</a>
                    <a href="#" class="btn btn-category-{{ $category->id }}" data-toggle="modal"
                       data-target="#category_{{ $category->id }}_modal">{{ __('Contribute') }}</a>
                </div>
                <div class="modal fade" id="category_{{ $category->id }}_modal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Add {{ $category->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/activities" method="post">
                                @csrf
                                <div class="modal-body text-left">

                                    <!-- Start form to add activity -->
                                    <div class="form-group row">
                                        <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputTitle" name="title"
                                                   placeholder="Nice App" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputContent" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputContent" name="content"
                                                   placeholder="This app makes you happy..." required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputType" class="col-sm-2 col-form-label">Type</label>
                                        <div class="col-sm-10">
                                            @foreach($category->types as $type)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type_id"
                                                           id="type{{ $type->id }}" value="{{ $type->id }}" required>
                                                    <label class="form-check-label"
                                                           for="type{{ $type->id }}">{{ ucwords($type->title) }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputLink" class="col-sm-2 col-form-label">Link</label>
                                        <div class="col-sm-10">
                                            <input type="url" class="form-control" id="link" name="link"
                                                   placeholder="https://" required>
                                            <small id="urlHelp" class="form-text text-muted">Dont forget to put https://
                                                or http:// at the beginning.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Abort</button>
                                    <button type="submit" class="btn btn-category-{{ $category->id }}">
                                        Add {{ $category->name }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
