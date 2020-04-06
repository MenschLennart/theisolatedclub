@extends('layout.app')
@section('content')
    <div class="container-fluid">

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Category Games -->
        @isset($games)
            <div class="games row p-2 p-md-4 mb-md-4">
                <div class="col-sm-12 col-md-4 col-xl-3 text-center">
                    <img src="{{ asset('img/category_' . $categories[0]->id) }}.png" width="100" height="100" alt="">
                    <h2>{{ $categories[0]->name }}</h2>
                    <p>{{ $categories[0]->description }}</p>
                </div>
                @foreach ($games as $game)
                    <div class="col-sm-6 col-md-auto p-3">
                        <div class="card bg-light mb-3">
                            <div class="card-header text-muted">
                                <img class="mr-1" src="/img/type_{{ $game->type_id }}.png" width="40" height="40" alt="">
                                {{ $types[$game->type_id - 1]->title }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $game->title }}</h5>
                                <p class="card-text">{{ $game->content }}</p>
                                <a href="{{ $game->link }}" target="_blank" class="btn btn-games">Ausprobieren!</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset

    <!-- Category Sports & Wellness -->
        @isset($sports)
            <div class="sports row p-2 p-md-4 mb-md-4">
                <div class="col-sm-12 col-md-4 col-xl-3 pb-2 text-center">
                    <img src="{{ asset('img/category_' . $categories[1]->id) }}.png" width="100" height="100" alt="">
                    <h2>{{ $categories[1]->name }}</h2>
                    <p>{{ $categories[1]->description }}</p>
                </div>
                @foreach ($sports as $sport)
                    <div class="col-sm-6 col-md-auto p-3">
                        <div class="card bg-light mb-3">
                            <div class="card-header text-muted">
                                <img class="mr-1" src="/img/type_{{ $sport->type_id }}.png" width="40" height="40" alt="">
                                {{ $types[$sport->type_id - 1]->title }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $sport->title }}</h5>
                                <p class="card-text">{{ $sport->content }}</p>
                                <a href="{{ $sport->link }}" target="_blank" class="btn btn-sports">Ausprobieren!</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            </section>
        @endisset

    <!-- Category Foods & Recipes -->
        @isset($foods)
            <div class="foods row p-2 p-md-4 mb-md-4">
                <div class="col-sm-12 col-md-4 col-xl-3 pb-2 text-center">
                    <img src="{{ asset('img/category_' . $categories[2]->id) }}.png" width="100" height="100" alt="">
                    <h2>{{ $categories[2]->name }}</h2>
                    <p>{{ $categories[2]->description }}</p>
                </div>
                @foreach ($foods as $food)
                    <div class="col-sm-6 col-md-auto p-3">
                        <div class="card bg-light mb-3">
                            <div class="card-header text-muted">
                                <img class="mr-1" src="/img/type_{{ $food->type_id }}.png" width="40" height="40" alt="">
                                {{ $types[$food->type_id - 1]->title }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $food->title }}</h5>
                                <p class="card-text">{{ $food->content }}</p>
                                <a href="{{ $food->link }}" target="_blank" class="btn btn-foods">Ausprobieren!</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset

    <!-- Category Communication -->
        @isset($communications)
            <div class="communications row p-2 p-md-4 mb-md-4">
                <div class="col-sm-12 col-md-4 col-xl-3 pb-2 text-center">
                    <img src="{{ asset('img/category_' . $categories[3]->id) }}.png" width="100" height="100" alt="">
                    <h2>{{ $categories[3]->name }}</h2>
                    <p>{{ $categories[3]->description }}</p>
                </div>
                @foreach ($communications as $communication)
                    <div class="col-sm-6 col-md-auto p-3">
                        <div class="card bg-light mb-3">
                            <div class="card-header text-muted">
                                <img class="mr-1" src="/img/type_{{ $communication->type_id }}.png" width="40" height="40" alt="">
                                {{ $types[$communication->type_id - 1]->title }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $communication->title }}</h5>
                                <p class="card-text">{{ $communication->content }}</p>
                                <a href="{{ $communication->link }}" target="_blank" class="btn btn-communications">Ausprobieren!</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset


    </div>
@endsection
