<?php
namespace Anb\Dice;

/**
 * Det handlar om att en klass ärver från en annan klass.
 * Man kan säga att den ärvande klassen utökar, eller specialiserar, basklassen.
 * Basklassen kallas även superklass och den ärvande klassen kallas subklass.
 * self:: och parent:: refererar till klassens medlemmar, $this refererar till objektets medlemmar.
 * self::   Referera till den egna klassen.
 * parent:: Referera till förälder/super/bas klassen.
 * $this->  Referera till nuvarande objekt.
 */
/**
 * A graphic dice.
 */
class DiceGraphic extends Dice
{
    /**
     * @var integer SIDES Number of sides of the Dice.
     * Synligheten för en konstant i en klass är public,
     * från och med PHP 7.1 kan man även ange private för en konstant.
     */
    const SIDES = 6;

    /**
     * Constructor to initiate the dice with six number of sides.
     */
    public function __construct()
    {
        parent::__construct(self::SIDES);
    }

    /**
     * Get a graphic value of the last rolled dice.
     *
     * @return string as graphical representation of last rolled dice.
     */
    public function graphic()
    {
        return "dice-" . $this->getLastRoll();
    }
}
