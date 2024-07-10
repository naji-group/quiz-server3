<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class MediaPost extends Model
{
    use HasFactory;
    protected $table = 'media_posts';
    protected $fillable = [      
        'media_id',
        'category_id',
        'post_id',
        'main_table',
        'sequence',
        'status',
        'notes',         
    ];

    protected $appends= ['media_type'];
    public function getMediaTypeAttribute(){
        $conv="";
       if($this->mediastore){
        $conv=$this->mediastore->type;
       
    }    
            return  $conv;
     }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id')->withDefault();
    }
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class,'post_id')->withDefault();
    }
    
    public function mediastore(): BelongsTo
    {
        return $this->belongsTo(Mediastore::class,'media_id')->withDefault();
    }

}
