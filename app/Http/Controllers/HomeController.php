<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Threads;

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

    public function myThread(Request $request){
        $threads = Threads::orderBy('id','DESC')->where('created_by',\Auth::id())->get();
        return view('my_thread',compact('threads'));
    }

    public function saveThread(Request $request){
        $threads = Threads::get();
        if(count($threads)>=5){
            Threads::orderBy('id','ASC')->where('created_by',\Auth::id())->first()->delete();
        }
        $thread = new Threads();
        $thread->title = $request->title;
        $thread->content = $request->content;
        $thread->created_by = \Auth::id();
        $thread->save();
        $request->session()->flash('status', 'Thread added successfully.');
        return redirect()->route('my_thread');
    }

    public function threads($order_by=''){
        $threads = Threads::orderBy('id','DESC')->get();
        return view('threads',compact('threads'));
    }
}
