<?php

namespace App\Http\Requests\Language;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguageRequest extends FormRequest
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
       'code'=>'required|regex:/^[a-zA-Z0-9\s]+$/u|unique:languages,code,'.$this->id,      
       'name'=>'required',        
         'image'=>'file|image',
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
     'code.required'=>'The Code is required',
    // 'title.alpha_num'=>'The title format must be alphabet',
     'code.regex'=>'The Code format must be alphabet',
     'code.unique'=>'The Code is already exist',
     'name.required'=>'The Name is required',
     'image'=>__('messages.file must be image',[],'en') ,
    ];
    
}
}
