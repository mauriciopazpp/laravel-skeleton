<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name' => 'required|unique:users|max:50',
            'email' => 'required|unique:users|email|max:150',
            'picture' => 'mimes:jpeg,bmp,png,jpg,gif|max:2048KiB',
            'password' => 'required|max:50',
        ];
    }
}
