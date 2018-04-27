<?php
namespace Anb\Player;

/**
  * Showing off a standard class with methods and properties.
  * Setters och Getters
  */
class Player
{
 /**
  * @var int  $sum   The sum of all throws.
  */
    private $sum;
    private $dicehands;

    /**
    * Constructor to create a Player.
    *
    * @throws PlayerAgeException when age is negative.
    *
    * @param null|string $name The name of the player.
    * @param null|int    $age  The age of the player.
    */
    public function __construct(int $sum = 0)
    {
        // if (!(is_int($age) && $age >= 0)) {
        //     throw new PlayerAgeException("Age is only allowed to be a positive integer.");
        // }
        $this->sum = $sum;
    }

    /**
    * Destroy a Player.
    */
    public function __destruct()
    {
        echo __METHOD__;
    }

    /**
    * Set the sum for all throws for the player.
    *
    * @param int $sum The sum for one throw for the player.
    *
    * @return void
    */
    public function setSum(int $sum)
    {
        $this->sum = $this->sum + $sum;
    }

    /**
    * Get the sum for all throws for the player (all dicehands).
    *
    * @return int as the sum for all throws (all dicehands) for the player.
    */
    public function getSum()
    {
        return $this->sum;
    }

    /**
    * Create new hand of dices for players turn.
    *
    * @param int $sum The sum for one throw for the player.
    *
    * @return void
    */
    public function setDiceHand(\Anb\Dice\DiceHand $diceHand)
    {
        $this->dicehands[] = $diceHand;
        $this->sum = $this->sum + $diceHand->sum();
    }

    /**
    * Get all dicehands.
    *
    * @return array with all dicehands.
    */
    public function getDiceHands()
    {
        return $this->dicehands;
    }


    /**
    * Remove last diceHand.
    *
    * @return array with all dicehands minus the last one.
    */
    public function popLastDiceHand()
    {
        array_pop($this->dicehands);
    }

}
