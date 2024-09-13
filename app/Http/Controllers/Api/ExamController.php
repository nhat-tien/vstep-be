<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GetExamRequest;
use App\Http\Resources\QuestionCollection;
use App\Http\Services\Api\ExamService;
use App\Models\Exam;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExamController extends Controller
{
    public function __construct(private ExamService $service)
    {
    }


    public function index(GetExamRequest $request, Exam $exam): QuestionCollection
    {
        $validatedData = $request->safe()->only(['skill','part']);

        return $this->service->getQuestion([
            "skill_name" => $validatedData['skill'],
            "part" => $validatedData["part"],
            "exam" => $exam,
        ]);
    }

    public function countSelectQuestion(GetExamRequest $request, Exam $exam): JsonResponse
    {
        $validatedData = $request->safe()->only(['skill','part']);

        $count = $this->service->getCountSelectQuestion([
            "skill_name" => $validatedData['skill'],
            "part" => $validatedData["part"],
            "exam" => $exam,
        ]);
        return response()->json([
            "status" => 200,
            "count" => $count
        ]);
    }

}
