<?php namespace App\Http\Controllers;

use App\Eloquent\Dashboard\EloquentDashboardRepository;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(EloquentDashboardRepository $dashboard)
    {        
    	$widgets = $dashboard->init();

        return view('dashboard', compact('widgets'));
    }
}