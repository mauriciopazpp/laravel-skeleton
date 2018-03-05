<?php namespace App\Http\Controllers;

use Defender;
use App\Model\User;
use App\Model\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\Permission\EloquentPermissionRepository;

class PermissionController extends Controller {

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
	public function index(EloquentPermissionRepository $repository)
	{
		$permissions = $repository->all();
		return view('permission.index', compact('permissions'));
	}

	/**
	 * create a new permission.
	 *
	 * @return Response
	 */
	public function create()
	{
	    return view('permission.create');
	}

	/**
	 * create a new permission.
	 *
	 * @return Response
	 */
	public function store()
	{
	    Defender::createPermission(Input::all()['name'], Input::all()['readable_name']);
	    return redirect()->to('permission')->with('success', "Registro salvo com sucesso !");
	}

	/**
	 * destroy a permission.
	 *
	 * @return Response
	 */
	public function destroy(Permission $permission)
	{
	    $permission->delete();
	    return redirect()->to('permission')->with('success',  "Registro excluído com sucesso !");
	}
	
	/**
	 * edit a permission.
	 *
	 * @return Response
	 */
	public function edit(Permission $permission)
	{
	    return view('permission.edit', compact('permission'));
	}
	 
	/**
	 * edit a permission.
	 *
	 * @return Response
	 */
	public function update(Request $request, EloquentPermissionRepository $repository)
	{
	    $repository->update($request->all());
	    return redirect()->to('permission')->with('success', "Registro atualizado com sucesso !");
	}

	/**
	 * show a permission.
	 *
	 * @return Response
	 */
	public function show(Permission $permission)
	{
		return view('permission.show', compact('permission'));
	}

}
