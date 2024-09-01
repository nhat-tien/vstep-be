<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class SkillIdNotFoundException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'status' => 500,
            'message' => 'Skill id not found'
        ]);
    }
}
