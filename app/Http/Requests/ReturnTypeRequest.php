<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReturnTypeRequest extends Request
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
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'name' => 'required|max:50|min:1',
                    'description' => 'required|max:255|min:5',
                ];
            }
            case 'PATCH':
            {
                return [
                    'description' => 'required|max:255|min:5',
                ];
            }
        }
    }
}
