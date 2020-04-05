@extends('layout.layout')
@section('content')
    <div class="container-fluid">

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Category Games -->
        @isset($games)
            <div class="games row align-items-center p-5 mb-5">
                <div class="col text-center">
                    <h2>{{ $categories[0]->name }}</h2>
                    <p>{{ $categories[0]->description }}</p>
                </div>
                @foreach ($games as $game)
                    <div class="col">
                        <div class="card bg-light mb-3" style="width: 18rem;">
                            <div class="card-header text-muted">
                                <img class="mr-1" src="/img/type_{{ $game->type_id }}.svg" width="20" height="20" alt="">
                                {{ $types[$game->type_id - 1]->title }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $game->title }}</h5>
                                <p class="card-text">{{ $game->content }}</p>
                                <a href="{{ $game->link }}" target="_blank" class="btn btn-games">Go
                                    somewhere</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset

    <!-- Category Sports & Wellness -->
        @isset($sports)
            <div class="sports row align-items-center p-5 mb-5">
                <div class="col text-center">
                    <h2>{{ $categories[1]->name }}</h2>
                    <p>{{ $categories[1]->description }}</p>
                </div>
                @foreach ($sports as $sport)
                    <div class="col">
                        <div class="card bg-light mb-3" style="width: 18rem;">
                            <div class="card-header text-muted">
                                <img class="mr-1" src="/img/type_{{ $sport->type_id }}.svg" width="20" height="20" alt="">
                                {{ $types[$sport->type_id - 1]->title }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $sport->title }}</h5>
                                <p class="card-text">{{ $sport->content }}</p>
                                <a href="{{ $sport->link }}" target="_blank" class="btn btn-sports">Go
                                    somewhere</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            </section>
        @endisset

    <!-- Category Foods & Recipes -->
        @isset($foods)
            <div class="foods row align-items-center p-5 mb-5">
                <div class="col text-center">
                    <h2>{{ $categories[2]->name }}</h2>
                    <p>{{ $categories[2]->description }}</p>
                </div>
                @foreach ($foods as $food)
                    <div class="col">
                        <div class="card bg-light mb-3" style="width: 18rem;">
                            <div class="card-header text-muted">
                                <img class="mr-1" src="/img/type_{{ $food->type_id }}.svg" width="20" height="20" alt="">
                                {{ $types[$food->type_id - 1]->title }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $food->title }}</h5>
                                <p class="card-text">{{ $food->content }}</p>
                                <a href="{{ $food->link }}" target="_blank" class="btn btn-foods">Go
                                    somewhere</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset

    <!-- Category Communication -->
        @isset($communications)
            <div class="communications row align-items-center p-5 mb-5">
                <div class="col text-center">
                    <h2>{{ $categories[3]->name }}</h2>
                    <p>{{ $categories[3]->description }}</p>
                </div>
                @foreach ($communications as $communication)
                    <div class="col">
                        <div class="card bg-light mb-3" style="width: 18rem;">
                            <div class="card-header text-muted">
                                <img class="mr-1" src="/img/type_{{ $communication->type_id }}.svg" width="20" height="20" alt="">
                                {{ $types[$communication->type_id - 1]->title }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $communication->title }}</h5>
                                <p class="card-text">{{ $communication->content }}</p>
                                <a href="{{ $communication->link }}" target="_blank" class="btn btn-communications">Go
                                    somewhere</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset


    </div>
@endsection
