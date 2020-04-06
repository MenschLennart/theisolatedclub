<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Category;
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
        $types = Type::all();

        return view('home', [
            'activities' => $activities,
            'categories' => $categories,
            'types' => $types->getDictionary(),
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
            Auth::id() ? $activity->user_id = Auth::id() : $activity->user_id = 1;

            $activity->save();

        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('home')->with('status', 'Something went wrong! Reported.');
        }

        return redirect()->route('home')->with('status', 'Activity successful added!');
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
                'categories' => $categories,
                'types' => $types->getDictionary(),
            ]);
        }

        return redirect()->route('myActivities')->withErrors(['error1' => 'You\'re not allowed!']);
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
