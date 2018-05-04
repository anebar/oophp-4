<?php
namespace Anb\Player;

/**
  * Showing off a standard class with methods and properties.
  * Setters och Getters
  */
class Player
{
    /**
      * @var int       $sum               The sum of all throws.
      * @var array     $dicehands         DiceHands for all rolls.
      * @var array     $lastDiceHands     DiceHands for the last turn.
      * @var int       $sumlastDiceHands  The sum of all rolls for the last turn.
      * @var DiceHand  $lastDiceHand      Last DiceHand.
      * @var bool      $lastNoPoints      If last turn gave points.
      */
    private $sum;
    private $dicehands;
    private $lastDiceHands;
    public $sumlastDiceHands;
    private $lastDiceHand;
    public $lastNoPoints;

    /**
    * Constructor to create a Player.
    */
    public function __construct()
    {
        $this->dicehands = [];
        $this->lastDiceHands = [];
        $this->sum = 0;
    }

    /**
    * Destroy a Player.
    */
    public function __destruct()
    {
        // echo __METHOD__;
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
        $this->sum += $sum;
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
    * Add last DiceHand to all dicehands.
    * Add sum of last turn to total sum.
    *
    * @return void
    */
    public function setDiceHands()
    {
        $this->dicehands = array_merge($this->getDiceHands(), $this->getLastDiceHands());
        foreach ($this->getLastDiceHands() as $lastDiceHand) {
            $this->setSum($lastDiceHand->sum());
        }
        $this->resetLastDiceHands();
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
     * Reset last DiceHands.
     *
     * @return void
     */
    public function resetLastDiceHands()
    {
        $this->lastDiceHands = array();
        $this->lastNoPoints = false;
        $this->sumlastDiceHands = 0;
    }


    /**
     * Save last dicehand to lastDiceHands.
     *
     * @param DiceHand $lastDiceHand  Last dicehand.
     *
     * @return void
     */
    public function setLastDiceHands(\Anb\Dice\DiceHand $lastDiceHand)
    {
        $this->lastDiceHands[] = $lastDiceHand;
    }


    /**
     * Get last DiceHands, i.e. last turn of rolls.
     *
     * @return void
     */
    public function getLastDiceHands()
    {
        return $this->lastDiceHands;
    }


    /**
     * Set last DiceHand.
     *
     * @param int  $dices  Amount of dices for game.
     *
     * @return void
     */
    public function setLastDiceHand(int $dices)
    {
        $this->lastDiceHand = new \Anb\Dice\DiceHand($dices);
    }


    /**
     * Get last DiceHand.
     *
     * @return DiceHand as the last dicehand.
     */
    public function getLastDiceHand()
    {
        return $this->lastDiceHand;
    }
}
