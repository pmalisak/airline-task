<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final readonly class RosterController
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json(['ok' => true]);
    }
}
