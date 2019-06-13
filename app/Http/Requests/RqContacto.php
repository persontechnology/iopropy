<?php

namespace iopro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RqContacto extends FormRequest
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
            'nombre'=>'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'asunto'=>'required|string|max:255',
            'mensaje'=>'required|string|max:255'
        ];
    }
}
