<?php

namespace App\Filament\Resources\ExamResource\Pages;

use App\Filament\Resources\ExamResource;
use App\Models\QuestionSelectOption;
use App\Models\Exam;
use App\Models\Skill;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Str;

class ViewExam extends ViewRecord
{
    protected static string $resource = ExamResource::class;

    public function mutateFormDataBeforeFill(array $data): array
    {
        $data = array_merge($data, [
            "listening-part1" => [],
            "listening-part2" => [],
            "listening-part3" => [],
            "reading-part1" => [],
            "reading-part2" => [],
            "reading-part3" => [],
            "reading-part4" => [],
            "writing-part1" => [],
            "writing-part2" => [],
            "speaking-part1" => [],
            "speaking-part2" => [],
            "speaking-part3" => [],
        ]);
        $exam_id = $data['id'];
        $questions = Exam::find($exam_id)->questions()->orderBy('order', 'asc')->get();
        $skills = [
            Skill::getListeningSkillId() => "listening",
            Skill::getSpeakingSkillId() => "speaking",
            Skill::getReadingSkillId() => "reading",
            Skill::getWritingSkillId() => "writing",
        ];
        foreach ($questions as $question_from_model) {
            $select_part = [];
            if($question_from_model->question_type == "select") {
                $select_options_from_model = QuestionSelectOption::where('question_id', $question_from_model->id)
                    ->orderBy('order', 'asc')
                    ->get();
                $answer_key = $question_from_model->answerKey()->first()?->question_select_option_id;
                $keys_prefix = ["A", "B", "C", "D"];
                $order = 0;
                foreach ($select_options_from_model as $option) {
                    $select_part[$keys_prefix[$order]] = $option->text;
                    if($option->id == $answer_key) {
                        $select_part['answer_key'] = $keys_prefix[$order];
                    }
                    $order++;
                }
            }
            if(Str::startsWith($question_from_model->file_url, "question-audios")) {
                $select_part['audio'] = $question_from_model->file_url;
            }
            if(Str::startsWith($question_from_model->file_url, "question-images")) {
                $select_part['image'] = $question_from_model->file_url;
            }
            $question = [
                "type" => $question_from_model->question_type,
                "data" => [
                    "question_id" => $question_from_model->id,
                    "text" => $question_from_model->text,
                    ...$select_part,
                ],
            ];
            $skill_name = $skills[$question_from_model->skill_id] . "-part" . $question_from_model->part;
            array_push($data[$skill_name], $question);
        }
        return $data;

    }

}
