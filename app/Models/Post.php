<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'slug',
        'meta_key',
        'content',
        'category_id',
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
 
     
  public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault();
    }
    public function locationsettings(): HasMany
    {
        return $this->hasMany(LocationSetting::class,'post_id');
    }
    public function langposts(): HasMany
    {
        return $this->hasMany(LangPost::class,'post_id');
    }
    public function mediaposts(): HasMany
    {
        return $this->hasMany(MediaPost::class,'post_id');
    }
}
