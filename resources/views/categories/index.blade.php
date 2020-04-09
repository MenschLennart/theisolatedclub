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
                    <a href="/categories/{{ $category->id }}" class="btn btn-category-{{ $category->id }}">{{ __('Discover') }} <span class="badge badge-pill badge-light">{{ ($category->activities->count()) }}</span></a>
                    @if(Auth()->guest())
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#loginOrRegisterModal">{{ __('Contribute!') }}</button>
                    @else
                        <a href="#" class="btn btn-category-{{ $category->id }}" data-toggle="modal"
                           data-target="#category_modal"
                           data-title="{{ $category->name }}"
                           data-category_id="{{ $category->id }}"
                           data-types="{{ $category->types }}">{{ __('Contribute!') }}</a>
                    @endif
                </div>
            @endforeach
        </div>

        @if(Auth()->guest())
            <div class="modal fade" id="loginOrRegisterModal" tabindex="-1" role="dialog"
                 aria-labelledby="loginOrRegisterModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Login or Register</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            It's great you want to contribute. You're just little step away! Please login, or register
                            an account.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a href="{{ route('login') }}" type="button" class="btn btn-primary">Login</a>
                            <a href="{{ route('register') }}" type="button" class="btn btn-primary">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="modal fade" id="category_modal" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="activityTitle"></h5>
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
                                    <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="category_id"
                                                   id="inputCategory" checked required>
                                            <label id="labelCategory" class="form-check-label"
                                                   for="inputCategory"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputType" class="col-sm-2 col-form-label">Type</label>
                                    <div id="typesArea" class="col-sm-10"></div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputLink" class="col-sm-2 col-form-label">Link</label>
                                    <div class="col-sm-10">
                                        <input type="url" class="form-control" id="inputLink" name="link"
                                               placeholder="https://" required>
                                        <small id="urlHelp" class="form-text text-muted">Dont forget to put https://
                                            or http:// at the beginning.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="abortButton" type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Abort
                                </button>
                                <button id="submitButton" type="submit" class="btn">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
