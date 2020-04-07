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
                <div class="category_row_{{ $category->id }} row h-auto justify-content-center align-items-center p-2 p-md-4 mb-md-4">
                    <div class="col-sm-12 col-md-4 col-xl-2 p-4 text-center">
                            <img src="{{ asset('img/category_' . $category->id) }}.png"
                                 width="{{ env('TIC_CARDS_CAT_IMG_SIZE', 100) }}"
                                 height="{{ env('TIC_CARDS_CAT_IMG_SIZE', 100) }}" alt="">
                            <h2>{{ $category->name }}</h2>
                            <p>{{ $category->description }}</p>
                        <a href="#" class="btn btn-category_{{ $category->id }}" data-toggle="modal" data-target="#addActivityModal">{{ __('Contribute!') }}</a>
                    </div>
                    @isset($activities)
                        @isset($activities[$category->id])
                            @foreach($activities[$category->id] as $activity)
                                <div class="activities col-sm-12 col-md-4 col-xl-3 p-3">
                                    <div class="card bg-light">
                                        <div class="card-header text-muted">
                                            <img class="mr-1" src="/img/type_{{ $activity->type_id }}.png"
                                                 width="{{ env('TIC_CARDS_TYP_IMG_SIZE', 40) }}"
                                                 height="{{ env('TIC_CARDS_TYP_IMG_SIZE', 40) }}" alt="">
                                            {{ $types[$activity->type_id]->title }}
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $activity->title }}</h5>
                                            <p class="card-text">{{ $activity->content }}</p>
                                            <a href="{{ $activity->link }}" target="_blank"
                                               class="btn btn-category_{{ $category->id }}">{{ __('Try it!') }}</a>
                                        </div>
                                        <div class="card-footer text-muted text-right">
                                            {{ __('Posted by:') }} <a href="{{ route('userActivities', $activity->user->id) }}">{{ $activity->user->username }}</a>
                                        </div>
                                    </div>
                                </div>
                                @break($loop->iteration == env('TIC_CARDS_MAX', 5))
                            @endforeach
                        @endisset
                    @endisset
                </div>
            @endforeach
        @endisset

    </div>
@endsection
