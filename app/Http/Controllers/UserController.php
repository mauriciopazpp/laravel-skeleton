<?php namespace App\Http\Controllers;

use App\Model\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionUserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Eloquent\User\EloquentUserRepository;
use App\Eloquent\Role\EloquentRoleRepository;
use App\Eloquent\Permission\EloquentPermissionRepository;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, EloquentUserRepository $repository)
    {
        $users =  $repository->search($request->all());
        return view('users.index', compact('users', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, EloquentRoleRepository $repository)
    {
        $roles = $repository->except('superuser');
        return view('users.create', compact('roles', 'request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,
                          EloquentUserRepository $repository,
                          UserRequest $request)
    {
        $repository->create($request->all());
        return redirect()->to('user')->with('success', 'Novo registro incluído com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, EloquentUserRepository $repository, $user)
    {
        $user = $repository->find($user);
        if(!$user)
            return back()->with('info', "Este registro já foi excluído! Porém ele ainda existe no histórico, verifique com o administrador do sistema.");

        $request['user_id'] = $user->id;

        return view('users.show', compact('user', 'request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user,
                         PermissionUserRequest $request,
                         EloquentRoleRepository $repository,
                         EloquentPermissionRepository $repositoryPermission)
    {
        $roles = $repository->except('superuser');
        $permissionsUser = $repositoryPermission->permissionUser($user);

        return view('users.edit', compact('user', 'roles', 'permissionsUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,
                           UserUpdateRequest $up,
                           EloquentUserRepository $repository)
    {
        $repository->update($request->all());
        return redirect()->to('user')->with('success', 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,
                            EloquentUserRepository $repository)
    {
        if($user->hasRole('superuser'))
        return redirect()->to('role')->with('danger', 'Nâo é possível excluir um usuário do grupo superuser!');

        $repository->destroy($user->id);

        return redirect()->to('user')->with('success', 'Registro excluído com sucesso!');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id,
                            EloquentUserRepository $repository)
    {
        $user = $repository->find($id, true);

        $repository->restore($user->id);
        
        return redirect()->to('user')->with('success', 'Registro restaurado com sucesso!');
    }

    /**
     * Display a listing of the resource trashed
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(EloquentUserRepository $repository)
    {
        $users = $repository->trash();
        return view('users.trash', compact('users'));
    }

    public function picture($picture)
    {
        $file = storage_path() . '/users/' . $picture ;
        return response()->download($file);
    }
}
