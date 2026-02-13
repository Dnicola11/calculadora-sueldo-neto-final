<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombres' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'required|string|max:100',
            'dni' => 'required|digits:8|numeric|unique:workers,dni',
            'fecha_nacimiento' => 'required|date|before:today',
            'sexo' => 'required|in:M,F,O',
            'cantidad_hijos' => 'required|integer|min:0',
            'area' => 'required|string|max:100',
            'cargo' => 'required|string|max:100',
            'fecha_ingreso' => 'required|date',
            'sueldo' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nombres.required' => 'El campo nombres es obligatorio.',
            'nombres.max' => 'El campo nombres no debe exceder los 100 caracteres.',
            
            'apellido_paterno.required' => 'El campo apellido paterno es obligatorio.',
            'apellido_paterno.max' => 'El campo apellido paterno no debe exceder los 100 caracteres.',
            
            'apellido_materno.required' => 'El campo apellido materno es obligatorio.',
            'apellido_materno.max' => 'El campo apellido materno no debe exceder los 100 caracteres.',
            
            'dni.required' => 'El campo DNI es obligatorio.',
            'dni.digits' => 'El DNI debe contener exactamente 8 dígitos.',
            'dni.numeric' => 'El DNI debe ser numérico.',
            'dni.unique' => 'El DNI ya está registrado en el sistema.',
            
            'fecha_nacimiento.required' => 'El campo fecha de nacimiento es obligatorio.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser menor a la fecha actual.',
            
            'sexo.required' => 'El campo sexo es obligatorio.',
            'sexo.in' => 'El valor del campo sexo no es válido.',
            
            'cantidad_hijos.required' => 'El campo cantidad de hijos es obligatorio.',
            'cantidad_hijos.integer' => 'La cantidad de hijos debe ser un número entero.',
            'cantidad_hijos.min' => 'La cantidad de hijos no puede ser negativa.',
            
            'area.required' => 'El campo área es obligatorio.',
            'area.max' => 'El campo área no debe exceder los 100 caracteres.',
            
            'cargo.required' => 'El campo cargo es obligatorio.',
            'cargo.max' => 'El campo cargo no debe exceder los 100 caracteres.',
            
            'fecha_ingreso.required' => 'El campo fecha de ingreso es obligatorio.',
            'fecha_ingreso.date' => 'La fecha de ingreso debe ser una fecha válida.',
            
            'sueldo.required' => 'El campo sueldo es obligatorio.',
            'sueldo.numeric' => 'El sueldo debe ser un valor numérico.',
            'sueldo.min' => 'El sueldo debe ser mayor a 0.',
            'sueldo.regex' => 'El sueldo debe tener máximo 2 decimales.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'nombres' => 'nombres',
            'apellido_paterno' => 'apellido paterno',
            'apellido_materno' => 'apellido materno',
            'dni' => 'DNI',
            'fecha_nacimiento' => 'fecha de nacimiento',
            'sexo' => 'sexo',
            'cantidad_hijos' => 'cantidad de hijos',
            'area' => 'área',
            'cargo' => 'cargo',
            'fecha_ingreso' => 'fecha de ingreso',
            'sueldo' => 'sueldo',
        ];
    }
}
