<?php

namespace iopro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RqActualizarAsociacion extends FormRequest
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
            'nombre'=>'required|string|max:255|unique:asociacion,nombre,'.$this->input('asociacion'),
            'descripcion'=>'required|string|max:255',
            'asociacion'=>'required'
        ];
    }
}
