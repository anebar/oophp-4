<?php
/**
 * Show off the autoloader.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

$title = "Guess my number (GET)";

// Get incoming
$number = $_GET["number"] ?? -1;
$tries = $_GET["tries"] ?? 6;
$guessNumber = $_GET["guessNumber"] ?? null;

$game = new Guess($number, $tries);

// Reset the game
if (isset($_GET["doReset"])) {
    // $game->random();
    $game = new Guess();
}

// echo "secret number: " . $game->number() . "<br>";
// echo "Tries left: ". $game->tries() . "<br>";
// echo "Guessed number: " . $guessNumber . "<br>";

// Make a guess
$res = null;
if (isset($_GET["doGuess"]) && ($tries > 0)) {
    // $res = $game->makeGuess($guessNumber);
    try {
        $res = $game->makeGuess($guessNumber);
    } catch (GuessException $e) {
        echo "Caught exception (" . get_class($e) . "): " . $e->getMessage() . "<hr>";
    }
}
if ($game->tries() == 0) {
    $notries = "There are no remaining tries.";
}
?>

<!doctype html>
<html>
    <head>
        <!-- <meta http-equiv="content-type" content="text/html; charset=utf-8"> -->
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <title><?= $title ?></title>
    </head>
    <body>
        <h1><?= $title ?></h1>
        <p>
            Guess a number between 1 and 100.
            <br>
            You have <span class="underline"><?= $game->tries() ?> tries left</span>.
        </p>
        <p>
            <?php if (isset($_GET["doCheat"])) : ?>
                The secret number is: <?= $game->number() ?>.
            <?php endif; ?>

            <?php if (isset($res)) : ?>
                Your guessed number <strong><?= $guessNumber ?></strong> was <strong><?= $res ?></strong>
                <?php if ($game->tries() == 0) : ?>
                    <strong><?= $notries ?></strong>
                <?php endif; ?>
            <?php endif; ?>
        </p>
        <br>
        <form method="get">
            <input type="hidden" name="number" value="<?= $game->number() ?>">
            <input type="hidden" name="tries" value="<?= $game->tries() ?>">
            <input type="text" name="guessNumber" placeholder="Guess a number..." autofocus <?php if ($game->tries() == 0) : ?>disabled
                <?php endif; ?>>
            <input type="submit" name="doGuess" value="Guess">
            <input type="submit" name="doCheat" value="Cheat">
            <input type="submit" name="doReset" value="Reset">
        </form>
    </body>
</html>
