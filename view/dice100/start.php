<?php
namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());
?>

<h1><?= $title ?></h1>

<p>Number of dices: <?= $_SESSION["game"]->dices ?></p>

<!-- <pre>
    if (!empty($_SESSION["game"]->players[0]->getDiceHands())) {
        print_r($_SESSION["game"]->players[0]->getDiceHands());
    }
    if (!empty($_SESSION["game"]->players[1]->getDiceHands())) {
        print_r($_SESSION["game"]->players[1]->getDiceHands());
    }
    ?>
</pre> -->

<p>
<?php foreach ($_SESSION["game"]->players as $player) : ?>
    <?php if (!empty($player->getDiceHands())) : ?>
        <?php foreach ($player->getDiceHands() as $dicehand) : ?>
            <p>Value of dices: <?= implode(", ", $dicehand->values()) ?></p>
            <!-- <p>Sum: <?= $dicehand->sum() ?></p> -->
        <?php endforeach; ?>
    <?php endif; ?>
<?php endforeach; ?>
</p>


<?php if ($noPoints) : ?>
    <?php foreach ($lastDiceHand->values() as $value) : ?>
        <p>Value of dice with a one: <?= $value ?></p>
    <?php endforeach; ?>
<?php endif; ?>

<p>
<?php foreach ($_SESSION["game"]->players as $key=>$player) : ?>
    <p>Total sum for player <?=$key?>: <?= $player->getSum() ?></p>
    <!-- <span class="dice-sprite <?= $value ?>"></span> -->
<?php endforeach; ?>
</p>

<!-- if (!empty($_SESSION["game"]->players[0]->getDiceHands())) { -->

<form method="post">
    <?php if (empty($_SESSION["game"]->players[0]->getDiceHands())) : ?>
        <p>Please start the game. You may have the first roll.</p>
        <input type="submit" name="roll" value="Roll - I want lots of points">
        <input type="submit" name="stop" value="Stop - I'm content with the sum">
    <?php elseif (!$noPoints) : ?>
        <p>There is no 1 amongst the dices. You may roll again.</p>
        <input type="submit" name="roll" value="Roll - I want lots of points">
        <input type="submit" name="stop" value="Stop - I'm content with the sum">
    <?php elseif ($noPoints) : ?>
        <p>There is a 1 amongst the dices. You may not roll again. There were no points this turn.</p>
        <input type="submit" name="stop" value="Ok">
    <?php endif; ?>
</form>
