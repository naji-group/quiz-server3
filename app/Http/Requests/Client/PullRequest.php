<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
 
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Web\SettingController;
use App\Http\Controllers\Web\SiteDataController;
class PullRequest extends FormRequest
{
  public static $lang="";
    /**
     * Determine if the Clientis authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
  
    public function rules(): array
    {  
      $setctrl=new SettingController();
      $set_arr=$setctrl->getquessetting();
      $minpull= $set_arr['minpoints'];      
       return[           
         'points' => 'required|integer|gt:0|lte:'.auth()->guard('client')->user()->balance.'|gte:'.$minpull,       
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
  $translate= $sitedctrlr->getbycode($defultlang->id, ['pull','register-error']); 
   return[   
    'points.required'=> $sitedctrlr->gettrans($translate,'required'), 
    'points.integer'=> $sitedctrlr->gettrans($translate,'only-number'), 
    'points.gt'=> $sitedctrlr->gettrans($translate,'points-greater'), 
    'points.lte'=> $sitedctrlr->gettrans($translate,'points-lessequal'), 
    'points.gte'=> $sitedctrlr->gettrans($translate,'points-greaterqual'), 
    ];
    //'only numbers'=>'هذا الحقل يجب ان يحوي ارقام فقط',
}

}
