<?php
/**
 * App specific routes.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Guess my number with get.
 */
// $app->router->get("dice100/start", function () use ($app) {
    // $amount = req.params.amount;
    // $data = [
    //     "title" => "Choose amount of dices",
    //     "amount" => $amount;
    // ];
    // echo "SSS";
    // echo $amount;
// }
$app->router->get("dice100/choose", function () use ($app) {
    $data = [
        "title" => "Choose amount of dices"
    ];

    // Add view and render page
    $app->view->add("dice100/choose", $data);
    $app->page->render($data);
});


$app->router->get("dice100/start", function () use ($app) {
    // Get incoming
    $diceAmount = $_GET["diceAmount"] ?? 0;
    if ($diceAmount == 0) {
        $data = [
            "title" => "Choose amount of dices"
        ];

        // Add view and render page
        $app->view->add("dice100/choose", $data);
        $app->page->render($data);
    } else {
        $data = [
            "title" => "Play Dice 100 with " . $diceAmount . " dices",
            "noPoints" => FALSE
        ];

        // $game = new \Anb\Game\Game(2, $diceAmount);

        // // https://stackoverflow.com/questions/23103517/use-of-session-id-and-session-name?answertab=votes#tab-top
        // session_name(md5(__FILE__));
        // session_start();

        // Set up game with two players. player 0 is me and and player 1 is computer.
        $_SESSION["game"] = new \Anb\Game\Game(2, $diceAmount);

        if (!isset($_SESSION["game"])) {
            // $_SESSION["game"] = new \Anb\Game\Game(2, $diceAmount);
        }
        $game = $_SESSION["game"];

        // $dice = new DiceGraphic();
        // $rolls = $diceAmount;
        // $res = [];
        // $class = [];
        // for ($i = 0; $i < $rolls; $i++) {
        //     $res[] = $dice->roll();
        //     $class[] = $dice->graphic();
        // }

        // Add view and render page
        $app->view->add("dice100/start", $data);
        $app->page->render($data);
    }
});

$app->router->post("dice100/start", function () use ($app) {
    // Get incoming
    $roll = $_POST["roll"] ?? 0;
    $stop = $_POST["stop"] ?? 0;
    $data = [
        "title" => "Play Dice 100 with " . $_SESSION["game"]->dices . " dices"
    ];
    // session_name(md5(__FILE__));
    // session_start();

    // print_r($_SESSION);
    // die();

    $noPoints = FALSE;
    if (!$stop) {
        // me
        $lastDiceHand = new \Anb\Dice\DiceHand($_SESSION["game"]->dices);
        $lastDiceHand->roll();
        foreach ($lastDiceHand->values() as $value) {
            if (!$noPoints && ($value == 1)) {
                $noPoints = TRUE;
            } else {
                $noPoints = FALSE;
            }
        }
        if (!$noPoints) {
            $_SESSION["game"]->players[0]->setDiceHand($lastDiceHand);
        }

        // $_SESSION["game"]->players[0]->setDiceHand($_SESSION["game"]->dices);
        //
        // $diceHands = $_SESSION["game"]->players[0]->getDiceHands();
        // $lastDiceHand = end($diceHands);
        // // reset($diceHands);
        // foreach ($lastDiceHand->values() as $value) {
        //     if ($value == 1 && !$noPoints) {
        //         $noPoints = TRUE;
        //         $_SESSION["game"]->players[0]->popLastDiceHand();
        //     } else {
        //         $noPoints = FALSE;
        //     }
        // }
    } elseif (!$roll) {
        // computer
        $lastDiceHand = new \Anb\Dice\DiceHand($_SESSION["game"]->dices);
        $lastDiceHand->roll();
        foreach ($lastDiceHand->values() as $value) {
            if (!$noPoints && ($value == 1)) {
                $noPoints = TRUE;
            } else {
                $noPoints = FALSE;
            }
        }
        if (!$noPoints) {
            $_SESSION["game"]->players[1]->setDiceHand($lastDiceHand);
        }
    }
    $data["noPoints"] = $noPoints;
    $data["lastDiceHand"] = $lastDiceHand;

    // Add view and render page
    $app->view->add("dice100/start", $data);
    $app->page->render($data);
});


/**
 * Guess my number with post.
 */
$app->router->any(["GET", "POST"], "dice100/post", function () use ($app) {
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
    $app->view->add("dice100/post", $data);
    $app->page->render($data);
});


/**
 * Guess my number with session.
 */
$app->router->any(["GET", "POST"], "dice100/session", function () use ($app) {
    $data = [
        "title" => "Play Dice 100"
    ];

    $dice = new \Anb\Dice\DiceGraphic();
    // Prepare $data
    // $rolls = 6;
    $data["rolls"] = 6;
    // $res = [];
    // $class = [];
    $data["res"] = [];
    $data["class"] = [];
    for ($i = 0; $i < $data["rolls"]; $i++) {
        $data["res"][] = $dice->roll();
        $data["class"][] = $dice->graphic();
    }

    // Add view and render page
    $app->view->add("dice100/session", $data);
    $app->page->render($data);
});
