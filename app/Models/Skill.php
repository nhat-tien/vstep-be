<?php

namespace App\Models;

use App\Exceptions\SkillIdNotFoundException;
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

    public static function getSkillId(string $skill_name): int
    {
        switch ($skill_name) {
            case 'listening':
                return Skill::getListeningSkillId();
                break;
            case 'reading':
                return Skill::getReadingSkillId();
                break;
            case 'writing':
                return Skill::getWritingSkillId();
                break;
            case 'speaking':
                return Skill::getSpeakingSkillId();
                break;
            default:
                throw new SkillIdNotFoundException();
                break;
        }
    }
}
