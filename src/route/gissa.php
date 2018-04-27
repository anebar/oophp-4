<?php
/**
 * App specific routes.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Guess my number with get.
 */
$app->router->get("guess/get", function () use ($app) {
    $data = [
        "title" => "Guess my number using GET"
    ];

    // Get incoming
    $number = $_GET["number"] ?? -1;
    $tries = $_GET["tries"] ?? 6;
    $guessNumber = $_GET["guessNumber"] ?? null;

    $game = new \Anb\Guess\Guess($number, $tries);

    // Reset the game
    if (isset($_GET["doReset"])) {
        // $game->random();
        $game = new \Anb\Guess\Guess();
    }

    // Make a guess
    $res = null;
    if (isset($_GET["doGuess"]) && ($tries > 0)) {
        // $res = $game->makeGuess($guessNumber);
        try {
            $res = $game->makeGuess($guessNumber);
        } catch (\Anb\Guess\GuessException $e) {
            echo "Caught exception (" . get_class($e) . "): " . $e->getMessage() . "<hr>";
        }
    }
    if ($game->tries() == 0) {
        $notries = "There are no remaining tries.";
    }

    // Prepare $data
    $data["game"] = $game;
    $data["res"] = $res;
    $data["guessNumber"] = $guessNumber;
    $data["notries"] = isset($notries) ? $notries : "";

    // Add view and render page
    $app->view->add("guess/get", $data);
    $app->page->render($data);
});


/**
 * Guess my number with post.
 */
$app->router->any(["GET", "POST"], "guess/post", function () use ($app) {
    $data = [
        "title" => "Guess my number using POST"
    ];

    // Get incoming
    $number = $_POST["number"] ?? -1;
    $tries = $_POST["tries"] ?? 6;
    $guessNumber = $_POST["guessNumber"] ?? null;

    $game = new \Anb\Guess\Guess($number, $tries);

    // Reset the game
    if (isset($_POST["doReset"])) {
        // $game->random();
        $game = new \Anb\Guess\Guess();
    }

    // Make a guess
    $res = null;
    if (isset($_POST["doGuess"]) && ($tries > 0)) {
        // $res = $game->makeGuess($guessNumber);
        try {
            $res = $game->makeGuess($guessNumber);
        } catch (\Anb\Guess\GuessException $e) {
            echo "Caught exception (" . get_class($e) . "): " . $e->getMessage() . "<hr>";
        }
    }
    if ($game->tries() == 0) {
        $notries = "There are no remaining tries.";
    }

    // Prepare $data
    $data["game"] = $game;
    $data["res"] = $res;
    $data["guessNumber"] = $guessNumber;
    $data["notries"] = isset($notries) ? $notries : "";

    // Add view and render page
    $app->view->add("guess/post", $data);
    $app->page->render($data);
});


/**
 * Guess my number with session.
 */
$app->router->any(["GET", "POST"], "guess/session", function () use ($app) {
    $data = [
        "title" => "Guess my number using SESSION"
    ];

    // Get incoming
    $guessNumber = $_POST["guessNumber"] ?? null;

    // https://stackoverflow.com/questions/23103517/use-of-session-id-and-session-name?answertab=votes#tab-top
    session_name(md5(__FILE__));
    session_start();

    if (!isset($_SESSION["game"])) {
        $number = -1;
        $tries = 6;
        $_SESSION["game"] = new \Anb\Guess\Guess($number, $tries);
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

        $_SESSION["game"] = new \Anb\Guess\Guess();
        $game = $_SESSION["game"];
    }

    // // Does not show types
    // echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

    // Make a guess
    $res = null;
    if (isset($_POST["doGuess"]) && ($tries > 0)) {
        try {
            $res = $game->makeGuess($guessNumber);
        } catch (\Anb\Guess\GuessException $e) {
            echo "Caught exception (" . get_class($e) . "): " . $e->getMessage() . "<hr>";
        }
    }
    if ($game->tries() == 0) {
        $notries = "There are no remaining tries.";
    }

    // Prepare $data
    $data["game"] = $game;
    $data["res"] = $res;
    $data["guessNumber"] = $guessNumber;
    $data["notries"] = isset($notries) ? $notries : "";

    // Add view and render page
    $app->view->add("guess/session", $data);
    $app->page->render($data);
});
