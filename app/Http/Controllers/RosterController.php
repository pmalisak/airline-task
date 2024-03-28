<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Query\Roster\RosterRepository;
use App\Query\Roster\SearchCriteria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final readonly class RosterController
{
    public function __construct(
        private RosterRepository $rosterRepository,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $records = $this->rosterRepository->getBy(new SearchCriteria(
            $request->get('dateFrom'),
            $request->get('dateTo'),
            $request->get('activity'),
            $request->get('from'),
            (bool) $request->get('nextWeek'),
        ));

        return response()->json(['items' => $records->toArray()]);
    }
}
