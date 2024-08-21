<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\QuestionCollection;
use App\Http\Services\Api\ExamService;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class ExamController extends Controller
{
    public function __construct(private ExamService $service)
    {
    }


    /**
     *
     *
     */
    public function getQuestions(Request $request, Exam $exam): QuestionCollection
    {
        $validatedData = $request->validate([
            'skill' => ['required', 'string', Rule::in(['listening', 'speaking', 'reading', 'writing'])],
            'part' => ['required', 'numeric', 'between:1,4']
        ]);
        return $this->service->getQuestion([
            "skill_name" => $validatedData['skill'],
            "part" => $validatedData["part"],
            "exam" => $exam,
        ]);
    }

    // public function getReadingQuestions(Request $request, Exam $exam): QuestionCollection
    // {
    //     return $this->service->getQuestion("reading", $exam);
    // }
    //
    // public function getWritingQuestions(Request $request, Exam $exam): QuestionCollection
    // {
    //     return $this->service->getQuestion("writing", $exam);
    // }
    //
    // public function getSpeakingQuestions(Request $request, Exam $exam): QuestionCollection
    // {
    //     return $this->service->getQuestion("speaking", $exam);
    // }
}
