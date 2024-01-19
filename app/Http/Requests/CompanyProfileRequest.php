<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyProfileRequest extends FormRequest
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
            "company_id" => "required",
            "company_name" => "required",
            "company_logo" => '',
            "type_of_company" => '',
            "certificate" => "required",
            "company_category_id" => "required",
            "company_sub_category_id" => "required",
            "industry" => "required",
            "brand_name" => "required",
            'brand_logo.*' => 'image|max:2048',
            "brand_website.*" => 'required',
            "started_in" => "required",
            "number_of_employee" => "required",
            "about_company" => 'required',
        ];
    }
    public function messages()
    {
        return [
            'brand_logo.*.image' => 'The Brand Logo must be an image.',
            'brand_logo.*.max' => 'The brand logo must not exceed 2MB in size.',
            'brand_website.*.required' => 'The brand website field is required for all logos.',
        ];
    }
}
