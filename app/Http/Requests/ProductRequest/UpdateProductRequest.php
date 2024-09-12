<?php

namespace App\Http\Requests\ProductRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max: 60',
            ],
            'description' => [
                'required',
                'string',
            ],
            'quantity' => [
                'required',
                'numeric',
                'min:0',
            ],
            'old_price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'sale_price' => [
                'required',
                'numeric',
                'min:0',
                'lte:old_price'
            ],
            'categories' => [
                'required',
                'array',
            ],
            'categories.*' => [
                'exists:categories,id',
            ],
            'new_thumb' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
            ],
            'status' => [
                'required',
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a string.',
            'name.max' => 'The product name may not be greater than :max characters.',
            'description.required' => 'The product description is required.',
            'description.string' => 'The product description must be a string.',
            'quantity.required' => 'The product quantity is required.',
            'quantity.numeric' => 'The product quantity must be a number.',
            'quantity.min' => 'The product quantity must be at least :min.',
            'old_price.required' => 'The product old price is required.',
            'old_price.numeric' => 'The product old price must be a number.',
            'old_price.min' => 'The product old price must be at least :min.',
            'sale_price.required' => 'The product sale price is required.',
            'sale_price.numeric' => 'The product sale price must be a number.',
            'sale_price.min' => 'The product sale price must be at least :min.',
            'sale_price.lte' => 'The sale price must be less than or equal to the old price.',
            'categories.required' => 'Please select at least one category for the product.',
            'categories.array' => 'The categories must be an array.',
            'categories.*.exists' => 'The selected category is invalid.',
            'new_thumb.nullable' => 'The product image is required.',
            'new_thumb.image' => 'The file must be an image.',
            'new_thumb.mimes' => 'The image must be a file of type: :values.',
        ];
    }
}
