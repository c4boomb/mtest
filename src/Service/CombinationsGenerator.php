<?php

namespace App\Service;

use App\Contract\CombinationsGeneratorInterface;
use InvalidArgumentException;

/**
 * Class CombinationsGenerator
 * @package App\Service
 */
class CombinationsGenerator implements CombinationsGeneratorInterface
{
    /**
     * Generates combinations based on input data
     *
     * @param array $symbols
     * @param int $length
     * @return array
     * @throws InvalidArgumentException
     */
    public function generate(array $symbols, int $length): array
    {
        $result = [];

        for ($i = 1; $i <= $length; $i++) {
            $result = array_merge($result, $this->getCombinationsForFixedSize(
                $symbols,
                $i
            ));
        }

        return $result;
    }

    /**
     * Generates all combinations of length
     *
     * @param array $input
     * @param int $length
     * @param array $current
     * @return array
     * @throws InvalidArgumentException
     */
    private function getCombinationsForFixedSize(array $input, int $length, array $current = [])
    {
        $current = (empty($current)) ? $input : $current;

        if ($length < 0) {
            throw new InvalidArgumentException('Invalid input');
        } elseif ($length === 0 || empty($input)) {
            return [];
        } elseif ($length === 1) {
            return $current;
        }

        $newCombinations = [];
        foreach ($current as $item) {
            foreach ($input as $symbol) {
                $newCombinations[] = $item . $symbol;
            }
        }

        return $this->getCombinationsForFixedSize($input, $length - 1, $newCombinations);
    }
}