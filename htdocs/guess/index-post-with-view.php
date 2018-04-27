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

require __DIR__ . "/view/game-post.php";
