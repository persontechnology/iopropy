<?php

namespace iopro\Http\Requests\Propiedad;

use Illuminate\Foundation\Http\FormRequest;

class RqActualizar extends FormRequest
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
        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";
        return [
            'id'=>'required|exists:propiedad',
            'codigo'=>'required|string|max:255|unique:propiedad,codigo,'.$this->input('id'),
            'medidaTotal'=>'required|string|max:255',
            'linderoNorteCon'=>'required|string|max:255',
            'linderoSurCon'=>'required|string|max:255',
            'linderoEsteCon'=>'required|string|max:255',
            'linderoOesteCon'=>'required|string|max:255',
            'precioEstimado'=>'required|regex:'.$rg_decimal,
            'serviciosBasicos'=>'required|in:1,0',
            'tieneCasa'=>'required|in:1,0',
            'camino'=>'required|in:1,0',
            "propietariosAntiguo"    => "required|array|min:1",
            "propietariosAntiguo.*"  => "required|exists:users,id",
            "propietariosActuales"    => "required|array|min:1",
            "propietariosActuales.*"  => "required|exists:users,id",
        ];
    }
}
