<?php

namespace iopro\Http\Requests\Ventas;

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
            'numeroVenta'=>'required|unique:venta,numero',
            'propiedad'=>'required|exists:propiedad,id',
            'precioEstimado'=>'required|regex:'.$rg_decimal,
            "propietariosNuevos"    => "required|array|min:1",
            "propietariosNuevos.*"  => "required|exists:users,id",
        ];
    }
}
