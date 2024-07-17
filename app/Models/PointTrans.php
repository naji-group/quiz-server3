<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PointTrans extends Model
{
    use HasFactory;
    protected $table = 'points_trans';
    protected $fillable = [
        'type',
        'points',
        'process_type',
        'level_id',
        'client_id',
        'category_id',
        'pointsrate',
        'cash',
        'balance_before',
        'balance_after',
        'notes',
        'status',
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class)->withDefault();
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->withDefault();
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

}
