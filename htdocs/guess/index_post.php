<?php
/**
 * Show off the autoloader.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

$title = "Guess my number (POST)";

// Get incoming
$number = $_POST["number"] ?? -1;
$tries = $_POST["tries"] ?? 6;
$guessNumber = $_POST["guessNumber"] ?? null;

$game = new Guess($number, $tries);

// Reset the game
if (isset($_POST["doReset"])) {
    // $game->random();
    $game = new Guess();
}

// echo "secret number: " . $game->number() . "<br>";
// echo "Tries left: ". $game->tries() . "<br>";
// echo "Guessed number: " . $guessNumber . "<br>";

// Make a guess
$res = null;
if (isset($_POST["doGuess"]) && ($tries > 0)) {
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
        <meta charset="utf-8">
        <title><?= $title ?></title>
        <link type="text/css" rel="stylesheet" charset="UTF-8" href="css/style.css">
    </head>
    <body>
        <h1><?= $title ?></h1>
        <p>
            Guess a number between 1 and 100.
            <br>
            You have <span class="underline"><?= $game->tries() ?> tries left</span>.
        </p>
        <p>
            <?php if (isset($_POST["doCheat"])) : ?>
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
        <form method="post">
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
