<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Import\Locator\ProviderLocator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final readonly class ImportController
{
    public function __construct(
        private ProviderLocator $providerLocator,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        if ($data = $request->getContent()) {
            try {
                $this->providerLocator->get($data)->run($data);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 422);
            }
        } else {
            return response()->json(['error' => 'File is empty'], 422);
        }

        return response()->json(['message' => 'OK'], 201);
    }
}
