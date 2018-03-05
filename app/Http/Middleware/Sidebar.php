<?php namespace App\Http\Middleware;

use Menu;
use Closure;
use Defender;
use Illuminate\Support\Facades\Auth;

class Sidebar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check())
            return $next($request);
        
        Menu::make('sidebar', function($menu)
        {            
            $roleMenu = Menu::make('role', function($role)
            {
                if($this->hasPermissions('role.index'))
                    $role->add('<span>Listar todos</span>', 'role')
                      ->prepend('<i class="fa fa-lock text-success"></i>');

                if($this->hasPermissions('role.create'))
                    $role->add('<span>Novo</span>', 'role/create')
                      ->prepend('<i class="fa fa-plus text-success"></i>');
            });

            $permissionsMenu = Menu::make('permissions', function($permissions)
            {
                if($this->hasPermissions('permission.index'))
                    $permissions->add('Listar todos', 'permission')
                      ->prepend('<i class="fa fa-lock text-success"></i>');

                if($this->hasPermissions('permission.create'))
                    $permissions->add('Novo', 'permission/create')
                      ->prepend('<i class="fa fa-plus text-success"></i>');
            });

            $permissionRoleMenu = Menu::make('permission_role', function($permissionRole)
            {
                if($this->hasPermissions('permission_role.create|permission_role.index'))
                    $permissionRole->add('Listar todos', 'permission_role')
                      ->prepend('<i class="fa fa-lock text-success"></i>');
            });

            $permissionUserMenu = Menu::make('permission_user', function($permissionUser)
            {
                if($this->hasPermissions('permission_user.index'))
                    $permissionUser->add('Listar todos', 'permission_user')
                      ->prepend('<i class="fa fa-lock text-success"></i>');
            });

            $userMenu = Menu::make('user', function($user)
            {
                
                $user->add('Listar todos', 'user')
                  ->attr('class', 'treeview')
                  ->prepend('<i class="fa fa-users text-warning"></i>');

                if($this->hasPermissions('user.trash'))
                    $user->add('Excluídos', 'user/trash')
                      ->prepend('<i class="fa fa-trash text-warning"></i>');

              if($this->hasPermissions('profissional.create'))
                  $user->add('Novo usuário profissional', 'profissional/create')
                    ->prepend('<i class="fa fa-plus text-warning"></i>');

                if($this->hasPermissions('user.create'))
                    $user->add('Novo', 'user/create')
                      ->prepend('<i class="fa fa-plus text-warning"></i>');
            });

            /**
             *
             * Navegador MENU
             * 
             */            
            $menu->raw('Navegador', ['class' => 'header']);
            $menu->add('<span>Dashboard</span>', ['url' => 'home', 'class' => 'treeview'])
                 ->prepend('<i class="fa fa-dashboard"></i> ');
            $menu->add('<span>Meu perfil</span>', ['url' => 'user/' . Auth::user()->id . '/show', 'class' => 'treeview'])
                 ->prepend('<i class="fa fa-user"></i> ');

            /**
             *
             * ACL MENU
             * 
             */
            /*
            |--------------------------------------------------------------------------
            | USUÁRIOS
            |--------------------------------------------------------------------------
            */
            $menu->raw('Gerenciador de Usuários', ['class' => 'header']);
            $menu->add('<span>Usuários</span>', ['url' => '#', 'class' => 'treeview'])
                 ->prepend('<i class="fa fa-users text-danger"></i> ')
                 ->append($userMenu->asUl(['class' => 'treeview-menu']));

            if($this->hasPermissions('role.create'))
                $menu->add('<span>Grupos</span>', ['url' => '#', 'class' => 'treeview'])
                     ->prepend('<i class="fa fa-unlock text-danger"></i> ')
                     ->append($roleMenu->asUl(['class' => 'treeview-menu']));   

            if($this->hasPermissions('permission.create'))
                $menu->add('<span>Permissões</span>', ['url' => '#', 'class' => 'treeview'])
                     ->prepend('<i class="fa fa-unlock text-danger"></i> ')
                     ->append($permissionsMenu->asUl(['class' => 'treeview-menu']));           

             /**
              *
              * Relatórios MENU
              * 
              */
             $menu->raw('<span>Gerenciamento</span>', ['class' => 'header']);
             $menu->add('<span>Usuários online</span>', 'report/sessions')
                  ->prepend('<i class="fa fa-circle text-success" aria-hidden="true"></i>');

            /**
             *
             * System MENU
             * 
             */
            $menu->raw('Sistema', ['class' => 'header']);
            $menu->add('<span>Sair do sistema</span>', ['url' => 'logout', 'class' => 'treeview', 'onclick' => 'return confirm("Tem certeza que deseja sair do sistema?")'])
                 ->prepend('<i class="fa fa-sign-out text-orange"></i> ');
        });
        return $next($request);
    }

    public function hasPermissions($permissions)
    {
        $canDo = false;
        $permissions = explode("|", $permissions);
        foreach ($permissions as $permission)
            if(Defender::hasPermission($permission))
                $canDo = true;
        
        return $canDo;
    }
}