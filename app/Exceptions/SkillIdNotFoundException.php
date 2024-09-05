<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class SkillIdNotFoundException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'status' => 404,
            'message' => 'Skill id not found'
        ]);
    }
}
