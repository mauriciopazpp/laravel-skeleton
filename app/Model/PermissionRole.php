<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{

	protected $table = 'permission_role';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['expires'];

	public function role(){
	    return $this->hasMany('App\Model\Role');
	}
}
