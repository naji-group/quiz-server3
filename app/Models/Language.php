<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Web\StorageController;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'notes',
        'sequence',
        'status',
        'image',
        'htmlcode',
        'is_default',        
    ];

    protected $appends= ['image_path','status_conv','is_default_conv' ];
    public function getImagePathAttribute(){
        $conv="";
        $strgCtrlr = new StorageController(); 
        if(is_null($this->image) ){
            $conv =$strgCtrlr->DefaultPath('image'); 
        }else if($this->image==''){
            $conv =$strgCtrlr->DefaultPath('image'); 
        } else {
            $url = $strgCtrlr->LanguagePath();
            $conv =  $url.$this->image;
        }     
       
            return  $conv;
     }
     public function getStatusConvAttribute(){
        $conv="";
       if($this->status==1){
        $conv=__('general.active',[],'en');
       }else{
        $conv=__('general.notactive',[],'en');
       }      
            return  $conv;
     }
     public function getIsDefaultConvAttribute(){
        $conv="";
       if($this->is_default==1){
        $conv=__('general.yes',[],'en');
       }else{
        $conv=__('general.no',[],'en');
       }      
            return  $conv;
     }
   
     public function langposts(): HasMany
     {
         return $this->hasMany(LangPost::class,'lang_id');
     }
     public function questions(): HasMany
     {
         return $this->hasMany(Question::class,'lang_id');
     }
     public function clients(): HasMany
     {
         return $this->hasMany(Client::class,'lang_id');
     }
}
