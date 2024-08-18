<?php

namespace App\Filament\Resources\ExamResource\Pages;

use App\Filament\Resources\ExamResource;
use App\Models\AnswerKey;
use App\Models\Question;
use App\Models\QuestionSelectOption;
use App\Models\Skill;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use App\Models\Exam;
use Illuminate\Support\Str;

class EditExam extends EditRecord
{
    protected static string $resource = ExamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    //TODO: My code suck, this need to be refactor
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $exam_id = $data['id'];
        $questions = Exam::find($exam_id)->questions()->orderBy('order','asc')->get();
        $skills = [
            Skill::getListeningSkillId() => "listening",
            Skill::getSpeakingSkillId() => "speaking",
            Skill::getReadingSkillId() => "reading",
            Skill::getWritingSkillId() => "writing",
        ];
        $data['listening'] = [];
        $data['writing'] = [];
        $data['speaking'] = [];
        $data['reading'] = [];
        foreach ($questions as $question_from_model) {
            $select_part = [];
            if($question_from_model->question_type == "select") {
                $select_options_from_model = QuestionSelectOption::where('question_id', $question_from_model->id)
                    ->orderBy('order','asc')
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
                    // "file_url" => $question_from_model->file_url,
                    ...$select_part,
                ],
            ];
            array_push($data[$skills[$question_from_model->skill_id]], $question);
        }
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // $record->update($data);
        $exam_id = $record->id;
        $questions_in_exam = Question::where('exam_id', $exam_id)->get();
        $question_id_exist_in_data = [];

        $skills = [
            "listening" => Skill::getListeningSkillId(),
            "speaking" => Skill::getSpeakingSkillId(),
            "reading" => Skill::getReadingSkillId(),
            "writing" => Skill::getWritingSkillId(),
        ];

        foreach ($skills as $skill_name => $skill_id) {

            if(empty($data[$skill_name])) {
                continue;
            }

            $count_order = 1;

            foreach ($data[$skill_name] as $question) {
                $question_id = $question['data']['question_id'];
                $question_type = $question['type'];

                if($question_id == null) {
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
                } else {
                    $question_id_exist_in_data[] = $question_id;
                    $file_url = "";
                    if($question_type == "image" || $question_type == "audio") {
                        $file_url = $question['data'][$question_type];
                    }
                    $question_model = Question::find($question_id);
                    $question_model->update([
                        "exam_id" => $exam_id,
                        "skill_id" => $skill_id,
                        "order" => $count_order++,
                        "question_type" => $question_type,
                        "file_url" => $file_url,
                        "text" => $question['data']['text'],
                    ]);

                    if($question_type == "select") {
                        $answer_key_update = $question['data']['answer_key'];
                        $answer_key_old = AnswerKey::where('question_id', $question_id)->first();
                        $slice_select_options = Arr::only($question['data'], ["A", "B", "C", "D"]);
                        $options = QuestionSelectOption::where("question_id", $question_id)->orderBy('order', 'asc')->get();
                        $i = 0;
                        foreach ($slice_select_options as $key => $value) {
                            $options[$i]->update([ "text" => $value ]);
                            if($key == $answer_key_update) {
                                $answer_key_old->update([ "question_select_option_id" => $options[$i]->id ]);
                            }
                            $i++;
                        }
                    }
                }


            };
        };
        $questions_will_be_delete = $questions_in_exam->diff(Question::whereIn('id',$question_id_exist_in_data)->get());
        if($questions_will_be_delete->all() != []) {
            $questions_will_be_delete->each(function ($q){
                if($q->question_type == "select") {
                    $q->answerKey()->delete();
                    $q->questionSelectOptions()->delete();
                }
               $q->delete();
            });
        }
        $record->update(['name' => $data['name']]);

        return $record;
    }

}
