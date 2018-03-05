<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Exibe as notificações no sidebar header
     * 
     * @param  HelperNotifications                       Classe de notificações
     * @return JSON                                      JSON dos beneficiários
     */
    public function get(Request $request)
    {
        //return Notifications::get();
    }
}
