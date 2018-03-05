<?php namespace App\Http\Requests;

use App\Model\User;
use App\Http\Requests\Request;

class PermissionRoleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(\Defender::hasRole(User::SUPERUSER))
            return true;

        $roleId = $this->route()->parameter('role_id');
        $role = \App\Model\Role::find($roleId);

        if(!\Defender::hasRole($role->name) and $role->name != User::SUPERUSER)
            return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
