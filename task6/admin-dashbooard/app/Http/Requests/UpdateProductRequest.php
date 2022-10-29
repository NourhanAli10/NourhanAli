<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_en' => ['required', 'string', 'between:2,512'],
            'name_ar' => ['required', 'string', 'between:2,512'],
            'code' => ['required', 'integer', "unique:products,code,$this->id,id"],
            'price' => ['required', 'numeric', 'between :1,999999.99'],
            'quantity' => ['required', 'integer', 'between:1,999'],
            'status' => ['required', 'in:0,1'],
            'brand_id' => ['nullable', 'integer', 'exists:brands,id'],
            'subcategory_id' => ['required', 'integer', 'exists:subcategories,id'],
            'details_en' => ['required', 'string'],
            'details_ar' => ['required', 'string'],
            'image' => ['nullable','mimes:png,jpeg,jpg', 'max:1024'],
        ];
    }
}
