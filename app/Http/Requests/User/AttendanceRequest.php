<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
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
            'date' => 'required|date_format:Y-m-d|before_or_equal:today',
            'start_time' => 'required_without:end_time|date_format:H:i',
            'end_time' => 'required_without:start_time|date_format:H:i',
        ];
    }

    /**
     * custom message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => '必須入力です。',
            'date.date_format' => '日付の書式が異なります。',
            'start_time.date_format' => '時間の書式が異なります。',
            'before_or_equal' => ':today 以前の日付を入力してください。'
        ];
    }
}
