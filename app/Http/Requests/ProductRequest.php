<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        $rules = [
            'name' => ['required', 'string', 'min:10'],
            'status' => ['required', Rule::in(['available', 'unavailable'])],
            'data' => ['nullable', 'json'],
        ];

        if (Auth::user()->hasPermissionTo('edit product article')) {
            $rules['article'] = [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9]+$/',
                Rule::unique('products')->ignore($this->product),
            ];
        }

        return $rules;
    }

    public function prepareForValidation()
    {
        if (!Auth::user()->hasPermissionTo('edit product article')) {
            $this->request->remove('article');
        }

        if (!$this->filled('data')) {
            $this->merge(['data' => null]);
        }
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
