<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\QuestionCollection;
use App\Http\Services\Api\ExamService;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function __construct(private ExamService $service)
    {
    }

    public function getListeningQuestions(Request $request, Exam $exam): QuestionCollection
    {
        return $this->service->getQuestion("listening", $exam);
    }

    public function getReadingQuestions(Request $request, Exam $exam): QuestionCollection
    {
        return $this->service->getQuestion("reading", $exam);
    }

    public function getWritingQuestions(Request $request, Exam $exam): QuestionCollection
    {
        return $this->service->getQuestion("writing", $exam);
    }

    public function getSpeakingQuestions(Request $request, Exam $exam): QuestionCollection
    {
        return $this->service->getQuestion("speaking", $exam);
    }
}
