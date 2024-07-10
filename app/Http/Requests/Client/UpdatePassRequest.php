<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
 
use Illuminate\Support\Facades\Hash;
class UpdatePassRequest extends FormRequest
{
    /**
     * Determine if the Clientis authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
protected   $minpass=8;
protected   $maxpass=16;
protected  $minMobileLength=10;
protected $maxMobileLength=15;
protected $maxlength=500;
protected $alphaexpr='/^[\pL\s\_\-\0-9]+$/u';
protected $alphaAtexpr='/^[\pL\s\_\-\@\.\0-9]+$/u';
    public function rules(): array
    {
       
      
       return[      
         'password'=>'required|between:'. $this->minpass.','. $this->maxpass,
         'confirm_password' => 'same:password',
         // 'mobile'=>'nullable|numeric|digits_between:'. $this->minMobileLength.','.$this->maxMobileLength,          
       // 'role'=>'required|in:admin,super',
      //  'is_active'=>'required',  
     
        'old_password' => [
         'required', function ($attribute, $value, $fail) {
             if (!Hash::check($value, Auth::guard('client')->user()->password)) {
                 $fail('كلمة المرور غير صحيحة');
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
  
   return[   
      // 'first_name.required'=> __('messages.this field is required',[],'en') ,
      // 'last_name.required'=>__('messages.this field is required',[],'en') ,   
     'name.required'=> __('messages.this field is required',[],'ar') ,
  //   'name.alpha_num'=>'The name format must be alphabet',
     'name.unique'=>__('messages.The user_name is already exist',[],'ar'),
  //  'email.required'=>__('messages.this field is required',[],'ar') ,
     'email.email'=>__('messages.must be email',[],'ar') ,
   'email.unique'=>__('messages.email is already exist',[],'ar') ,
    // 'inputPasswordConfirm' => 'confirm must match passowrd',
//     'first_name.alpha'=>'first name format must be alphabet',
  //   'last_name.alpha'=>'last name format must be alphabet',
     //'password.required'=>__('messages.this field is required',[],'ar') ,
     'password.between'=>__('messages.password must be between',['Minpass'=>$this->minpass,'Maxpass'=>$this->maxpass],'ar'),
    // 'address.between'=>'address charachters must be les than '.$maxlength,
    'confirm_password.same' => __('messages.confirm_password match',[],'ar') ,
   
     //'city.required'=>'city is required',
   //   'mobile.numeric'=>__('messages.only numbers',[],'en') ,
   //   'mobile.digits_between'=>__('messages.this field must be between',['Minmobile'=> $this->minMobileLength],'en'),
   //   'role.in'=>__('messages.this field is required',[],'en') ,
   //   'role.required'=>__('messages.this field is required',[],'en') ,
   //  'image'=>__('messages.file must be image',[],'ar') ,
   //   'first_name.regex'=>__('messages.must be alpha',[],'en') ,
   //   'last_name.regex'=>__('messages.must be alpha',[],'en') ,
     'name.regex'=>__('messages.must be alpha',[],'en') ,
    
     'email.required'=> "الرجاء ادخال بريد الالكتروني ",
     'password.required'=> "الرجاء تأكد من ادخال كلمة المرور "
    ];
    
}

}
