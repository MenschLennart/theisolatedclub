<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Category;
use App\Comment;
use App\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $activities = Activity::all()
            ->sortByDesc('created_at')
            ->groupBy('category_id');
        $categories = Category::all();

        return view('home', [
            'activities' => $activities,
            'categories' => $categories->getDictionary()
        ]);
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
        $validateData = $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required|max:500',
            'category_id' => 'required|exists:App\Category,id',
            'type_id' => 'required|exists:App\Type,id',
            'link' => 'required|max:255',
        ]);

        try {
            $activity = new Activity();
            $activity->fill($validateData);

            // Check if anonymous or not
            if(Auth::check()) {
                $user_id = Auth::id();
            } else {
                $user_id = 1;
            }

            $activity->user_id = $user_id;
            $activity->save();

        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('home')->withErrors(['error' => 'Something went wrong. Reported.']);
        }

        return redirect()->route('home')->with('status', 'Activity successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse | View
     */
    public function show($id)
    {
        try {
            $activity = Activity::find($id);
            $comments = Comment::where('activity_id', $id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('home')->withErrors(['error' => 'Activity does not exist!']);
        }

        return view('activities.show', [
            'activity' => $activity,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function edit($id)
    {
        $activity = Activity::find($id);
        $response = Gate::inspect('edit-activity', $activity);

        if($response->allowed()) {
            $categories = Category::all();
            $types = Type::all();

            return view('activities.edit', [
                'activity' => $activity,
                'categories' => $categories->getDictionary(),
                'types' => $types->getDictionary(),
            ]);
        }

        return redirect()->route('myActivities')->withErrors(['error' => 'You\'re not allowed!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $activity = Activity::find($id);
        $response = Gate::inspect('update-activity', $activity);

        if ($response->denied())
            return redirect()->route('home')->withErrors(['error' => 'Permission denied!']);

        try {
            $validateData = $this->validate($request, [
                'title' => 'required|max:255',
                'content' => 'required|max:500',
                'category_id' => 'required|exists:App\Category,id',
                'type_id' => 'required|exists:App\Type,id',
                'link' => 'required|max:255',
            ]);

            $activity = Activity::find($id);
            $activity->fill($validateData);
            $activity->save();

        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('myActivities')->withException($e);
        }

        return redirect()->route('myActivities')->with('status', 'Activity successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $activity = Activity::find($id);
        $response = Gate::inspect('delete-activity', $activity);

        if ($response->denied())
            return redirect()->route('home')->withErrors(['error' => 'Permission denied!']);

        try {
            Activity::destroy($id);
        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('myActivities')->withException($e);
        }

        return redirect()->route('myActivities')->with('status', 'Activity successfully deleted!');
    }
}
