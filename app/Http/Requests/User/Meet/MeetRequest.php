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
            'name' => 'required',
            'meet_date' => [
                'required',
                'date_format:d/m/Y'
            ],
            'agenda' => 'required'
        ];
    }
}
