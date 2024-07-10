<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ClientSocial extends Model
{
    use HasFactory;
    protected $table = 'clients_socials';
    protected $fillable = [
        'client_id',
'social_id',
'link',
'is_active',

       
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->withDefault();
    }
    public function socialmodel(): BelongsTo
    {
        return $this->belongsTo(SocialModel::class)->withDefault();
    }
}
