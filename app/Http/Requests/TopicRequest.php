<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('建立測驗');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'topic' => 'required|min:2|max:191',
        ];
    }

    public function messages()
    {
        return [
            'topic' => '「:attribute」為必填欄位',

        ];
    }
    public function attributes()
    {
        return [
            'topic' => '題目內容',
        ];
    }
}
