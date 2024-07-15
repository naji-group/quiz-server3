<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Web\SiteDataController;
class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the Clientis authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public static $lang="";
 
protected $alphaAtexpr='/^[\pL\s\_\-\@\.\0-9]+$/u';
    public function rules(): array
    {
       
      
       return[   
         //  'name'=>'required|string|between:1,100|unique:clients,name,'.Auth::guard('client')->user()->id.'|regex:'.$this->alphaAtexpr,   
             'name'=>'required|string|between:1,100|regex:'.$this->alphaAtexpr,               
         //'birthdate'=>'required|date',   
         'gender'=>'required|in:male,female',    
         'country'=>'required|not_in:0',   
        'image'=>'nullable|file|image',   
       ];   
    
    }
    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array<string, string>
 */
public function messages(): array
{  

    $sitedctrlr = new SiteDataController();
    $transarr = $sitedctrlr->FillTransData( $this->lang);
     $defultlang = $transarr['langs']->first();
    $translate= $sitedctrlr->getbycode($defultlang->id, ['register','register-error']);  

   return[        
     'name.required'=>$sitedctrlr->gettrans($translate,'required') ,  
     'name.between'=>$sitedctrlr->gettrans($translate,'input-between') ,
     'name.regex'=>$sitedctrlr->gettrans($translate,'no-symbols') , 

     'name.unique'=>__('messages.The user_name is already exist',[],'ar'),   
     'gender'=>$sitedctrlr->gettrans($translate,'required') , 
     'country'=>$sitedctrlr->gettrans($translate,'required') , 
     'image.file'=> $sitedctrlr->gettrans($translate,'file-image'),
     'image.image'=> $sitedctrlr->gettrans($translate,'file-image'),
    ];
    
}

}
