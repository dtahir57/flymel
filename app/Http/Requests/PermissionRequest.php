<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            case 'GET':
            case 'DELETE':
            case 'POST':
                return [
                        'name'=>'required|string|max:200|unique:permissions'
                ];
            case 'PATCH':
                return [
                    'name'=>'required|string|max:200'
                ];
            case 'DEFAULT':
                return [];
        }
    }
}
