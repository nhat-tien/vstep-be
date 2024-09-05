<?php

namespace App\Http\Services\Api;

use App\Http\Resources\ResultResource;
use App\Models\Result;
use App\Models\Skill;

class ResultService
{
    public function updateStartTime(array $dataFromRequest): array
    {
        try {
            $skill_id = Skill::getSkillId($dataFromRequest['skillName']);
            $result = Result::where('exam_schedule_id', $dataFromRequest['scheduleId'])
                ->where('skill_id', $skill_id)
                ->first();
            if($result != null && $result->start_time != null) {
                return [
                   'status' => 400,
                   'message' => 'Update start time not allow'
                ];
            }
            $result = Result::updateOrCreate(
                [
                    'exam_schedule_id' => $dataFromRequest['scheduleId'],
                    'skill_id' => $skill_id,
                ],
                [
                    'start_time' => $this->getTimestampNow(),
                ]
            );
            return [
                "status" => 200,
                "data" => new ResultResource($result),
            ];
        } catch (\Throwable $th) {
            return [
                'status' => 500,
                'message' => $th->getMessage()
            ];
        }
    }


    public function updateEndTime(array $dataFromRequest): array
    {
        try {
            $skill_id = Skill::getSkillId($dataFromRequest['skillName']);
            $result = Result::where('exam_schedule_id', $dataFromRequest['scheduleId'])
                ->where('skill_id', $skill_id)
                ->first();
            if($result != null && $result->end_time != null) {
                return [
                   'status' => 400,
                    'message' => 'Update end time not allow'
                ];
            }
            $result = Result::updateOrCreate(
                [
                    'exam_schedule_id' => $dataFromRequest['scheduleId'],
                    'skill_id' => $skill_id,
                ],
                [
                    'start_time' => $this->getTimestampNow(),
                ]
            );
            return [
                "status" => 200,
                "data" => new ResultResource($result),
            ];
        } catch (\Throwable $th) {
            return [
                'status' => 500,
                'message' => $th->getMessage()
            ];
        }
    }

    public function getTime(string $skill, int $schedule_id): array
    {
        try {
            $skill_id = Skill::getSkillId($skill);
            $result = Result::where('exam_schedule_id', $schedule_id)
                ->where('skill_id', $skill_id)
                ->first();
            if($result == null) {
                return [
                    "status" => 404,
                    "message" => "Not Found"
                ];
            }
            return [
                "status" => 200,
                "data" => new ResultResource($result)
            ];
        } catch (\Throwable $th) {
            return [
                'status' => 500,
                'message' => $th->getMessage()
            ];
        }
    }

    private function getTimestampNow(): string
    {
        return now()->toDateTimeString();
    }
}
