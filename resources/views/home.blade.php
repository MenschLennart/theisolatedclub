@extends('layout.home')
@section('content')
    <div class="container-fluid">

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @isset($categories)
            @foreach($categories as $category)
                <div class="category_row_{{ $category->id }} row align-items-center p-2 p-md-4 mb-md-4">
                    <div class="col-sm-12 col-md-4 col-xl-3 p-4 text-center">
                        <img src="{{ asset('img/category_' . $category->id) }}.png"
                             width="{{ env('TIC_CARDS_CAT_IMG_SIZE', 100) }}"
                             height="{{ env('TIC_CARDS_CAT_IMG_SIZE', 100) }}" alt="">
                        <h2>{{ $category->name }}</h2>
                        <p>{{ $category->description }}</p>
                    </div>
                    @isset($activities)
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
                                        {{ __('Posted by:') }} <a href="/user/{{ $activity->user->id }}/activities">{{ $activity->user->username }}</a>
                                    </div>
                                </div>
                            </div>
                            @break($loop->iteration == env('TIC_CARDS_MAX', 5))
                        @endforeach
                    @endisset
                </div>
            @endforeach
        @endisset

    </div>
@endsection
