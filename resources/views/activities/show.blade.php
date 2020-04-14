@extends('layout.simple')
@section('breadcrumbs')
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('activities.index') }}">Activities</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $activity->title }}</li>
            </ol>
        </nav>
    </section>
@endsection
@section('content')
    <section class="category-{{ $activity->category_id }}">
        <div class="container p-4">

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

            <div class="row no-gutters">
                <div class="col-sm-12 p-0">
                    <div class="row no-gutters p-2">
                        <div class="card w-100 bg-light shadow">
                            <div class="card-header text-muted">
                                <img class="mr-1" src="/img/type_{{ $activity->type_id }}.png"
                                     width="{{ env('TIC_CARDS_TYP_IMG_SIZE', 40) }}"
                                     height="{{ env('TIC_CARDS_TYP_IMG_SIZE', 40) }}" alt="">
                                {{ $activity->type->title }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="{{ route('activities.show', $activity->id) }}"
                                           class="text-decoration-none text-category-{{ $activity->category->id }}"><h5
                                                class="card-title">{{ $activity->title }}</h5></a>
                                        <p class="card-text">{{ $activity->content }}</p>
                                        <div class="text-center">
                                            <a href="{{ $activity->link }}" target="_blank"
                                               class="btn btn-category-{{ $activity->category_id }}">{{ __('Go to:') }} {{ $activity->title }}</a>
                                        </div>
                                    </div>
                                    @if($activity->category_id == 5)
                                        <div class="col-12 p-2 p-md-4">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe id="ytplayer" class="embed-responsive-item" type="text/html" src="https://www.youtube.com/embed/?listType=search&list={{ $activity->title }} Official Trailer&cc_load_policy=1&modestbranding=1&playsinline=1&color=white&iv_load_policy=3" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row h-auto justify-content-center align-items-center p-2">
                                    <div class="col-4 text-center"></div>
                                    <div class="col-4 text-center">
                                        @if(Auth()->guest())
                                            <a href="{{ route('login') }}" class="btn btn-secondary">Login to
                                                comment</a>
                                        @else
                                            <button class="btn btn-category-{{ $activity->category_id }}"
                                                    data-toggle="collapse"
                                                    data-target="#commentForm">Add comment
                                            </button>
                                        @endif
                                    </div>
                                    <div class="col-4 text-right">
                                        @if(Auth()->check() && Auth()->user()->id == $activity->user_id)
                                            <button class="btn btn-outline-warning" data-toggle="modal"
                                                    data-target="#commentEditModal">Edit
                                            </button>
                                            <button class="btn btn-outline-danger" data-toggle="modal"
                                                    data-target="#commentDeleteModal">Delete
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <!-- User comment form -->
                                @if(Auth()->check())
                                    <div id="commentForm" class="comments row collapse p-2">
                                        <div class="card w-100">
                                            <form action="{{ route('comments.store') }}" method="POST">
                                                @csrf
                                                <div class="row no-gutters">
                                                    <div class="user-area col-md-3 col-lg-2">
                                                        <div class="card m-2">
                                                            <div class="card-body p-2 text-center">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        @if(Auth()->user()->avatar)
                                                                            <img src="..." class="align-self-center"
                                                                                 alt="...">
                                                                        @else
                                                                            <img src="{{ asset('/img/user/user.png') }}"
                                                                                 class="align-self-center"
                                                                                 alt="{{ Auth()->user()->username }}">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="card-text">
                                                                            {{ Auth()->user()->username }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="card-text text-muted">
                                                                            Activities: {{ Auth()->user()->activities->count() }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="card-text text-muted">
                                                                            Comments: {{ Auth()->user()->comments->count() }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9 col-lg-10 px-2">
                                                        <div class="row">
                                                            <div class="card-body py-3">
                                                                <h6 class="card-title font-weight-lighter">
                                                                    <input type="text" name="subject"
                                                                           class="form-control"
                                                                           placeholder="{{ __('Subject') }}">
                                                                    <input type="hidden" name="activity_id"
                                                                           class="form-control"
                                                                           value="{{ $activity->id }}">
                                                                </h6>
                                                                <div class="comment-text card-text p-2">
                                                                    <textarea name="body" id="editorArea" class="form-control"
                                                                      placeholder="Your comment..."
                                                                      rows="5" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="row no-gutters">
                                                            <div class="col">
                                                                <div class="card-footer">
                                                                    <div class="row text-right align-items-end">
                                                                        <div class="col-12 text-center">
                                                                            <button
                                                                                type="submit"
                                                                                class="btn btn-category-{{ $activity->category_id }}">
                                                                                Submit comment
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @include('activities.partials.replies', ['comments' => $activity->comments, 'activity_id' => $activity->id])
                    {{ $comments->links() }}

                </div>
            </div>
        </div>

        @if(Auth()->check())
            @if(Auth()->user()->id == $activity->user_id)
                <div class="modal fade" id="commentEditModal" tabindex="-1" role="dialog"
                     aria-labelledby="commentModalTitle"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="commentModalTitle">{{ __('Add comment') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="p-4" action="/activities/{{ $activity->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <!-- Start form to add activity -->
                                <div class="form-group row">
                                    <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputTitle" name="title"
                                               value="{{ $activity->title }}"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputContent" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputContent" name="content"
                                               value="{{$activity->content }}" required>
                                        <input type="text" class="form-control" id="inputCategory"
                                               name="category_id" value="{{ $activity->category_id }}"
                                               hidden required>
                                        <input type="text" class="form-control" id="inputType" name="type_id"
                                               value="{{ $activity->type_id }}"
                                               hidden required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputLink" class="col-sm-2 col-form-label">Link</label>
                                    <div class="col-sm-10">
                                        <input type="url" class="form-control" id="link" name="link"
                                               value="{{ $activity->link }}" required>
                                        <small id="urlHelp" class="form-text text-muted">Dont forget to put https://
                                            or http:// at the
                                            beginning.</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button id="abortButton" type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Abort
                                        </button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </section>
@endsection
