<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterWeightRequest extends FormRequest
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
            'current_weight' => ['required', 'numeric', 'min:0'],
            'target_weight' => ['required', 'numeric', 'min:0', 'lt:current_weight'],
        ];
    }

    public function messages(): array
    {
        return [
            'current_weight.required' => '現在の体重を入力してください。',
            'current_weight.numeric' => '体重は数値で入力してください。',
            'current_weight.min' => '体重は0以上で入力してください。',
            'target_weight.required' => '目標体重を入力してください。',
            'target_weight.numeric' => '体重は数値で入力してください。',
            'target_weight.min' => '体重は0以上で入力してください。',
            'target_weight.lt' => '目標体重は現在の体重より小さくしてください。',
        ];
    }
}
