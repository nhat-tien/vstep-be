<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        "skill_name"
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public static function getListeningSkillId(): int {
        return Skill::firstWhere("skill_name", "listening")->id;
    }

    public static function getWritingSkillId(): int {
        return Skill::firstWhere("skill_name", "writing")->id;
    }

    public static function getSpeakingSkillId(): int {
        return Skill::firstWhere("skill_name", "speaking")->id;
    }

    public static function getReadingSkillId(): int {
        return Skill::firstWhere("skill_name", "reading")->id;
    }
}
