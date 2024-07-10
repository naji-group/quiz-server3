<?php

namespace App\Http\Requests\Mail;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected $alphaAtexpr='/^[\pL\s\_\-\@\.\0-9]+$/u';
    protected $maxlength=200;
    protected $maxlengthmsg=1000;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
  
       return[
 
       'name'=>'required|max:'. $this->maxlength.'|regex:'.$this->alphaAtexpr ,   
       'email'=>'required|email|max:'.$this->maxlength,  
       'subject'=>'required|max:'. $this->maxlength.'|regex:'.$this->alphaAtexpr ,   
       'message'=>'required|max:'. $this->maxlengthmsg,  
      
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
     
    // 'title.alpha_num'=>'The title format must be alphabet',
     'name.regex'=>'The name format must be alphabet',
      
     'name.required'=>'The Name is required',
     
    ];
    
}
}
