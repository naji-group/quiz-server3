<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Level extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'value',
        'answers_count',
        'points',
        'status',

    ];
    public function answersclients(): HasMany
    {
        return $this->hasMany(AnswersClient::class);
    }
    public function clientpoints(): HasMany
    {
        return $this->hasMany(ClientPoint::class,'level_id');
    }
    public function pointtrans(): HasMany
    {
        return $this->hasMany(PointTrans::class,'level_id');
    }
}
