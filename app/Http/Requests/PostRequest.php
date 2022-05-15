<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostRequest extends FormRequest
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
            "text" => "required|max:120",
        ];
    }

    /**
     * エラー文
     *
     * @return void
     */
    public function messages()
    {
        return [
            'text.required' => ':attributeは必須項目です。',
            'text.max' => ':attributeは120文字以内です。',
        ];
    }

    /**
     * 項目名
     *
     * @return void
     */
    public function attributes()
    {
        return [
            'text' => '投稿文',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response['data']    = [];
        $response['status']  = '422';
        $response['summary'] = 'Failed validation.';
        $response['errors']  = $validator->errors()->toArray();

        throw new HttpResponseException(
            response()->json(['data' => $response], 422)
        );
    }
}
