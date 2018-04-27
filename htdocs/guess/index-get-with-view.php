<?php
/**
 * Show off the autoloader.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

$title = "Guess my number (GET, with view)";

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

require __DIR__ . "/view/game-get.php";
