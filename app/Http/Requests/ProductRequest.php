<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->is_admin;
    }

    public function rules()
    {
        return [
            'name'        => 'required|max:255',
            'description' => 'required|max:500',
            'price'       => 'required|numeric|between:1,9999999',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
