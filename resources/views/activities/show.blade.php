@extends('layout.simple')
@section('breadcrumbs')
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('myActivities') }}">Activities</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $activity->title }}</li>
            </ol>
        </nav>
    </section>
@endsection
@section('content')
    <section class="category-{{ $activity->category_id }}">
        <div class="container p-5">

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

            <div class="row">
                <div class="col-sm-12 p-3">
                    <div class="card bg-light shadow">
                        <div class="card-header text-muted">
                            <img class="mr-1" src="/img/type_{{ $activity->type_id }}.png"
                                 width="{{ env('TIC_CARDS_TYP_IMG_SIZE', 40) }}"
                                 height="{{ env('TIC_CARDS_TYP_IMG_SIZE', 40) }}" alt="">
                            {{ $activity->type->title }}
                        </div>
                        <div class="card-body">
                            <a href="{{ route('activities.show', $activity->id) }}"
                               class="text-decoration-none text-category-{{ $activity->category->id }}"><h5
                                    class="card-title">{{ $activity->title }}</h5></a>
                            <p class="card-text">{{ $activity->content }}</p>
                            <a href="{{ $activity->link }}" target="_blank"
                               class="btn btn-category-{{ $activity->category->id }}">{{ __('Go!') }}</a>
                        </div>
                        <div class="card-footer">
                            <div class="row h-auto justify-content-center align-items-center p-2">
                                <div class="col text-center">
                                    @if(Auth()->guest())
                                        <a href="{{ route('login') }}" class="btn btn-secondary">Login to comment</a>
                                    @else
                                        <button class="btn btn-category-{{ $activity->category_id }}" data-toggle="modal"
                                                data-target="#commentModal">Add comment
                                        </button>
                                    @endif
                                </div>
                            </div>
                            @foreach ($comments as $comment)
                                <div class="comments row p-2">
                                    <div class="card w-100">
                                        <div class="row no-gutters">
                                            <div class="user-area col-md-3 col-lg-2">
                                                <div class="card m-2">
                                                    <div class="card-body p-2 text-center">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                @if($comment->user->avatar)
                                                                    <img src="..." class="align-self-center" alt="...">
                                                                @else
                                                                    <img src="{{ asset('/img/user/user.png') }}"
                                                                         class="align-self-center"
                                                                         alt="{{ $comment->user->username }}">
                                                                @endif
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="card-text">
                                                                    {{ $comment->user->username }}
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="card-text text-muted">
                                                                    Activities: {{ $comment->user->activities->count() }}
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="card-text text-muted">
                                                                    Comments: {{ $comment->user->comments->count() }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-lg-10 px-2">
                                                <div class="row">
                                                    <div class="card-body py-3">
                                                        <h6 class="card-title font-weight-lighter">{{ $comment->subject }}</h6>
                                                        <div class="comment-text card-text font-weight-lighter p-2">
                                                            {{ $comment->text }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row no-gutters">
                                                    <div class="col">
                                                        <div class="card-footer">
                                                            <div class="text-right text-muted">
                                                                Created: {{ $comment->created_at }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{ $comments->links() }}
                        </div>
                    </div>
                </div>
            </div>

            @if(Auth()->check())
                <div class="modal fade" id="commentModal" tabindex="-1" role="dialog"
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
                            <form action="/comments" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <input type="text" name="subject" class="form-control"
                                                   placeholder="{{ __('Subject') }}">
                                            <input type="activity_id" name="activity_id" class="form-control"
                                                   value="{{ $activity->id }}" hidden>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <textarea name="text" class="form-control" placeholder="Your comment..."
                                                      rows="5" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save comment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

    </section>
@endsection
