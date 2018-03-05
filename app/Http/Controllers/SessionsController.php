<?php namespace App\Http\Controllers;

use Session;
use App\Model\Online;
use Illuminate\Http\Request;

class SessionsController  extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, Online $sessions)
    {
    	$sessions = $sessions->paginate(25);
    	
        return view('sessions.index', compact('sessions', 'request'));     
    }

    public function logout(Request $request, $user_id)
    {
    	if(Online::where('user_id',$user_id)->delete())
    	{
    		Session::flush('success', 'O usuário foi deslogado!');
    		return redirect()->to('report/sessions/');
    	}
		Session::flush('warning', 'Você não pode deslogar este usuário');

		return redirect()->to('report/sessions');
    }
}
