<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionSelectOption extends Model
{
    use HasFactory;

    protected $fillable = [
        "question_id",
        "order",
        "text",
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function answerKeys(): HasMany
    {
        return $this->hasMany(AnswerKey::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
