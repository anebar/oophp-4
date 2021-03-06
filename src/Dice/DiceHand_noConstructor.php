<?php
namespace Anb\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
     * @var array $values  Array consisting of all rolls of the dices.
     * @var int $sum  Sum of all values.
     * @var float $average  Average of all values.
     */
    private $values = [];
    private $sum;
    private $average;

    public function roll()
    {
        $dice = new Dice();
        for ($i=0; $i <= 4; $i++) {
            $this->values[$i] = $dice->roll();
            $this->sum = $this->sum + $this->values[$i];
        }
        $this->average = round($this->sum/5, 1);
    }

    /**
     * Get the values.
     *
     * @return array as all the values.
     */
    public function values()
    {
        return $this->values;
    }

    /**
     * Get the sum.
     *
     * @return int as the sum.
     */
    public function sum()
    {
        return $this->sum;
    }

    /**
     * Get the average.
     *
     * @return float as the average.
     */
    public function average()
    {
        return $this->average;
    }
}
