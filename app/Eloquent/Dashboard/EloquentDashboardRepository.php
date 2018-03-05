<?php namespace App\Eloquent\Dashboard;

use Illuminate\Support\Facades\Auth;

class EloquentDashboardRepository
{
	public function init()
	{
		$widgets = [];
		
		$widgets['example'] = $this->exampleWidget();
		$widgets['example2'] = $this->exampleWidget2();

		return $widgets;
	}

	public function exampleWidget()
	{
		return Auth::user();
	}

	public function exampleWidget2()
	{
		return Auth::user();
	}
}