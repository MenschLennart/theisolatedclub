<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading colorful">The Isolated Club</h1>
        <p class="lead text-muted">Most of us #stayhome and ask ourselves: What do I do now as I am isolated at home?
            Here you can find all kinds of links to apps, websites, exercises and games that support you during a
            worldwide state of emergency.</p>
        <p class="lead text-muted">And if you know a great thing you want to share with us, click the button below!</p>
        <p>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addActivityModal">{{ __('Contribute!') }}</a>
        </p>

        <!-- Modal -->
        <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Add Activity!') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/activities" method="post">
                        @csrf
                        <div class="modal-body text-left">

                            <!-- Start form to add activity -->

                            <div class="form-group row">
                                <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputTitle" name="title" placeholder="Nice App" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputContent" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputContent" name="content"
                                           placeholder="This app makes you happy..." required>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Category</legend>
                                    <div class="col-sm-4">
                                        @isset($categories)

                                            @foreach($categories as $category)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="category_id" id="category{{ $category->id }}" value="{{ $category->id }}" required>
                                                    <label class="form-check-label" for="category{{ $category->id }}">{{ ucwords($category->name) }}</label>
                                                </div>
                                            @endforeach

                                        @endisset
                                    </div>
                                    <legend class="col-form-label col-sm-2 pt-0">Type</legend>
                                    <div class="col-sm-4">
                                        @isset($types)

                                            @foreach($types as $type)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type_id" id="type{{ $type->id }}" value="{{ $type->id }}" required>
                                                    <label class="form-check-label" for="type{{ $type->id }}">{{ ucwords($type->title) }}</label>
                                                </div>
                                            @endforeach

                                        @endisset
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <label for="inputLink" class="col-sm-2 col-form-label">Link</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="link" name="link" placeholder="https://" required>
                                    <small id="urlHelp" class="form-text text-muted">Dont forget to put https:// or http:// at the beginning.</small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Abort</button>
                            <button type="submit" class="btn btn-primary">Add activity</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
