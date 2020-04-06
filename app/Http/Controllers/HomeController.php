<?php


namespace App\Http\Controllers;
use App\Activity;
use App\Category;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{

    public function __construct()
    {

    }

    public function getActivityByCategory($category) {
        $activities = Activity::where('category_id', $category);
        return ($activities);
    }

    public function getActivities() {
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

    public function addActivity(Request $request) {

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

        } catch (ValidationException $e) {
            // something went wrong. No error handling for now.
            // Need to catch Exception here for logging and show error message to user.
        }

        return redirect('/')->with('status', 'Activity successfully created!');
    }
}
