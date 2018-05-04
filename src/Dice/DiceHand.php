<?php
namespace Anb\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
     * @var Dice   $dices    Array consisting of dices.
     * @var array  $values   Array consisting of last roll of the dices as int.
     * @var array  $classes  Array consisting of last roll of the dices as string.
     * @var int    $sum      Sum of all values.
     * @var float  $average  Average of all values.
     */
    private $dices;
    private $values;
    private $classes;
    private $sum;
    private $average;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct(int $dices = 5)
    {
        $this->dices  = [];
        $this->values = [];
        $this->classes = [];

        for ($i = 0; $i < $dices; $i++) {
            // $this->dices[] = new Dice();
            $this->dices[]  = new DiceGraphic();
            $this->values[] = null;
            $this->classes[] = null;
        }
    }

    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function roll()
    {
        for ($i=0; $i < count($this->dices); $i++) {
            $this->values[$i] = $this->dices[$i]->roll();
            $this->classes[$i] = $this->dices[$i]->graphic();
        }
    }

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        return $this->values;
    }

    /**
     * Get classes of dices from last roll to show dice graphic.
     *
     * @return array with classes of the last roll.
     */
    public function classes()
    {
        return $this->classes;
    }

    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum()
    {
        return array_sum($this->values);
    }

    /**
     * Get the average of all dices.
     *
     * @return float as the average of all dices.
     */
    public function average()
    {
        return array_sum($this->values) / count($this->values);
    }
}
