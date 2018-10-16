<?php

namespace App\Contract;

use InvalidArgumentException;

/**
 * Interface GeneratorInterface
 * @package App\Contract
 */
interface CombinationsGeneratorInterface
{
    /**
     * Generates combinations based on input data
     *
     * @param array $symbols
     * @param int $length
     * @return array
     * @throws InvalidArgumentException
     */
    public function generate(array $symbols, int $length): array;
}