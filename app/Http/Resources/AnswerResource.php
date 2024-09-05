<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "questionId" => $this->question_id,
            "selectOption" => $this->question_select_option_id,
            "text" => $this->text,
            "audioUrl" => $this->audio_url
        ];
    }
}
