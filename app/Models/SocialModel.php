<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class SocialModel extends Model
{
    use HasFactory;
    protected $table = 'socials';
    protected $fillable = [
        'name',
        'image',
        'code',
        'notes',
        'is_active',
        'link',
'htmlcode',

    ];

    protected $appends= ['status_conv'];
    public function getStatusConvAttribute(){
        $conv="";
       if($this->is_active==1){
        $conv=__('general.active',[],'ar');
       }else{
        $conv=__('general.notactive',[],'ar');
       }      
            return  $conv;
     }
     public function clientsocials(): HasMany
     {
         return $this->hasMany(ClientSocial::class,'social_id');
     }
}
