<?php
namespace Anb\Dice;

/**
 * Showing off a standard class with methods and properties.
 */
class Dice
{
    /**
     * @var int   $sides  Number of sides of the dice.
     */
    private $sides;
    // protected => den ärvande klassen kan få tillgång till medlemsvariabler och metoder.
    // private => den ärvande klassen kan inte använda medlemsvariabler och metoder.
    private $lastRoll;

    /**
     * Constructor to initiate the dice with the number of sides.
     * You are not required to define a constructor in your class, but if you wish
     * to pass any parameters on object construction then you need one.
     * The constructor is called on an object after it has been created,
     * and is a good place to put initialisation code, etc.
     *
     * @param int $sides  Number of sides of the dice, defaults to 6.
     */
    public function __construct(int $sides = 6)
    {
        $this->sides  = $sides;
    }

    /**
     * Randomize an integer between 1 and 6.
     *
     * @return int as the randomized number.
     */
    public function roll()
    {
        $this->lastRoll = rand(1, 6);
        return $this->lastRoll;
    }

    /**
     * Get last roll between 1 and 6.
     *
     * @return int as the last roll.
     */
    public function getLastRoll()
    {
        return $this->lastRoll;
    }
}
