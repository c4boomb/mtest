<?php

namespace App\Contract;

/**
 * Interface WaterCounterInterface
 * @package App\Contract
 */
interface WaterCounterInterface
{
    /**
     * Returns total amount of water between the walls
     *
     * @param array $heights
     * @return int
     */
    public function getTotalWater(array $heights): int;
}