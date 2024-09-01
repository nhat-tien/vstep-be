<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'examScheduleId' => $this->exam_schedule_id,
            'skillId'=> $this->skill_id,
            'startTime' => $this->start_time,
            'endTime' => $this->end_time,
        ];
    }
}
