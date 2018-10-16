<?php

namespace App\Service;

use App\Contract\WaterCounterInterface;

/**
 * Class WaterCounter
 * @package App\Service
 */
class WaterCounter implements WaterCounterInterface
{
    /**
     * Returns total amount of water between the walls
     *
     * @param array $heights
     * @return int
     */
    public function getTotalWater(array $heights): int
    {
        $water = 0;
        $size = count($heights);

        $wallL[0] = $heights[0];
        for ($i = 1; $i < $size; $i++) {
            $wallL[$i] = ($wallL[$i - 1] > $heights[$i]) ? $wallL[$i - 1] : $heights[$i];
        }

        $wallR[$size - 1] = $heights[$size - 1];
        for ($i = $size - 2; $i >= 0; $i--) {
            $wallR[$i] = ($wallR[$i + 1] > $heights[$i]) ? $wallR[$i + 1] : $heights[$i];
        }

        for ($i = 0; $i < $size; $i++) {
            //Amount of water is smallest wall (right or left) - height of the block itself
            $water += ($wallL[$i] < $wallR[$i]) ? $wallL[$i] : $wallR[$i];
            $water -= $heights[$i];
        }

        return $water;
    }
}