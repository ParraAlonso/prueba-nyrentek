<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTareaRequest extends FormRequest
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
            'titulo' => [
                'required',
                'string',
                'min:5',
                'max:255',
                Rule::unique('tareas', 'titulo')->withoutTrashed()->ignore($this->tarea)->where(function ($query) {
                    return $query->whereRaw('LOWER(titulo) = ?', [strtolower($this->titulo)]);
                })
            ],
            'estatus_id' => 'required|exists:cat_estatus,id',
            'descripcion'=>'nullable|string|max:1700'
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'El título de tarea es obligatorio.',
            'titulo.string' => 'El título de tarea debe ser una cadena de texto.',
            'titulo.max' => 'El título de tarea debe ser máximo de 255 caracteres.',
            'titulo.unique' => 'El título de tarea ya existe.',
            'estatus_id.required' => 'El estatus de la tarea es obligatorio.',
            'estatus_id.exists' => 'El estatus de la tarea no existe.'
        ];
    }
}
