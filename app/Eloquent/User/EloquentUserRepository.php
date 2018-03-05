<?php namespace App\Eloquent\User;

use DB;
use Defender;
use App\Model\Role;
use App\Model\User;
use Carbon\Carbon;
use App\Helpers\HelperFileTreatment;
use App\Eloquent\Permission\EloquentPermissionRepository;

class EloquentUserRepository
{
	protected $model;

	function __construct()
	{
		$this->model = new User();
	}

	public function get()
	{
		return $this->model->orderBy('id', 'desc')->get();
	}
	
	public function name($name = null)
	{
		return $this->model->where('name', $name)->first();
	}

	public static function isJoined($query, $table)
    {
        $joins = $query->getQuery()->joins;
        if($joins == null) {
            return false;
        }
        foreach ($joins as $join) {
            if ($join->table == $table) {
                return true;
            }
        }
        return false;
    }

	public function find($id, $withTrashed = false)
	{
	    $variable = $this->model->withTrashed()->find($id);
	    if($withTrashed)
	    	return $variable;
	    if($variable and $variable->trashed())
	        return false;
	    return $variable;
	}
	
	public function all()
	{
		return $this->model->orderBy('id', 'desc')->paginate(9);
	}

	public function toDropdown()
	{
		return $this->model->orderBy('id', 'desc')->get();
	}

	public function lists($field)
	{
		return $this->model->orderBy('id')->lists($field)->toArray();
	}

	public function create($request)
	{
		$file = new HelperFileTreatment();
		$picture = 'name.png';
		if(array_key_exists('picture', $request)){
		    $picture = $file->moveUploadedFile($request['picture'], 'users' . DIRECTORY_SEPARATOR);
		}
		$request['password'] = bcrypt($request['password']);
		$request['picture'] = $picture;

		return $this->model->create($request);
	}

	public function update($request)
	{	
	    $file = new HelperFileTreatment;

    	$user = User::find($request['id']);

        $roles = [];
        if(isset($user->roles))
	    	foreach ($user->roles as $role) {
	    		$roles[] = $role->id;
	    	}
        if(in_array('1', $roles))
        	$request['role'][] = "1";

	    if(isset($request['picture']) && $request['picture'] != null && $user->picture != 'name.png')
	        $file->destroy($user->picture, DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR);

	    if(isset($request['picture']) && $request['picture'] != null)
	    {
	        $request['picture'] = $file->moveUploadedFile($request['picture'], 'users' . DIRECTORY_SEPARATOR);
	        $user->picture = $request['picture'];
	    }

	    if(array_key_exists('password', $request)  && $request['password'] == '')
	        unset($request['password']);

	    if(array_key_exists('password', $request))
	    	$request['password'] = bcrypt($request['password']);

	    if(array_key_exists('roles', $request) && $request['roles'] == '')
	        $request['roles'] = $user->role;

	    $user->fill($request);

	    $user->update($request);

	    if(!Defender::hasPermission('user.edit'))
	    	return $user;

	    $roles = [];
		foreach ($user->roles as $role) {
			$roles[] = $role->id;
		}
	    if(in_array(['1'], $roles))
	    	$request['role'][] = "1";

	    if(array_key_exists('role', $request))
    		$user->syncRoles($request['role']);

	    if(!array_key_exists('role', $request) && !$user->hasRole('superuser'))
	     	$user->syncRoles([]);

    	if(!array_key_exists('role', $request) && $user->hasRole('superuser'))
	     	$user->syncRoles([1]);

	    if(!array_key_exists('permissionUser', $request))
	    	return $user->syncPermissions([]);

	    $permissionsUser = [];
    	foreach ($request['permissionUser'] as $permissionUser)
			$permissionsUser[$permissionUser] = ['value' => true];

    	$user->syncPermissions($permissionsUser);

	    return $user;
	}

	public function destroy($request)
	{
		return $this->model->destroy($request);
	}

	public function restore($id)
	{
		return $this->model->where('id', $id)->restore();
	}

	public function trash()
	{
		return $this->model->onlyTrashed()->paginate(9);
	}

	public function search($request)
	{
		if(!count($request))
			return $this->all();

		$query = $this->model;

		if(array_key_exists('name', $request) and $request['name'])
			$query = $query->orWhere('name', 'like', "%" .$request["name"] . "%");

        if(array_key_exists('email', $request) and $request['email'])
        	$query = $query->where('email', 'like', "%".trim($request['email']) . "%");

        if(array_key_exists('created_at', $request) and $request['created_at'])
        {
        	$start = Carbon::parse(str_replace('/', '-', $request['created_at']))->format('Y-m-d 00:00:00');
	        $end = Carbon::parse(str_replace('/', '-', $request['created_at']))->format('Y-m-d 23:59:59');

        	$query = $query->whereBetween('created_at', array($start,$end));
        }

        if(array_key_exists('updated_at', $request) and $request['updated_at'])
        {
        	$start = Carbon::parse(str_replace('/', '-', $request['updated_at']))->format('Y-m-d 00:00:00');
	        $end = Carbon::parse(str_replace('/', '-', $request['updated_at']))->format('Y-m-d 23:59:59');

        	$query = $query->whereBetween('updated_at', array($start,$end));
        }

        return $query->orderBy('id', 'desc')->paginate(20);
	}
}