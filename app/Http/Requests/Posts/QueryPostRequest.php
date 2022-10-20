<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class QueryPostRequest extends FormRequest
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
            'per_page' => 'nullable|integer',
            'sort_by' => ['nullable', 'string', Rule::in(array_keys(POST_SORT_FIELDS))],
            'sort_direction' =>  ['nullable', 'string', Rule::in(['asc' , 'desc'])]
        ];
    }
}
