<?php

declare(strict_types=1);

namespace App\Import\Airline\RosterBuster\Provider;

use App\Import\Airline\Provider;
use App\Import\Airline\RosterBuster\Parser\RosterBusterParser;
use App\Import\Airline\RosterBuster\Saver\RosterBusterBatchSaver;
use App\Import\Exception\ImportException;
use App\Import\Exception\InvalidArgumentException;

final readonly class RosterBusterProvider implements Provider
{
    public function __construct(
        private RosterBusterParser $parser,
        private RosterBusterBatchSaver $batchSaver,
    ) {
    }

    public function supports(string $data): bool
    {
        return $this->parser->supports($data);
    }

    /**
     * @throws InvalidArgumentException
     * @throws ImportException
     */
    public function run(string $data): void
    {
        $data = $this->parser->parse($data);

        $this->batchSaver->save($data);
    }
}
