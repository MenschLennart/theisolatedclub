<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store comment into database
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $response = Gate::inspect('create-comment');

        if($response->allowed()) {
            $validateData = $this->validate($request, [
                'subject' => 'nullable', 'string', 'max:64',
                'body' => 'required|max:3000',
                'activity_id' => 'required', 'exists:App\Activity,id',
            ]);

            try {
                $comment = new Comment();
                $comment->fill($validateData);
                $comment->user()->associate($request->user());

                $activity = Activity::find($request->activity_id);
                $activity->comments()->save($comment);

            } catch (\Throwable $e) {
                report($e);
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }

            return redirect()->back()->with('status', 'Comment successfully created!');
        }

        return redirect()->route('login');
    }

    /**
     * Store reply into database
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function replyStore(Request $request) {
        $response = Gate::inspect('create-comment');

        if($response->allowed()) {
            $validateData = $this->validate($request, [
                'subject' => 'nullable', 'string', 'max:64',
                'body' => 'required|max:3000',
                'activity_id' => 'required', 'exists:App\Activity,id',
                'comment_id' => 'required', 'exists:App\Comment,id',
            ]);

            try {
                $reply = new Comment();
                $reply->fill($validateData);

                // Associate user
                $reply->user()->associate($request->user());

                // Set comment id as parent
                $reply->parent_id = $request->get('comment_id');

                $activity = Activity::find($request->get('activity_id'));
                $activity->comments()->save($reply);
            } catch (\Throwable $e) {
                report($e);
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }

            return redirect()->back()->with('status', 'Reply successfully created!');
        }

        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
