<?php


namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct() {
        //$this->middleware('guest');
    }

    public function showActivities($id) {
        if($user = User::find($id)) {
            return view('profile', [
                'activities' => $user->activities()->paginate(10)
            ]);
        }

        return redirect('/', 301);
    }
}
