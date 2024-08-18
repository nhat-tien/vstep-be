<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'examId' => $this->exam_id,
            'questionId' => $this->id,
            'skillId' => $this->skill_id,
            'order' => $this->order,
            'questionType' => $this->question_type,
            'fileUrl' => $this->file_url,
            'text' => $this->text,
            'selectOption' => QuestionSelectOptionResource::collection($this->whenLoaded('questionSelectOptions')),
        ];
    }
}
