<?php

namespace App\Http\Requests\Ranking;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'count' => 'nullable|int|max:100',
            'type' => 'require|string|in:kd,kda,points,adr,',
        ];
    }
}
