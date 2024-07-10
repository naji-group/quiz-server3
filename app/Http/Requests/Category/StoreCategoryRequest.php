<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
  
       return[
       'title'=>'required|string',   
 
          
        
  
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
     'title.required'=>__('messages.this field is required',[],'en') ,
    // 'title.alpha_num'=>'The title format must be alphabet',
    //  'code.regex'=>'The Code format must be alphabet',
    //  'code.unique'=>'The Code is already exist',
    //  'name.required'=>'The Name is required',
    //  'image'=>__('messages.file must be image',[],'en') ,
    ];
    
}
}
