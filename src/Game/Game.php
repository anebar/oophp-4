<?php
namespace Anb\Game;

/**
 * Game Dice 100. Get to 100 points first, playing me and the computer.
 */
class Game
{
    /**
     * @var array $players  All players.
     * @var int   $dices    Number of dices in game.
     * @var int   MAXPOINTS Number of points to reach for winning.
      * Synligheten för en konstant i en klass är public,
      * från och med PHP 7.1 kan man även ange private för en konstant.
      */
    public $players;
    public $dices;

    /**
     * Constructor to initiate the object with current game settings.
     *
     * @param int $players  Number of players, default 2.
     * @param int $dices    Number of dices in game, default 5.
     */
    public function __construct(int $players = 2, int $dices = 5)
    {
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
        // echo __METHOD__;
    }
}
