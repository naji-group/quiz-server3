<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class AnswersClient extends Model
{
    use HasFactory;
    protected $table = 'answers_clients';
    protected $fillable = [
        'is_correct',
        'points',
        'client_id',
        'answer_id',
        'level_id',
        'category_id',
        'question_content',
        'answer_content',
        'question_type',
        'answer_type',
        'question_file',
        'answer_file',

    ];


    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->withDefault();
    }
    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class)->withDefault();
    }
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class)->withDefault();
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault();
    }
}
