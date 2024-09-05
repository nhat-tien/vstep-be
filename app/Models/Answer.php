<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Observers\AnswerObserver;

#[ObservedBy([AnswerObserver::class])]
class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        "question_id",
        "exam_schedule_id",
        "question_select_option_id",
        "text",
        "audio_url",
        "score",
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function examSchedule(): BelongsTo
    {
        return $this->belongsTo(ExamSchedule::class);
    }

    public function questionSelectOption(): BelongsTo
    {
        return $this->belongsTo(QuestionSelectOption::class);
    }
}
