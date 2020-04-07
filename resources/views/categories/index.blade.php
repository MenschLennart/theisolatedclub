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


        @foreach($categories as $category)
        <div class="category-{{ $category->id }} row h-auto justify-content-center align-items-center p-2 p-md-4 mb-md-4">
            <div class="col-12 p-4 text-center">
                <img src="{{ asset('img/category_' . $category->id) }}.png"
                     width="{{ env('TIC_CARDS_CAT_IMG_SIZE', 100) }}"
                     height="{{ env('TIC_CARDS_CAT_IMG_SIZE', 100) }}" alt="">
                <h2>{{ $category->name }}</h2>
                <p>{{ $category->description }}</p>
                <a href="#" class="btn btn-category-{{ $category->id }}" data-toggle="modal"
                   data-target="#category_{{ $category->id }}_modal">{{ __('Contribute!') }}</a>
            </div>
        </div>
        @endforeach

    </div>
@endsection
