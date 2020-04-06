<?php


namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct() {

    }

    public function showUserActivities($id) {
        if(Auth()->check()) {
            if(Auth()->user()->id == $id) {
                return redirect()->route('myActivities');
            }
        }

        if($user = User::find($id)) {
            return view('profile', [
                'activities' => $user->activities()->paginate(10)
            ]);
        }

        return redirect('/', 301);
    }
}
