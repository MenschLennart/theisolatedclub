<?php


namespace App\Http\Controllers;
use App\Activity;
use App\User;
use App\Category;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    const CATEGORY_GAMES = 1;
    const CATEGORY_SPORTS = 2;
    const CATEGORY_FOODS = 3;
    const CATEGORY_COMMUNICATIONS = 4;

    public function __construct()
    {

    }

    public function getUserActivities($id) {
        $activities = User::find($id)->activities()->get();
        return ($activities);
    }

    public function getActivityByCategory($category) {
        $activities = Activity::where('category_id', $category);
        return ($activities);
    }

    public function getActivities() {
        $games = Activity::where('category_id', self::CATEGORY_GAMES)->get();
        $sports = Activity::where('category_id', self::CATEGORY_SPORTS)->get();
        $foods = Activity::where('category_id', self::CATEGORY_FOODS)->get();
        $communications = Activity::where('category_id', self::CATEGORY_COMMUNICATIONS)->get();

        $categories = Category::all();
        $types = Type::all();

        return view('home', [
            'games' => $games,
            'sports' => $sports,
            'foods' => $foods,
            'communications' => $communications,
            'categories' => $categories,
            'types' => $types
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

        $activity = new Activity();
        $activity->fill($validateData);

        // Check if anonymous or not
        $userId = Auth::id();
        $userId ? $activity->user_id = $userId : $activity->user_id = 1;

        $activity->save();
        return redirect('/')->with('status', 'Activity successfully created!');
    }
}
