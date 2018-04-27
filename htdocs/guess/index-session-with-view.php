<?php
/**
 * Show off the autoloader.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

$title = "Guess my number (SESSION, with view)";

// Get incoming
$guessNumber = $_POST["guessNumber"] ?? null;

// https://stackoverflow.com/questions/23103517/use-of-session-id-and-session-name?answertab=votes#tab-top
session_name(md5(__FILE__));
session_start();

if (!isset($_SESSION["game"])) {
    $number = -1;
    $tries = 6;
    $_SESSION["game"] = new Guess($number, $tries);
} else {
    $tries = $_SESSION["game"]->tries();
}
$game = $_SESSION["game"];

// // Show types
// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';

// // Does not show types
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

// Reset the game
if (isset($_POST["doReset"])) {
    // Do not destroy session first.

    $_SESSION["game"] = new Guess();
    $game = $_SESSION["game"];
}

// // Does not show types
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

// Make a guess
$res = null;
if (isset($_POST["doGuess"]) && ($tries > 0)) {
    try {
        $res = $game->makeGuess($guessNumber);
    } catch (GuessException $e) {
        echo "Caught exception (" . get_class($e) . "): " . $e->getMessage() . "<hr>";
    }
}
if ($game->tries() == 0) {
    $notries = "There are no remaining tries.";
}

require __DIR__ . "/view/game-session.php";
