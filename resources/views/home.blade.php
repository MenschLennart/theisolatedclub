@extends('layout.lead')
@section('breadcrumbs')
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
        </nav>
    </section>
@endsection
@section('content')
    <div class="container-fluid">

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

        @isset($categories)
            @foreach($categories as $category)
                <div
                    class="category-{{ $category->id }} row row-cols-1 row-cols-md-2 justify-content-center p-2 p-md-4 mb-md-4">
                    <div class="col-sm-12 col-md-5 col-xl-3 h-100 p-4 text-center">
                        <img src="{{ asset('img/category_' . $category->id) }}.png"
                             width="{{ env('TIC_CARDS_CAT_IMG_SIZE', 100) }}"
                             height="{{ env('TIC_CARDS_CAT_IMG_SIZE', 100) }}" alt="">
                        <h2>{{ $category->name }}</h2>
                        <p>{{ $category->description }}</p>
                        @if(Auth()->guest())
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#loginOrRegisterModal">{{ __('Contribute!') }}</button>
                        @else
                            <a href="#" class="btn btn-category-{{ $category->id }}" data-toggle="modal"
                               data-target="#category_modal"
                               data-title="{{ $category->name }}"
                               data-category_id="{{ $category->id }}"
                               data-types="{{ $category->types }}">{{ __('Contribute!') }}</a>
                        @endif
                        <a href="{{ route('categories.show', $category->id) }}"
                           class="btn btn-category-{{ $category->id }}">{{ __('Discover ') }} <span
                                class="badge badge-pill badge-light">{{ ($category->activities->count()) }}</span></a>
                    </div>
                    @isset($activities)
                        @isset($activities[$category->id])
                            @foreach($activities[$category->id] as $activity)
                                <div class="activities col-sm-12 col-md-4 col-xl-3 p-3">
                                    <div class="card h-100 bg-light shadow">
                                        <div class="card-header text-muted">
                                            <img class="mr-1" src="/img/type_{{ $activity->type_id }}.png"
                                                 width="{{ env('TIC_CARDS_TYP_IMG_SIZE', 40) }}"
                                                 height="{{ env('TIC_CARDS_TYP_IMG_SIZE', 40) }}" alt="">
                                            {{ $activity->type->title }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <div class="col-12">
                                                    <a href="{{ route('activities.show', $activity->id) }}"
                                                       class="text-decoration-none text-category-{{ $category->id }}"><h5
                                                            class="card-title">{{ $activity->title }}</h5></a>
                                                    <p class="card-text">{{ $activity->content }}</p>
                                                </div>
                                                <div class="col-12 pt-3">
                                                    <a href="{{ $activity->link }}" target="_blank"
                                                       class="btn btn-category-{{ $category->id }}">{{ __('Go!') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-muted text-right">
                                            <div class="float-left">
                                                <a href="{{ route('activities.show', $activity->id) }}">{{ $activity->comments->count() }} {{ __('Comments') }}</a>
                                            </div>
                                            <div class="float-right">
                                                {{ __('Posted by:') }} <a
                                                    href="{{ route('userActivities', $activity->user->id) }}">{{ $activity->user->username }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @break($loop->iteration == env('TIC_CARDS_MAX', 5))
                            @endforeach
                            @if(env('TIC_CARDS_MAX', 5) > 0 && $category->activities->count() > env('TIC_CARDS_MAX', 5))
                                <div class="read-more col-sm-12 p-3 text-center">
                                    <a href="{{ route('categories.show', $category->id) }}"
                                       class="btn btn-category-{{ $category->id }}">
                                        {{ __('Discover') }} <span
                                            class="badge badge-pill badge-light">{{ ($category->activities->count() - env('TIC_CARDS_MAX')) }}</span> {{ __('more') }}
                                    </a>
                                </div>
                            @endif
                        @endisset
                    @endisset
                </div>
            @endforeach
        @endisset

            @if(Auth()->guest())
                <div class="modal fade" id="loginOrRegisterModal" tabindex="-1" role="dialog" aria-labelledby="loginOrRegisterModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Login or Register</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                It's great you want to contribute. You're just little step away! Please login, or register an account.
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
                                    <button id="abortButton" type="button" class="btn btn-secondary" data-dismiss="modal">Abort</button>
                                    <button id="submitButton" type="submit" class="btn">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

    </div>
@endsection
