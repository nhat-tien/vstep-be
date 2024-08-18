<?php

namespace App\Http\Services\Api;

use App\Http\Resources\QuestionCollection;
use App\Models\Exam;
use App\Models\Skill;
use Illuminate\Contracts\Database\Eloquent\Builder;



class ExamService {

    public function getQuestion(string $skill_name,Exam $exam): QuestionCollection
    {
        $questions = $exam->questions()
            ->where('skill_id', Skill::getSkillId($skill_name))
            ->with([ 'questionSelectOptions' => function (Builder $query) {
                $query->orderBy('order', 'asc');
            }])
            ->get();

        return new QuestionCollection($questions);
    }

}

