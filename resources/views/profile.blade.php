@extends('layout.app')
@section('content')
    <div class="container-fluid">
        @isset($activities)
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Activity</th>
                        <th scope="col">Category</th>
                        <th scope="col">Type</th>
                        <th scope="col"></th>
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
                                <a href="{{ $activity->link }}">
                                    <button type="button" class="btn btn-outline-primary">Link</button>
                                </a>
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
