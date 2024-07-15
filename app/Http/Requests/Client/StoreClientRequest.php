<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Web\SiteDataController;
class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the Clientis authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public static $lang="";
protected   $minpass=8;
protected   $maxpass=16;
protected  $minMobileLength=10;
protected $maxMobileLength=15;
protected $maxlength=500;
protected $alphaexpr='/^[\pL\s\_\-\0-9]+$/u';
protected $alphaAtexpr='/^[\pL\s\_\-\@\.\0-9]+$/u';
    public function rules( ): array
    {
       
     // $this->lang=$lang;
       return[
         
           'name'=>'required|string|between:1,100|regex:'.$this->alphaAtexpr,               
         'email'=>'required|email|unique:clients,email',      
         'password'=>'required|between:'. $this->minpass.','. $this->maxpass,
         'confirm_password' => 'same:password',         
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
      'confirm_password.same' => $sitedctrlr->gettrans($translate,'input-same') ,          
     'name.required'=> $sitedctrlr->gettrans($translate,'required'), 
     'name.regex'=>$sitedctrlr->gettrans($translate,'no-symbols') ,  
     'name.between'=>$sitedctrlr->gettrans($translate,'input-between') , 
     //'name.unique'=>$sitedctrlr->gettrans($translate,'user-name-exist'),  
     'email.required'=>  $sitedctrlr->gettrans($translate,'required'),
     'email.email'=>$sitedctrlr->gettrans($translate,'input-email') ,
   'email.unique'=>$sitedctrlr->gettrans($translate,'email-exist')  ,  
     'password.between'=>$sitedctrlr->gettrans($translate,'password-between'),   
     'password.required'=> $sitedctrlr->gettrans($translate,'required'),
     'image.file'=> $sitedctrlr->gettrans($translate,'file-image'),
     'image.image'=> $sitedctrlr->gettrans($translate,'file-image'),
    ];
    
}

}
