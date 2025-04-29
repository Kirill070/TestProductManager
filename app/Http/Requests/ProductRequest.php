<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:10',
            'article' => [
            'required',
            'string',
            'regex:/^[a-zA-Z0-9]+$/',
            \Illuminate\Validation\Rule::unique('products')->ignore($this->route('product')),
            ],
            'status' => 'required|in:available,unavailable',
            'data' => 'nullable|json',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Название продукта обязательно.',
            'name.min' => 'Название должно содержать минимум 10 символов.',
            'article.required' => 'Артикул обязателен.',
            'article.regex' => 'Артикул должен содержать только латиницу и цифры.',
            'article.unique' => 'Этот артикул уже занят.',
            'status.required' => 'Статус обязателен.',
            'status.in' => 'Статус должен быть "available" или "unavailable".',
            'data.json' => 'Поле data должно быть валидным JSON.',
        ];
    }
}
