<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitAnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "scheduleId" => ['required','numeric'],
            "answers" => ['required', 'array'],
            "answers.*.questionId" => ['required'],
            "answers.*.selectOptionId" => ['sometimes','required', 'numeric'],
            "answers.*.text" => ['sometimes', 'required', 'string']
        ];
    }
}
