<?php


namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function indexActivities() {
        if($activities = Auth()->user()->activities()->paginate(10)) {
            return view('profile', [
                'activities' => $activities
            ]);
        }

        return redirect('/', 301);
    }
}
