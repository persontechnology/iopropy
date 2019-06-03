<?php

namespace iopro\Http\Requests\Propiedad;

use Illuminate\Foundation\Http\FormRequest;

class RqGuardar extends FormRequest
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
            'comunidad'=>'required|exists:comunidad,id',
            'codigo'=>'required|string|max:255|unique:propiedad,codigo',
            'medidaTotal'=>'required|string|max:255',
            'linderoNorteCon'=>'required|string|max:255',
            'linderoSurCon'=>'required|string|max:255',
            'linderoEsteCon'=>'required|string|max:255',
            'linderoOesteCon'=>'required|string|max:255',
            'precioEstimado'=>'required|regex:'.$rg_decimal,
            'serviciosBasicos'=>'required|in:1,2',
            'tieneCasa'=>'required|in:1,2',
            'camino'=>'required|in:1,2',
            "propietariosAntiguo"    => "required|array|min:1",
            "propietariosAntiguo.*"  => "required|exists:users,id",
            "propietariosActuales"    => "required|array|min:1",
            "propietariosActuales.*"  => "required|exists:users,id",


        ];
    }
}
