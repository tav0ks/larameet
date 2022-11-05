<?php

namespace App\Http\Requests\User\Meet;

use Illuminate\Foundation\Http\FormRequest;

class MeetRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'meet.name' => 'required',
            'meet.duration' => [
                'required',
                'date_format:H:i'
            ],
            'horario.meet_date' => [
                'required',
                'date_format:d/m/Y'
            ],
            'horario.meet_start' => [
                'required',
                'date_format:H:i'
            ]
        ];
    }
}
