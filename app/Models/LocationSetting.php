<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class LocationSetting extends Model
{
    use HasFactory;
    protected $table = 'location_settings';
    public $timestamps = false;
    protected $fillable = [
        'location_id',
        'setting_id',
        'type',
        'dep',
        'sequence',
        'is_active', 
        'main_table',
'category_id',
'post_id',
                    
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class,'location_id')->withDefault();
    }
    public function setting(): BelongsTo
    {
        return $this->belongsTo(Setting::class,'setting_id')->withDefault();
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id')->withDefault();
    }
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class,'post_id')->withDefault();
    }

}
