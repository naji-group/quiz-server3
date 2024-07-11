<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'desc',
        'meta_key',
        'parent_id',
        'sequence',
        'status',
        'update_user_id',
        'create_user_id',
        'notes',    
        'code',
       
    ];

    protected $appends= ['status_conv'];
    public function getStatusConvAttribute(){
        $conv="";
       if($this->status==1){
        $conv=__('general.active',[],'en');
       }else{
        $conv=__('general.notactive',[],'en');
       }      
            return  $conv;
     }
 

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

   public function sons(): HasMany
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class,'parent_id')->withDefault();
    }
    public function locationsettings(): HasMany
    {
        return $this->hasMany(LocationSetting::class,'category_id');
    }
    public function langposts(): HasMany
    {
        return $this->hasMany(LangPost::class,'category_id');
    }

    public function mediaposts(): HasMany
    {
        return $this->hasMany(MediaPost::class,'category_id');
    }
//
    public function clientpoints(): HasMany
    {
        return $this->hasMany(ClientPoint::class,'category_id');
    }
    public function pointtrans(): HasMany
    {
        return $this->hasMany(PointTrans::class,'category_id');
    }
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class,'category_id');
    }
    public function answersclients(): HasMany
    {
        return $this->hasMany(AnswersClient::class,'category_id');
    }
}
