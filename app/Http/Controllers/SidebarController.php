<?php namespace App\Http\Controllers;

use Session;
use App\Http\Requests;
use App\Dashboard\Dashboard;
use Illuminate\Http\Request;
use App\Protocol\ProtocolMaker;
use Illuminate\Support\Facades\Auth;
use App\Eloquent\User\EloquentUserRepository;

class SidebarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Envia para a sessão a resolução do monitor
     * 
     * @param  Request $request Dados do usuário
     * @return VOID             NULL
     */
    public function resolution(Request $request)
    {   
        Session::put('resolutionWidth', $request->width);
        Session::put('resolutionHeight', $request->height);
    }

    /**
     * Envia para a sessão do usuário qual o tipo de sidebar ele quer usar
     * 
     * @param  Request $request Dados do usuário
     * @return VOID             NULL
     */
    public function sidebarMini(Request $request)
    {
        Session::put('position', $request->position);
    }
}
