<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name1',
'value1',
'name2',
'value2',
'name3',
'value3',
'category',
'dep',
'sequence',
'section',
'location',
'is_active',
    ];
    protected $appends= ['status_conv'];
    public function getStatusConvAttribute(){
        $conv="";
       if($this->is_active==1){
        $conv=__('general.active',[],'en');
       }else{
        $conv=__('general.notactive',[],'en');
       }      
            return  $conv;
     }
     public function locationsettings(): HasMany
     {
         return $this->hasMany(LocationSetting::class,'setting_id');
     }
}