@foreach ($comments as $comment)
    <div class="comments row no-gutters p-2">
        <div class="card w-100">
            <div class="row no-gutters">
                <div class="user-area col-md-3 col-lg-2">
                    <div class="card m-2">
                        <div class="card-body p-2 text-center">
                            <div class="row justify-content-center align-items-center no-gutters">
                                <div class="col-2 col-md-12">
                                    @if($comment->user->avatar)
                                        <img src="..." class="align-self-center" alt="...">
                                    @else
                                        <img src="{{ asset('/img/user/user.png') }}"
                                             class="align-self-center"
                                             alt="{{ $comment->user->username }}">
                                    @endif
                                </div>
                                <div class="col-10 col-md-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-text">
                                                {{ $comment->user->username }}
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card-text text-muted">
                                                Activities: {{ $comment->user->activities->count() }} Comments: {{ $comment->user->comments->count() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-lg-10 px-2">
                    <div class="row no-gutters">
                        <div class="card-body py-3">
                            @if($comment->subject)
                                <h6 class="card-title font-weight-lighter">@if($comment->parent_id)RE: @endif{{ $comment->subject }}</h6>
                            @endif
                            <div class="comment-text p-2">
                                <div class="card-text">
                                    {{ $comment->body }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row no-gutters">
                        <div class="col">
                            <div class="card-footer">
                                <div class="row no-gutters text-right align-items-center">
                                    <div class="col-6 text-left">
                                        <div class="text-muted">Posted {{ date_format($comment->created_at, 'd. M Y H:i') }}</div>
                                    </div>
                                    <div class="col-6 text-right m-0 p-0">
                                        @if(Auth()->check())
                                            <button
                                                class="btn btn-category-{{ $activity->category_id }} btn-sm"
                                                data-toggle="collapse"
                                                data-target="#replyForm{{$comment->id}}">Reply
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('activities.partials.replies', ['comments' => $comment->replies])

            <!-- START reply area -->
            @if(Auth()->check())
                <div id="replyForm{{$comment->id}}" class="replies row no-gutters collapse p-4">
                    <div class="card w-100">
                        <form action="{{ route('replies.store') }}" method="POST">
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
                                                <input type="hidden" name="comment_id"
                                                       class="form-control"
                                                       value="{{ $comment->id }}">
                                            </h6>
                                            <div class="comment-text card-text p-2">
                                                <textarea name="body" id="editorArea" class="form-control"
                                                          placeholder="Your reply..." rows="5" required></textarea>
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
                                                            Submit reply
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
            <!-- END reply area -->

        </div>
    </div>
@endforeach
