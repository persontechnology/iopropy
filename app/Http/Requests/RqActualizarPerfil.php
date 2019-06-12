<?php

namespace iopro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RqActualizarPerfil extends FormRequest
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
        $tipoIdentificacion=$this->input('tipoIdentificacion');
        $rqIdentificacion='';
        switch ($tipoIdentificacion) {
            case 'Cédula':
                    $rqIdentificacion='not_in:0000000000|ecuador:ci|unique:users,identificacion,'.$this->input('id');
                break;
            case 'RUC de persona natural':
                $rqIdentificacion='ecuador:ruc|unique:users,identificacion,'.$this->input('id');
                break;
            case 'RUC de sociedad privada':
                $rqIdentificacion='ecuador:ruc_spriv|unique:users,identificacion,'.$this->input('id');
                break;
            case 'RUC de sociedad pública':
                $rqIdentificacion='ecuador:ruc_spub|unique:users,identificacion,'.$this->input('id');
                break;
            case 'Pasaporte':
                $rqIdentificacion='required|unique:users,identificacion,'.$this->input('id');
                break;
            case 'Consumidor final':
                $rqIdentificacion='in:0000000000';
                break;
        }

        return [
            'nombres'=>'required|regex:/^[\pL\s\-]+$/u|max:255',
            'apellidos'=>'required|regex:/^[\pL\s\-]+$/u|max:255',
            'tipoIdentificacion'=>'required|in:Cédula,RUC de persona natural,RUC de sociedad privada,RUC de sociedad pública,Pasaporte,Consumidor final',
            'identificacion'=>'required|'.$rqIdentificacion,
            'sexo'=>'nullable|in:Hombre,Mujer',
            'estadoCivil'=>'required|in:Soltero/a,Casado/a,Divorciado/a,Vuido/a',
            'celular'=>'nullable|digits_between:6,25',
            'telefono'=>'nullable|digits_between:6,25',
            'foto'=>'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            'detalle'=>'nullable|max:255|string',
            'password' => 'nullable|string|min:8|confirmed',
            'clave'=>'nullable|string|min:8'
        ];
    }
}
