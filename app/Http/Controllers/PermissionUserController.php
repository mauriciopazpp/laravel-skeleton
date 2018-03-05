<?php namespace App\Http\Controllers;

use App\Model\Permission;
use App\Model\User;
use Defender;
use App\Model\PermissionUser;
use Illuminate\Support\Facades\Input;
use App\Eloquent\Permission\EloquentPermissionRepository;
use App\Eloquent\User\EloquentUserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionUserRequest;

class PermissionUserController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(EloquentUserRepository $repository)
	{
		$users = $repository->getTheUsers(15);
		return view('permission_user.index', compact('users'));
	}

	public function create($user_id, EloquentPermissionRepository $repository, PermissionUserRequest $request)
	{
		$user = User::find($user_id);
	    $permissions = $repository->getPermissionsToSet();
	    $permissionSelected = PermissionUser::where('user_id', $user_id)->get();
	    
	    return view('permission_user.create', compact('user','permissions', 'permissionSelected'));
	}

	public function store(EloquentPermissionRepository $repository)
	{
		$data = Input::all();
	    $repository->attachPermissionToUser($data);

	    return redirect()->to('permission_user')->with('success', "Permissão concedida ao usuário !");
	}

	public function destroy($permission, $user)
	{
		$user = User::find($user);
		$permission = Defender::findPermission($permission);
	    $user->detachPermission($permission);

	    return redirect()->to('permission_user')->with('success',  "Permissão removida com sucesso ! O usuário <b> " . $user->name . "</b> não terá mais acesso a tela <b>" . $permission->readable_name . "</b>");
	}
	
}
