<?php

use App\Model\User;
use \Artesaos\Defender\Facades\Defender;
use Illuminate\Database\Seeder;

class DefenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        |--------------------------------------------------------------------------
        | GRUPOS E USUÁRIOS
        |--------------------------------------------------------------------------
        */
            /*
            |--------------------------------------------------------------------------
            | CRIANDO ROLES/GRUPOS
            |--------------------------------------------------------------------------
            */
            $roleSuperuser = Defender::createRole('superuser');
            $admin        = Defender::createRole('Administrador');
            /*
            |--------------------------------------------------------------------------
            | VINCULANDO USUÁRIO AO GRUPO
            |--------------------------------------------------------------------------
            */
            $user = User::find('1'); // Mauricio Paz
            $user->attachRole($roleSuperuser);

        /*
        |--------------------------------------------------------------------------
        | PERMISSÕES
        |--------------------------------------------------------------------------
        */
           /*
           |--------------------------------------------------------------------------
           | USUÁRIOS
           |--------------------------------------------------------------------------
           */
                /*
                |--------------------------------------------------------------------------
                | CRIANDO PERMISSÕES USUÁRIOS
                |--------------------------------------------------------------------------
                */
                $permissionUsuarios[] = Defender::createPermission('user.create', 'Usuários - Cadastro de usuários');
                $permissionUsuarios[] = Defender::createPermission('user.edit',   'Usuários - Editar usuário');
                $permissionUsuarios[] = Defender::createPermission('user.destroy','Usuários - Excluir usuário');
                $permissionUsuarios[] = Defender::createPermission('user.trash',  'Usuários - Usuários excluídos');
                $permissionUsuarios[] = Defender::createPermission('user.restore','Usuários - Restaurar usuário');

                /*
                |--------------------------------------------------------------------------
                | DANDO PERMISSÕES DE USUÁRIOS AOS GRUPOS
                |--------------------------------------------------------------------------
                */
                foreach ($permissionUsuarios as $permissionUser)
                    $roleSuperuser->attachPermission($permissionUser);
           /*
           |--------------------------------------------------------------------------
           | GRUPOS
           |--------------------------------------------------------------------------
           */
                /*
                |--------------------------------------------------------------------------
                | CRIANDO PERMISSÕES GRUPOS
                |--------------------------------------------------------------------------
                */
                $permissionGrupos[] = Defender::createPermission('role.create', 'Grupos - Criar grupo');
                $permissionGrupos[] = Defender::createPermission('role.edit',   'Grupos - Editar grupo');
                $permissionGrupos[] = Defender::createPermission('role.destroy','Grupos - Excluir grupo');
                $permissionGrupos[] = Defender::createPermission('role.index','Grupos - Listar grupos');

                /*
                |--------------------------------------------------------------------------
                | DANDO PERMISSÕES DE GRUPOS AOS GRUPOS
                |--------------------------------------------------------------------------
                */
                foreach ($permissionGrupos as $permissionGrupo)
                    $roleSuperuser->attachPermission($permissionGrupo);
           /*
           |--------------------------------------------------------------------------
           | PERMISSIONS
           |--------------------------------------------------------------------------
           */
                /*
                |--------------------------------------------------------------------------
                | CRIANDO PERMISSÕES 
                |--------------------------------------------------------------------------
                */
                $permissionsPermissions[] = Defender::createPermission('permission.show', 'PERMISSÕES - Exibir permissão');
                $permissionsPermissions[] = Defender::createPermission('permission.edit', 'PERMISSÕES - Editar permissões');
                $permissionsPermissions[] = Defender::createPermission('permission.destroy', 'PERMISSÕES - Excluir permissões');
                $permissionsPermissions[] = Defender::createPermission('permission.create', 'PERMISSÕES - Criar permissões');
                $permissionsPermissions[] = Defender::createPermission('permission.index', 'PERMISSÕES - Listar permissões');

                /*
                |--------------------------------------------------------------------------
                | DANDO PERMISSÕES DE PERMISSÕES
                |--------------------------------------------------------------------------
                */
                foreach ($permissionsPermissions as $permissionsPermission)
                    $roleSuperuser->attachPermission($permissionsPermission);
           /*
           |--------------------------------------------------------------------------
           | PERMISSIONS TO ROLE
           |--------------------------------------------------------------------------
           */
                /*
                |--------------------------------------------------------------------------
                | CRIANDO PERMISSÕES 
                |--------------------------------------------------------------------------
                */
                $permissionRoles[] = Defender::createPermission('permission_role.create', 'PERMISSÕES PARA GRUPOS - Conceder permissões para grupos');
                $permissionRoles[] = Defender::createPermission('permission_role.index', 'PERMISSÕES PARA GRUPOS - Listar permissões para grupos');
                $permissionRoles[] = Defender::createPermission('permission_user.index', 'PERMISSÕES ADICIONAIS - Listagem de permissões adicionais');
                $permissionRoles[] = Defender::createPermission('permission_user.create', 'PERMISSÕES ADICIONAIS - Conceder permissões adicionais');

                /*
                |--------------------------------------------------------------------------
                | DANDO PERMISSÕES DE PERMISSÕES
                |--------------------------------------------------------------------------
                */
                foreach ($permissionRoles as $permissionRole)
                    $roleSuperuser->attachPermission($permissionRole);
    }
}
