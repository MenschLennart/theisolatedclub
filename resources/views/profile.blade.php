@extends('layout.simple')
@section('breadcrumbs')
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Activities</li>
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

        @isset($activities)
            <div class="table-responsive">
                <table class="table table-hover table-striped font-weight-lighter">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Activity</th>
                        <th scope="col">Category</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activities as $activity)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $activity->title }}</td>
                            <td>{{ $activity->category->name }}</td>
                            <td>{{ $activity->type->title }}</td>
                            <td>
                                <ul class="list-inline list-group list-group-horizontal">
                                    <li class="list-inline-item"><a class="btn btn-primary btn-sm"
                                                                    href="{{ $activity->link }}" target="_blank"
                                                                    role="button">Link</a></li>
                                    @if(Auth()->check())
                                        <li class="list-inline-item"><a class="btn btn-warning btn-sm"
                                                                        href="{{ route('activities.edit', $activity->id) }}"
                                                                        role="button">{{ __('Edit') }}</a></li>
                                        <form action="/activities/{{ $activity->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <li class="list-inline-item">
                                                <button type="submit"
                                                        class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </li>
                                        </form>
                                    @endif
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-center align-content-center">
                {{ $activities->links() }}
            </div>

        @endisset
    </div>
@endsection
