<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Http\Controllers\Web\StorageController;
//use App\Http\Controllers\Web\StorageController;
class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'email_verified_at',
        'first_name',
        'last_name',
        'user_name',
        'role',
        'token',
        'mobile',
        'createuser_id',
        'updateuser_id',
        'image',
        'is_active',
        'desc',
        'country',
        'gender',
        'birthdate',
        'facebook_id', 
        'total_balance',
'balance',
'lang_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $appends= ['image_path','full_name','birthdateStr'];
    public function getImagePathAttribute(){
        $conv="";
        $strgCtrlr = new StorageController(); 
        if(is_null($this->image) ){
            $conv =$strgCtrlr->DefaultPath('image'); 
        }else if($this->image==''){
            $conv =$strgCtrlr->DefaultPath('image'); 
        } else {
            $url = $strgCtrlr->ClientPath();
            $conv =  $url.$this->image;
        }     
       
            return  $conv;
     }
     public function clientsocials(): HasMany
     {
         return $this->hasMany(ClientSocial::class,'client_id');
     }
     //
     public function answersclients(): HasMany
     {
         return $this->hasMany(AnswersClient::class);
     }
     public function clientpoints(): HasMany
     {
         return $this->hasMany(ClientPoint::class,'client_id');
     }
     public function pointtrans(): HasMany
     {
         return $this->hasMany(PointTrans::class,'client_id');
     }
     public function language(): BelongsTo
     {
         return $this->belongsTo(Language::class,'lang_id')->withDefault();
     }
}
