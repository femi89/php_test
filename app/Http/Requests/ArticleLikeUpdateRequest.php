<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ArticleLikeUpdateRequest extends FormRequest
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
            'like' => ['required', 'boolean'],
            'dis_like' => ['required', 'boolean'],
            'article_id' => ['nullable', 'exists:articles,id'],
            'user_id' => ['nullable', 'exists:users,id'],
        ];
    }
}
