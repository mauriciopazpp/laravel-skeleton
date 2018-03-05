<?php namespace App\Http\Controllers;

use App\Model\Role;
use Defender;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Input;
use App\Eloquent\Role\EloquentRoleRepository;
use App\Http\Controllers\Controller;
use App\Eloquent\Permission\EloquentPermissionRepository;

class RoleController extends Controller {

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
	 * Show the application dashboard to the role.
	 *
	 * @return Response
	 */
	public function index(EloquentRoleRepository $repository)
	{
		$roles = $repository->all();
		return view('role.index', compact('roles'));
	}

	public function create()
	{
	    return view('role.create');
	}

	public function store(RoleRequest $request)
	{
	    Defender::createRole(Input::only('name')['name']);
	    return redirect()->to('role')->with('success', "Registro salvo com sucesso !");
	}

	public function destroy(Role $role)
	{
	    $role->delete();
	    return redirect()->to('role')->with('success',  "Registro excluído com sucesso !");
	}
	
	public function edit(Role $role, EloquentPermissionRepository $repository)
	{
        $permissions = $repository->except('superuser');
	    return view('role.edit', compact('role','permissions'));
	}
	 
	public function update(Request $request, EloquentRoleRepository $repository)
	{
	    $repository->update($request->only('name', 'id', 'permission'));
	    return redirect()->to('role')->with('success', "Registro atualizado com sucesso !");
	}

	public function show(Role $role)
	{
		return view('role.show', compact('role'));
	}
}
