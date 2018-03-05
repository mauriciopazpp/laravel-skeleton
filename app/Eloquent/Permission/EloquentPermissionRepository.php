<?php namespace App\Eloquent\Permission;

use App\Model\Role;
use App\Model\Permission;
use Carbon\Carbon;

class EloquentPermissionRepository
{
	protected $model;

	function __construct()
	{
		$this->model = new Permission();
	}
	
	public function all()
	{
		return $this->model->orderBy('id', 'desc')->paginate(50);
	}

	public function update($request)
	{
		$permission = \App\Model\Permission::find($request['id']);
		return $permission->update($request);
	}

	public function noPaginate()
	{
		return $this->model->orderBy('id', 'desc')->get();
	}

	public function except($name)
	{
		return $this->model->where('name','<>',$name)->get();
	}

	public function permissionUser($user)
	{
		$allPermissions = [];
		$userPermissions = [];
		$response = null;

		$permissionsArray = $this->noPaginate()->toArray();
		foreach ($permissionsArray as $permission)
			$allPermissions[$permission['id']] = $permission['id'];
		
		foreach ($user->role as $role)
			foreach ($role->permissions->toArray() as $permission)
				$userPermissions[$permission['id']] = $permission['id'];

		$permissionUser = array_diff($allPermissions,$userPermissions);

		foreach ($permissionUser as $id)
			$response[$id] = $this->model->find($id);
		
		return $response;
	}
}