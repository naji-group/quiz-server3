<?php

namespace App\Http\Requests\MediaPost;

use Illuminate\Foundation\Http\FormRequest;

class StoreImagesRequest extends FormRequest
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
   
        return[
       //     'images' => ['required', 'array'],
      //  'images'=>'required|file|mimes:jpg,bmp,png,jpeg,gif,svg',
      //  'images.*'=>'required|file|mimes:jpg,bmp,png,jpeg,gif,svg,webp',
        ];   
     
     }
     /**
  * Get the error messages for the defined validation rules.
  *
  * @return array<string, string>
  */
 public function messages(): array
 {
 //    $maxlength=500;
 //    $minMobileLength=10;
 //    $maxMobileLength=15;
    return[
      'images.required'=>__('messages.this field is required',[],'en') ,
      'images.mimes'=>  __('messages.file must be image',[],'en') ,
     // 'title.alpha_num'=>'The title format must be alphabet',
     //  'code.regex'=>'The Code format must be alphabet',
     //  'code.unique'=>'The Code is already exist',
     //  'name.required'=>'The Name is required',
     //  'image'=>__('messages.file must be image',[],'en') ,
     ];
     
 }
}
