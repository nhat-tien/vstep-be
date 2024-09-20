<?php

namespace App\Http\Services\Api;

use App\Models\Answer;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AnswerService
{
    public function __construct(private FileService $file)
    {
    }

    public function submitAnswer(Request $request): array
    {
        $exam_schedule_id = $request->scheduleId;
        $answers = $request->answers;
        $answer_collection = [];
        foreach ($answers as $answer) {
            $answer_collection[] = Answer::updateOrCreate(
                [
                    "exam_schedule_id" => $exam_schedule_id,
                    "question_id" => $answer['questionId']
                ],
                [
                    "question_select_option_id" => array_key_exists('selectOptionId', $answer) ? $answer['selectOptionId'] : NULL,
                    "text" => array_key_exists('text', $answer) ? $answer['text'] : NULL,
                ],
            );
        }

        return $answer_collection;
    }

    public function submitAudioAnswer(Request $request): Answer
    {
        $exam_schedule_id = $request->scheduleId;
        $question_id = $request->questionId;

        $answer = Answer::where("exam_schedule_id",$exam_schedule_id)
            ->where("question_id", $question_id)->first();

        if($answer != null) {
           throw new HttpException(500,"Answer already exist");

        }

        $audio_path = $this->file->storeAudioAnswer($request->only('audio'));

        $answer = Answer::create([
            "exam_schedule_id" => $exam_schedule_id,
            "question_id" => $question_id,
            "audio_url" => $audio_path
        ]);

        return $answer;
    }

}
