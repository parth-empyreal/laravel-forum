<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function profile(){
        return view('profile');
    }

    public function saveProfile(Request $request){

        $validator = \Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users,id,'.\Auth::user()->id,
        ]);
        if(!$validator->validate()){
            $user = \Auth::user();
            $user->email = $request->email;
            $user->save();
            $request->session()->flash('status', 'Profile updated successfully.');
            return redirect()->back();
        }
    }
}
