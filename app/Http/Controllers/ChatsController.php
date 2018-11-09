<?php

namespace App\Http\Controllers;

use App\User;
use App\Events\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
	public function __Construct()
	{
		$this->middleware('auth');
	}

    public function chat()
    {
    	return view('chat');
    }
    public function push(Request $request)
    {
    	$user = User::find(Auth::user()->id);
        $this->chatSession($request);
    	event(new Event($request->pesan, $user));
    }
    public function vue(Request $request)
    {
    	$user = Auth::user()->name;
    	dd($user);
    }

    public function textsession()
    {
        return session('textsession');
    }

    public function chatsession(Request $request)
    {
        session()->put('textsession',$request->textsession);
    }

    public function phone()
    {
        return view('chats.index');
    }
}
