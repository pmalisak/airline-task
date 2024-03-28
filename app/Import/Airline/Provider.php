<?php

declare(strict_types=1);

namespace App\Import\Airline;

interface Provider
{
    public function supports(string $data): bool;

    public function run(string $data): void;
}
