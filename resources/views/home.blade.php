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
                    class="category-{{ $category->id }} row h-auto justify-content-center align-items-center p-2 p-md-4 mb-md-4">
                    <div class="col-sm-12 col-md-4 col-xl-2 p-4 text-center">
                        <img src="{{ asset('img/category_' . $category->id) }}.png"
                             width="{{ env('TIC_CARDS_CAT_IMG_SIZE', 100) }}"
                             height="{{ env('TIC_CARDS_CAT_IMG_SIZE', 100) }}" alt="">
                        <h2>{{ $category->name }}</h2>
                        <p>{{ $category->description }}</p>
                        <a href="#" class="btn btn-category-{{ $category->id }}" data-toggle="modal"
                           data-target="#category_{{ $category->id }}_modal">{{ __('Contribute!') }}</a>
                    </div>
                    @isset($activities)
                        @isset($activities[$category->id])
                            @foreach($activities[$category->id] as $activity)
                                @break($loop->iteration == env('TIC_CARDS_MAX', 5))
                                <div class="activities col-sm-12 col-md-4 col-xl-3 p-3">
                                    <div class="card bg-light">
                                        <div class="card-header text-muted">
                                            <img class="mr-1" src="/img/type_{{ $activity->type_id }}.png"
                                                 width="{{ env('TIC_CARDS_TYP_IMG_SIZE', 40) }}"
                                                 height="{{ env('TIC_CARDS_TYP_IMG_SIZE', 40) }}" alt="">
                                            {{ $category->types->getDictionary()[$activity->type_id]->title }}
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $activity->title }}</h5>
                                            <p class="card-text">{{ $activity->content }}</p>
                                            <a href="{{ $activity->link }}" target="_blank"
                                               class="btn btn-category-{{ $category->id }}">{{ __('Try it!') }}</a>
                                        </div>
                                        <div class="card-footer text-muted text-right">
                                            {{ __('Posted by:') }} <a
                                                href="{{ route('userActivities', $activity->user->id) }}">{{ $activity->user->username }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                @if(env('TIC_CARDS_MAX', 5) > 0 && $activities[$category->id]->count() > env('TIC_CARDS_MAX', 5))
                                    <div class="read-more col-sm-12 p-3 text-center">
                                        <a href="categories/{{ $category->id }}" class="btn btn-category-{{ $category->id }}">
                                            {{ __('Discover') }} <span class="badge badge-pill badge-light">{{ ($activities[$category->id]->count() - env('TIC_CARDS_MAX')) }}</span> {{ __('more') }}
                                        </a>
                                    </div>
                                @endif
                        @endisset
                    @endisset
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
                                        <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="category_id"
                                                       id="category{{ $category->id }}" value="{{ $category->id }}"
                                                       checked required>
                                                <label class="form-check-label"
                                                       for="category{{ $category->id }}">{{ ucwords($category->name) }}</label>
                                            </div>
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
        @endisset

    </div>
@endsection
