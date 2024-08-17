<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'skill_id',
        'order',
        'text',
        'question_type',
        'file_url',
    ];

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function questionSelectOptions(): HasMany
    {
        return $this->hasMany(QuestionSelectOption::class);
    }


    public function answerKey(): HasOne
    {
        return $this->hasOne(AnswerKey::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
