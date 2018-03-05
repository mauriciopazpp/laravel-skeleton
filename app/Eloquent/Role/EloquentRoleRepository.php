<?php namespace App\Eloquent\Role;

use App\Model\Role;
use App\Model\Permission;
use Carbon\Carbon;
use DB;

class EloquentRoleRepository
{
	protected $model;

	function __construct()
	{
		$this->model = new Role();
	}

	public function name($name = null)
	{
		return $this->model->where('name', $name)->first();
	}

	public function toDropdown()
	{
		return $this->model->orderBy('id', 'desc')->get();
	}
	
	public function find($id)
	{
	    return $this->model->find($id);
	}
	
	public function all()
	{
		return $this->model->orderBy('id', 'desc')->paginate(15);
	}

	public function noPaginate()
	{
		return $this->model->orderBy('id', 'desc')->get();
	}

	public function except($name)
	{
		return $this->model->where('name','<>',$name)->get();
	}

	public function lists($field)
	{
		return $this->model->orderBy('id')->lists($field)->toArray();
	}

	public function create($request)
	{	
		$role = $this->model->create($request);
		foreach ($request['permission'] as $permission) 
			$role->attachPermission(Permission::find($permission));
		return $role;
	}

    public function update($request)
    {
    	$role = $this->find($request['id']);
        $role->fill($request);   
        $request['value'] = '1';
        $role->update($request);

        /*problema com versoes do laravel | única forma de resolver até o momento*/
        $permissionRoles = \App\Model\PermissionRole::where('role_id', $role->id)->get()->toArray();

        if(count($permissionRoles) > 0)
        {
            foreach ($permissionRoles as $permissionRole) {
                if($permissionRole['role_id']){
                    \DB::statement(\DB::raw("DELETE from permission_role WHERE role_id = :role_id"), 
                        ['role_id' => $permissionRole['role_id']]);
                }
            }
        }

        if(array_key_exists('permission', $request) and $request['permission'])
        {
            foreach (array_values ($request['permission']) as $permission) {
                $permission = \App\Model\Permission::find($permission);
                if($permission and $role)
                	$role->attachPermission($permission);
            }
        }
        /*problema com versoes do laravel | única forma de resolver até o momento*/
        return $role;
    }

	public function destroy($role)
	{
		return $this->model->destroy($role->id);
	}

	public function search($request)
	{

		if(!count($request))
			return $this->all();

		$query = $this->model;
		
		if(array_key_exists('name', $request) and $request['name'])
			$query = $query->where('name', 'like', "%" .$request["name"] . "%");

        if(array_key_exists('name', $request) and $request['created_at'])
        {
        	$start = Carbon::parse(str_replace('/', '-', $request['created_at']))->format('Y-m-d 00:00:00');
	        $end = Carbon::parse(str_replace('/', '-', $request['created_at']))->format('Y-m-d 23:59:59');

        	$query = $query->whereBetween('created_at', array($start,$end));
        }

        if(array_key_exists('name', $request) and $request['updated_at'])
        {
        	$start = Carbon::parse(str_replace('/', '-', $request['updated_at']))->format('Y-m-d 00:00:00');
	        $end = Carbon::parse(str_replace('/', '-', $request['updated_at']))->format('Y-m-d 23:59:59');

        	$query = $query->whereBetween('updated_at', array($start,$end));
        }
        
        return $query->paginate(15);
	}
}