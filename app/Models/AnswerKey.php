<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnswerKey extends Model
{
    use HasFactory;
    protected $fillable = [
        "question_select_option_id",
        "question_id",
    ];
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function questionSelectOption(): BelongsTo
    {
        return $this->belongsTo(QuestionSelectOption::class);
    }
}
