<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    //
	public function __construct() {
		return $this->middleware('guest', ['except'=>'destroy']);
	}

    public function destroy() {
    	auth()->logout();
    	
    	return redirect('bbs')->with('message', '또 방문해 주세요');
    }

    public function create() {
    	return view('sessions.create');
    }

    public function store(Request $request) {
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6',
		]);
			
		// 이메일 인증했는지 안했는지 확인.
		$user_activated = User::where('email',$request->email)->get();

		// 값이 false라면 안되도록...
		if($user_activated[0]['activated'] == false){
		   return back()->with('message', '이메일 인증 부탁드립니다.');
		};

    	if(!auth()->attempt($request->only('email', 'password'), $request->has('remember'))) {
 
    		return back()->withInput();
		}		

    	//Auth::logoutOtherDevices($request->password);
    	return redirect()->intended('bbs')->with('message', '로그인');
    }   
}
