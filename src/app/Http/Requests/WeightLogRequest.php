<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightLogRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'weight' => ['required', 'numeric', 'min:1', 'regex:/^\d{1,3}(\.\d)?$/'],
            'calories' => ['required', 'integer', 'min:0'],

            'exercise_time' => ['nullable', 'date_format:H:i'], //（nullable にして format エラーを回避）
            // 'exercise_time' => ['required', 'date_format:H:i'],

            'exercise_content' => ['nullable', 'string', 'max:120'],
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => '日付を入力してください。',
            'date.date' => '正しい日付を入力してください。',

            'weight.required' => '体重を入力してください。',
            'weight.numeric' => '数字で入力してください。',
            'weight.min' => '1以上の数値を入力してください。',
            'weight.regex' => '最大3桁＋小数点1位までの数値にしてください。',

            'calories.required' => '摂取カロリーを入力してください。',
            'calories.integer' => '整数で入力してください。',
            'calories.min' => '0以上のカロリーを入力してください。',

            'exercise_time.date_format' => '運動時間は「00:00」の形式で入力してください。',
            'exercise_time.required' => '運動時間を入力してください。',
            'exercise_content.max' => '運動内容は120文字以内で入力してください。',
        ];
    }
}
