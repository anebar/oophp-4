<?php
namespace Anb\Game;

/**
 * Game my number, a class supporting the game through GET, POST and SESSION.
 */
class Game
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    public $number;
    public $tries;
    public $players;
    public $dices;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    public function __construct(int $players = 2, int $dices = 5)
    {
        // $this->players = [];
        $this->dices = $dices;
        for ($i = 0; $i < $players; $i++) {
            $this->players[] = new \Anb\Player\Player();
        }
    }

    /**
    * Destroy a Game.
    */
    public function __destruct()
    {
        echo __METHOD__;
        // session_unset("game");
    }

    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */
    public function random()
    {
        $this->number = rand(0, 100);
    }


    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    public function tries()
    {
        return $this->tries;
    }


    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function number()
    {
        return $this->number;
    }


    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GameException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    public function makeGame($number)
    {
        if ($number < 1 || $number > 100) {
            throw new GameException("Your guess is lower than 1 or higher than 100 (out of bounds).");
        } else {
            $this->tries--;
            if ($this->number == $number) {
                return "correct!";
            } elseif ($this->number < $number) {
                return "too high.";
            } else {
                return "too low.";
            }
        }
    }
}
