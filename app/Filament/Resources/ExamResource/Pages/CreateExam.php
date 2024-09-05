<?php

namespace App\Filament\Resources\ExamResource\Pages;

use App\Filament\Resources\ExamResource;
use App\Models\AnswerKey;
use App\Models\Question;
use App\Models\QuestionSelectOption;
use App\Models\Skill;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;

class CreateExam extends CreateRecord
{
    protected static string $resource = ExamResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $exam = static::getModel()::create($data);
        $exam_id = $exam->id;
        $listening_skill_id = Skill::getListeningSkillId();
        $reading_skill_id = Skill::getReadingSkillId();
        $writing_skill_id = Skill::getWritingSkillId();
        $speaking_skill_id = Skill::getSpeakingSkillId();
        $data_model = [
            "listening-part1" => $listening_skill_id,
            "listening-part2" => $listening_skill_id,
            "listening-part3" => $listening_skill_id,
            "reading-part1" => $reading_skill_id,
            "reading-part2" => $reading_skill_id,
            "reading-part3" => $reading_skill_id,
            "reading-part4" => $reading_skill_id,
            "writing-part1" => $writing_skill_id,
            "writing-part2" => $writing_skill_id,
            "speaking-part1" => $speaking_skill_id,
            "speaking-part2" => $speaking_skill_id,
            "speaking-part3" => $speaking_skill_id,
        ];
        foreach ($data_model as $skill_name => $skill_id) {

            if(empty($data[$skill_name])) {
                continue;
            }

            $count_order = 1;

            foreach ($data[$skill_name] as $question) {
                $question_type = $question['type'];
                $part = (int) substr($skill_name, strlen($skill_name) - 1, 1);
                $file_url = "";
                if($question_type == "image" || $question_type == "audio") {
                    $file_url = $question['data'][$question_type];
                }
                $question_model = Question::create(
                    [
                        'exam_id' => $exam_id,
                        'skill_id' => $skill_id,
                        'order' => $count_order++,
                        'question_type' => $question_type,
                        'file_url' => $file_url,
                        'part' => $part,
                        'text' => $question['data']['text'] ?? ""
                    ]
                );
                if($question_type == "select") {
                    $answer_key = $question['data']['answer_key'];
                    $slice_select_ptions = Arr::only($question['data'], ["A", "B", "C", "D"]);
                    $count_order = 1;
                    foreach ($slice_select_ptions as $key => $value) {
                        $option = QuestionSelectOption::create([
                            'question_id' => $question_model->id,
                            'order' => $count_order++,
                            'text' => $value,
                        ]);
                        if($key === $answer_key) {
                            AnswerKey::create([
                                'question_id' => $question_model->id,
                                'question_select_option_id'  => $option->id,
                            ]);
                        };
                    }
                }
            }
        }
        return $exam;
    }
}
