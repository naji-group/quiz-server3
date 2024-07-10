<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFooterRequest extends FormRequest
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
       // 'title'=>'required|string', 
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
     // 'title.required'=>__('messages.this field is required',[],'en') ,
     // 'title.alpha_num'=>'The title format must be alphabet',
     //  'code.regex'=>'The Code format must be alphabet',
     //  'code.unique'=>'The Code is already exist',
     //  'name.required'=>'The Name is required',
     //  'image'=>__('messages.file must be image',[],'en') ,
     ];
     
 }
}
