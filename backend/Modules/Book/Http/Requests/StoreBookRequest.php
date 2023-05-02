<?php

namespace Modules\Book\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => ['required', 'min:20', 'unique:books,title'],
            "author" => ['required'],
            "genre" => ['required'],
            "description" => ['required', 'min:100'],
            "isbn" => ['required', 'unique:books,isbn'],
            "image" => ['required', 'mimes:png,jpg,jpeg'],
            "published" => [],
            "publisher" => ['required_if:published,true'],
        ];
    }

    public function messages()
    {
        return [
            'publisher.required_if' => "The publisher name is required if you want to publish."
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
