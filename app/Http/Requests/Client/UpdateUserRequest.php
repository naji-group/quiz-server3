<?php

namespace App\Http\Requests\Web\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
        // 'first_name'=>'required|regex:'.$this->alphaexpr, 
         //'last_name'=>'required|regex:'.$this->alphaexpr, 
        //   'name'=>'required|unique:users,name',  
        //   'name'  =>  'required|string|unique:users,name,'.$this->id.'|regex:'.$this->alphaAtexpr,   
        // 'name'=>'required|alpha_num:ascii|unique:users,name',        
         'email'=>'nullable|email|unique:users,email,'.$this->id,      
         'password'=>'nullable|between:'. $this->minpass.','. $this->maxpass,
       //  'confirm_password' => 'same:password',
    //     'mobile'=>'nullable|numeric|digits_between:'. $this->minMobileLength.','.$this->maxMobileLength,          
      //  'role'=>'required|in:admin,super',
      //  'is_active'=>'required',  
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
   return[   
      'first_name.required'=> __('messages.this field is required',[],'ar') ,
      'last_name.required'=>__('messages.this field is required',[],'ar') ,   
     'name.required'=> __('messages.this field is required',[],'ar') ,
  //   'name.alpha_num'=>'The name format must be alphabet',
     'name.unique'=>__('messages.The user_name is already exist',[],'ar'),
    'email.required'=>__('messages.this field is required',[],'ar') ,
     'email.email'=>__('messages.must be email',[],'ar') ,
   'email.unique'=>__('messages.email is already exist',[],'ar') ,
 
     'password.between'=>__('messages.password must be between',['Minpass'=>$this->minpass,'Maxpass'=>$this->maxpass],'ar'),
    // 'address.between'=>'address charachters must be les than '.$maxlength,
    'confirm_password.same' => __('messages.confirm_password match',[],'ar') ,
   
     //'city.required'=>'city is required',
     'mobile.numeric'=>__('messages.only numbers',[],'ar') ,
     'mobile.digits_between'=>__('messages.this field must be between',['Minmobile'=> $this->minMobileLength],'ar'),
     'role.in'=>__('messages.this field is required',[],'ar') ,
     'role.required'=>__('messages.this field is required',[],'ar') ,
     'image'=>__('messages.file must be image',[],'ar') ,
     'first_name.regex'=>__('messages.must be alpha',[],'ar') ,
     'last_name.regex'=>__('messages.must be alpha',[],'ar') ,
     'name.regex'=>__('messages.must be alpha',[],'ar') ,
    ];
    
}
}
