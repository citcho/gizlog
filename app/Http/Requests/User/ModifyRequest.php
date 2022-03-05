<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ModifyRequest extends FormRequest
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
            'date' => [
                'required',
                'before_or_equal:today',
                Rule::exists('attendances')->where(function ($query) {
                    return $query
                        ->where('date', $this->input('date'))
                        ->where('user_id', Auth::id());
                }),
            ],
            'request_content' => 'required|max:500',
        ];
    }

    public function messages()
    {
        return [
            'required' => '入力必須の項目です。',
            'before_or_equal' => '今日以前の日付を入力してください。',
            'max' => ':max 文字以内で入力してください。',
            'exists' => '対象の日付の勤怠が存在しません。',
        ];
    }
}
