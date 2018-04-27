<?php
/**
 * Show off the autoloader.
 */
namespace Anb\Guess;

require __DIR__ . "/config.php";
// include(__DIR__ . "/autoload.php");
require __DIR__ . "/../../vendor/autoload.php";

$title = "Guess my number (GET inside)";

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
