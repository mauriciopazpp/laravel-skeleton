<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionUser extends Model
{

	protected $table = 'permission_user';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['expires'];

}
