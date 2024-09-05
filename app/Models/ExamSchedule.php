<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Observers\ExamScheduleObserver;

#[ObservedBy([ExamScheduleObserver::class])]
class ExamSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "exam_id",
        "date",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }
}
