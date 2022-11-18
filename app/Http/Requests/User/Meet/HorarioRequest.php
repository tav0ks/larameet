<?php

namespace App\Http\Requests\User\Meet;

use Illuminate\Foundation\Http\FormRequest;

class HorarioRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'meet_date' => [
                'required',
                'date_format:d/m/Y',
                'after:today'
            ],
            'meet_start' => [
                'required',
                'date_format:H:i'
            ],
        ];
    }

    public function messages()
    {
        return [
            'meet_date.required' => 'O campo data é obrigatório.',
            'meet_date.date_format' => 'A data deve estar no formado d/m/a.',
            'meet_date.after' => 'A data deve ser posterior a hoje.',
            'meet_start.required' => 'O horario de início é obrigatório.',
            'meet_start.date_format' => 'O horario deve estar no formato horas:minutos.',
        ];
    }


    public function attributes()
    {
        return [
            'meet_date' => 'data',
            'meet_start' => 'horário de início',
        ];
    }

}
