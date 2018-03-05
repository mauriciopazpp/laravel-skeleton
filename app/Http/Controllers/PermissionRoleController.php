<?php namespace App\Http\Controllers;

use App\Model\Permission;
use App\Model\Role;
use Defender;
use App\Model\PermissionRole;
use Illuminate\Support\Facades\Input;
use App\Eloquent\Permission\EloquentPermissionRepository;
use App\Eloquent\Role\EloquentRoleRepository ;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRoleRequest;

class PermissionRoleController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the permission.
	 *
	 * @return Response
	 */
	public function index(EloquentRoleRepository $repository)
	{
		$roles = $repository->getRolesToSet();
		return view('permission_role.index', compact('roles'));
	}


	public function create($role_id, EloquentPermissionRepository $repository, PermissionRoleRequest $request)
	{
	    $role = Role::find($role_id);
	    $permissions = $repository->getPermissionsToSet();
	    $permissionSelected = PermissionRole::where('role_id', $role_id)->get();
	    
	    return view('permission_role.create', compact('permissions', 'role', 'permissionSelected'));
	}

	public function store(EloquentPermissionRepository $repository)
	{
	    $repository->attachPermissionToRole(Input::all());
	    
	    return redirect()->to('permission_role')->with('success', "Permissão concedida ao grupo !");
	}	
}
