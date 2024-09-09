<?php

namespace App\Http\Services\Api;

use App\Http\Resources\QuestionCollection;
use App\Models\Skill;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ExamService
{
    public function getQuestion(array $args): QuestionCollection
    {
        $questions = $args['exam']->questions()
            ->where('skill_id', Skill::getSkillId($args["skill_name"]))
            ->where('part', $args['part'])
            ->with([ 'questionSelectOptions' => function (Builder $query) {
                $query->orderBy('order', 'asc');
            }])
            ->get();

        return new QuestionCollection($questions);
    }


}
