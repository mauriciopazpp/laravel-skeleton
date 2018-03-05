<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
	protected $table = 'role_user';

	protected $dateFormat = 'Y-m-d H:i:s';
	
	public function user()
	{
	    return $this->hasMany('App\Model\User', 'user_id');
	}
}
