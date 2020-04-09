<?php

namespace App\Http\Controllers;

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
     * Store activity into database
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
                'subject' => 'required|max:60',
                'text' => 'required|max:5000',
                'activity_id' => 'required', 'exists:App\Activity,id',
            ]);

            try {
                $comment = new Comment();
                $comment->fill($validateData);

                // Get user id
                $comment->user_id = Auth()->id();
                $comment->save();

            } catch (\Throwable $e) {
                report($e);
                return redirect()->route('home')->withErrors(['error' => 'Something went wrong. Reported.']);
            }

            return redirect()->route('activities.show', $comment->activity_id)->with('status', 'Comment successfully added!');
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
