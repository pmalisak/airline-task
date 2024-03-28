<?php

declare(strict_types=1);

namespace App\Import\Locator;

use App\Import\Airline\Provider;
use App\Import\Airline\RosterBuster\Provider\RosterBusterProvider;
use App\Import\Exception\ImportException;

final class ProviderLocator
{
    /**
     * @var Provider[]
     */
    private array $providers;

    public function __construct(
        private readonly RosterBusterProvider $rosterBusterProvider,
    ) {
        $this->providers[] = $this->rosterBusterProvider;
    }

    /**
     * @throws ImportException
     */
    public function get(string $data): Provider
    {
        foreach ($this->providers as $provider) {
            if ($provider->supports($data)) {
                return $provider;
            }
        }

        throw new ImportException('Data could not be recognised');
    }
}
