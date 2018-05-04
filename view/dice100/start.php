<?php
namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());
?>

<h1><?= $title ?></h1>

<div class="flex-container">
    <?php foreach ($_SESSION["game"]->players as $key => $player) : ?>
        <div>
            <h2>Player <?= $key ?></h2>
            <?php if ($key == 0) : ?>
                <h3>Me</h3>
            <?php else : ?>
                <h3>Computer</h3>
            <?php endif; ?>
            <?php if (!empty($player->getDiceHands())) : ?>
                <?php foreach ($player->getDiceHands() as $dicehand) : ?>
                    <?php foreach ($dicehand->classes() as $value) : ?>
                        <i class="dice-sprite <?= $value ?>"></i>
                        <!-- <span class="dice-sprite <?= $value ?>"></span> -->
                    <?php endforeach; ?>
                    <br>
                <?php endforeach; ?>
            <?php endif; ?>
            <p>Total sum: <?= $player->getSum() ?></p>
            <?php if ($player->getSum() >= 100) : ?>
                <?php if ($key == 0) : ?>
                    <h3>Congrats!!! You won.</h3>
                <?php else : ?>
                    <h3>Congrats!!! Computer won.</h3>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (($_SESSION["game"]->players[0]->getSum() < 100) && ($_SESSION["game"]->players[1]->getSum() < 100)) : ?>
                <?php if (!empty($player->getLastDiceHands())) : ?>
                    <h3>New turn:</h3>
                    <?php foreach ($player->getLastDiceHands() as $lastDiceHand) : ?>
                        <?php foreach ($lastDiceHand->classes() as $value) : ?>
                            <i class="dice-sprite <?= $value ?>"></i>
                            <!-- <span class="dice-sprite <?= $value ?>"></span> -->
                        <?php endforeach; ?>
                        <br>
                    <?php endforeach; ?>
                    <p>
                        Sum: <?= $player->sumlastDiceHands ?>
                    <?php if ($player->lastNoPoints) : ?>
                        <br>
                        <span class="italic">This turn gave no points<br>because of a 1 amongst the dices.</span>
                    <?php endif; ?>
                    </p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

<form class="dice100" method="post">
    <?php if (($_SESSION["game"]->players[0]->getSum() >= 100) || ($_SESSION["game"]->players[1]->getSum() >= 100)) : ?>
        <input type="submit" name="play" value="I want to play again">
    <?php elseif (!empty($_SESSION["game"]->players[1]->sumlastDiceHands)) : ?>
        <h3>It's your turn.</h3>
        <input type="submit" name="roll" value="Roll - I want lots of points">
    <?php elseif (!empty($_SESSION["game"]->players[0]->getLastDiceHands()) &&
        !$_SESSION["game"]->players[0]->lastNoPoints) : ?>
        <h3>It's your turn.</h3>
        <input type="submit" name="roll" value="Roll - I want lots of points">
        <input type="submit" name="stop" value="Stop - I'm content with the sum">
    <?php elseif (empty($_SESSION["game"]->players[0]->getLastDiceHands())) : ?>
        <h3>Please start the game. You may have the first roll.</h3>
        <input type="submit" name="roll" value="Roll - I want lots of points">
        <input type="submit" name="stop" value="Stop - The computer may roll">
    <?php elseif (!$_SESSION["game"]->players[0]->lastNoPoints) : ?>
        <h3>There is no 1 amongst the dices. You may roll again.</h3>
        <input type="submit" name="roll" value="Roll - I want lots of points">
        <input type="submit" name="stop" value="Stop - I'm content with the sum">
    <?php elseif ($_SESSION["game"]->players[0]->lastNoPoints) : ?>
        <h3>You may not roll again.<br>It is the computer's turn.</h3>
        <input type="submit" name="nopoints" value="Ok, no points">
    <?php endif; ?>
</form>
