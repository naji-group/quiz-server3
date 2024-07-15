<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
 
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Web\SiteDataController;
class UpdatePassRequest extends FormRequest
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
 
 
    public function rules(): array
    {
      
      $sitedctrlr = new SiteDataController();
      $transarr = $sitedctrlr->FillTransData( $this->lang);
       $defultlang = $transarr['langs']->first();
      $translate= $sitedctrlr->getbycode($defultlang->id, ['profile-error']);

       return[      
         'password'=>'required|between:'. $this->minpass.','. $this->maxpass,
         'confirm_password' => 'same:password',
      
     
        'old_password' => [
         'required', function ($attribute, $value, $fail) use($sitedctrlr,$translate){
             if (!Hash::check($value, Auth::guard('client')->user()->password)) {
                 $fail($sitedctrlr->gettrans($translate,'incorrect-pass'));
             }
         },
     ],
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
  $translate= $sitedctrlr->getbycode($defultlang->id, ['register-error']);
   return[   
   
     'password.between'=>$sitedctrlr->gettrans($translate,'password-between'),
    // 'address.between'=>'address charachters must be les than '.$maxlength,
    'confirm_password.same' =>  $sitedctrlr->gettrans($translate,'input-same') ,
   
    
     'password.required'=> $sitedctrlr->gettrans($translate,'required'),
    ];
    
}

}
