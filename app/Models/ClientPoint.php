<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ClientPoint extends Model
{
    use HasFactory;
    protected $table = 'clients_points';
    protected $fillable = [
        'points_sum',
        'gift_sum',
        'category_id',
        'client_id',
        'level_id',

    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault();
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->withDefault();
    }
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class)->withDefault();
    }

}
